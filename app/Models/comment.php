<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'ticket_id',
        'user_id'
    ];

    // Comment belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Comment belongs to a user (agent) - nullable
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}