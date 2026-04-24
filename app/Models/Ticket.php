<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'description',
        'ref',
        'status'
    ];

    // Eager load comments + user (avoids N+1 problem)
    protected $with = ['comments', 'comments.user'];

    /**
     * Ticket has many comments (replies)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * (Optional) If ticket belongs to a user
     * Only keep if you have user_id column in tickets table
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor: Get last agent who commented
     */
    public function getLastCommentedAgentAttribute()
    {
        return $this->comments
            ->sortByDesc('created_at')
            ->filter(function ($comment) {
                return $comment->user && $comment->user->role === 'agent';
            })
            ->pluck('user')
            ->first();
    }
}