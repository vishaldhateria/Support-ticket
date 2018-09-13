<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'comment'
    ];
    public function ticket()
    {
         return $this->belongsTo(Ticket::class);
    }
    public function user() //A comment belongs to a user, while user can have many comments
    {
        return $this->belongsTo(User::class);
    }
}
