<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $data = $request->only(['content', 'ticket_id']);
        $data['user_id'] = auth()->check() ? auth()->id() : null;

        Comment::create($data);

        return redirect()
            ->route('tickets.show', $data['ticket_id'])
            ->with('success', 'Reply added successfully');
    }
}
