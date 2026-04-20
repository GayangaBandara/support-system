<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, $ticket)
    {
        $request->validate([
            'message' => 'required'
        ]);

        Reply::create([
            'ticket_id' => $ticket, // get from URL
            'user_id' => 1, // temporary (replace with auth later)
            'message' => $request->message
        ]);

        return back()->with('success', 'Reply added');
    }
}