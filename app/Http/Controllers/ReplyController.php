<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use Mail;
use App\Mail\TicketReply;

class ReplyController extends Controller
{
    public function store(Request $request, $ticket)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $reply = Reply::create([
            'ticket_id' => $ticket, // get from URL
            'user_id' => 1, // temporary (replace with auth later)
            'message' => $request->message
        ]);

        Mail::to($reply->ticket->email)->send(new TicketReply($reply));
        return back()->with('success', 'Reply added');
    }
}