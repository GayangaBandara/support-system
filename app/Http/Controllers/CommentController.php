<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketReplyNotification;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'content' => 'required',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        // Attach user (null if guest)
        $validated['user_id'] = auth()->id();

        // Create comment
        $comment = Comment::create($validated);

        // Get the ticket
        $ticket = $comment->ticket;

        // Send notification to customer
        Notification::route('mail', $ticket->email)
            ->notify(new TicketReplyNotification($comment));

        // Redirect
        return redirect()
            ->route('tickets.show', $validated['ticket_id'])
            ->with('success', 'Reply added successfully');
    }
}
