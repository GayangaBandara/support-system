<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        Reply::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => 1, // temporary (replace with auth later)
            'message' => $request->message
        ]);

        return back()->with('success', 'Reply added');
    }
}