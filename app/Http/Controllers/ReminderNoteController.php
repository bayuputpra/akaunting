<?php

namespace App\Http\Controllers;

use App\Models\ReminderNote;
use Illuminate\Http\Request;

class ReminderNoteController extends Controller
{
    public function index()
    {
        $notes = ReminderNote::all();
        return view('reminder_notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        ReminderNote::create($request->all());
        return redirect()->route('reminder_notes.index')->with('success', 'Note added successfully!');
    }
}

