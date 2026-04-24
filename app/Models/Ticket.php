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

    protected $with = ['comments', 'comments.user'];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Ticket has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}