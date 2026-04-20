<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'message'
    ];
}
