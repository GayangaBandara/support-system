<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

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
        Comment::create($validated);

        // Redirect
        return redirect()
            ->route('tickets.show', $validated['ticket_id'])
            ->with('success', 'Reply added successfully');
    }
}
