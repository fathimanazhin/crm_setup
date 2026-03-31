<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'sales') {
            $leads = Lead::with('assignedUser')
                ->where(function($query) {
                    $query->where('assigned_user_id', auth()->id())
                          ->orWhere('created_by', auth()->id());
                })
                ->get();
        } else {
            $leads = Lead::with('assignedUser')->get();
        }

        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        if(auth()->user()->role == 'sales') {
            $users = User::where('role', 'admin')->select('id', 'name', 'role')->get();
        } else {
            $users = User::select('id', 'name', 'role')->get();
        }

        return view('leads.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:255',
    'phone' => [
        'required',
        'regex:/^[6-9]\d{9}$/',
        'unique:leads,phone,' . ($lead->id ?? 'NULL') . ',id'
    ],
]);
        

        if(auth()->user()->role == 'sales') {
            $assignedUser = User::find($validated['assigned_user_id']);
            if($assignedUser->role != 'admin') {
                abort(403, 'Sales can only assign leads to Admins.');
            }
        }

        $lead = Lead::create([
            'lead_name' => $validated['lead_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'source' => $validated['source'],
            'status' => $validated['status'],
            'assigned_user_id' => $validated['assigned_user_id'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('leads.index');
    }

    public function edit(Lead $lead)
    {
        if(auth()->user()->role == 'sales' && $lead->assigned_user_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if(auth()->user()->role == 'sales') {
            $users = User::where('role', 'admin')->select('id', 'name', 'role')->get();
        } else {
            $users = User::select('id', 'name', 'role')->get();
        }

        return view('leads.edit', compact('lead', 'users'));
    }

    public function update(Request $request, Lead $lead)
    {
        if(auth()->user()->role == 'sales' && $lead->assigned_user_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
    'name' => 'required|string|max:255',
    'phone' => [
        'required',
        'regex:/^[6-9]\d{9}$/',
        'unique:leads,phone,' . ($lead->id ?? 'NULL') . ',id'
    ],
]);

        if(auth()->user()->role == 'sales') {
            $assignedUser = User::find($validated['assigned_user_id']);
            if($assignedUser->role != 'admin') {
                abort(403, 'Sales can only assign leads to Admins.');
            }
        }

        $lead->update($validated);

        logActivity(
            'Lead Updated',
            'Lead: ' . $lead->lead_name,
            'Lead',
            $lead->id
        );

        return redirect()->route('leads.index');
    }

    public function destroy(Lead $lead)
    {
        if(auth()->user()->role == 'sales' && $lead->assigned_user_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $name = $lead->lead_name;
        $lead->delete();

        logActivity(
            'Lead Deleted',
            'Lead: ' . $name,
            'Lead',
            $lead->id
        );

        return redirect()->route('leads.index');
    }

    public function convertToCustomer(Lead $lead)
    {
        if(auth()->user()->role == 'sales' && $lead->assigned_user_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $existingCustomer = Customer::where('email', $lead->email)->first();

        if ($existingCustomer) {
            $lead->delete();

            return redirect()->route('customers.index')
                ->with('success', 'Customer already exists. Lead removed.');
        }

        $customer = Customer::create([
            'name' => $lead->lead_name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'created_by' => $lead->assigned_user_id,
        ]);

        $lead->delete();

        logActivity(
            'Lead Converted',
            'Lead converted to Customer: ' . $customer->name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index');
    }
}