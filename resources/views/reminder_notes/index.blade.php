<!DOCTYPE html>
<html>
<head>
    <title>Reminder Notes</title>
</head>
<body>
    <h1>Reminder Notes</h1>
    <form method="POST" action="{{ route('reminder_notes.store') }}">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Content:</label>
        <textarea name="content" required></textarea><br>
        <button type="submit">Add Note</button>
    </form>

    <h2>All Notes</h2>
    <ul>
        @foreach ($notes as $note)
            <li><strong>{{ $note->title }}</strong>: {{ $note->content }}</li>
        @endforeach
    </ul>
</body>
</html>
