<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

#fitur baru
use App\Http\Controllers\ReminderNoteController;
Route::get('/reminder-notes', [ReminderNoteController::class, 'index'])->name('reminder_notes.index');
Route::post('/reminder-notes', [ReminderNoteController::class, 'store'])->name('reminder_notes.store');

/**
 * 'web' middleware applied to all routes
 *
 * @see \App\Providers\Route::mapWebRoutes
 */

 Livewire::setScriptRoute(function ($handle) {
    $base = request()->getBasePath();

    return Route::get($base . '/vendor/livewire/livewire/dist/livewire.min.js', $handle);
});

