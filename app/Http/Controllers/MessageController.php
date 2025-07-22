<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // MessageController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:150',
        'message' => 'required|string',
    ]);

    Message::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'subject' => $validated['subject'],
        'message' => $validated['message'],
        'status' => 'non-lu',
        'vu' => 0,
        'date_rec' => now()

    ]);

    return back()->with('success', 'Your message has been sent successfully!');
}
}
