<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events()
    {
        $tasks = Task::all();

        $events = [];

        foreach ($tasks as $task) {
            $events[] = [
                'title' => $task->title,
                'start' => $task->due_date,
                'color' => $task->status == 'Completed' ? '#22c55e' : '#eab308'
            ];
        }

        return response()->json($events);
    }
}