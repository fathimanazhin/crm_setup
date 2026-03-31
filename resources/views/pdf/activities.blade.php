<!DOCTYPE html>
<html>
<head>
    <title>Recent Activities</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background-color: #4F46E5; color: white; }
    </style>
</head>
<body>

<h2>Recent Activities</h2>

<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->user->name ?? 'Unknown' }}</td>
                <td>{{ $activity->action }}</td>
                <td>{{ $activity->description }}</td>
                <td>{{ $activity->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>