<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //This tells Laravel that the columns specified can be mass assigned. 
    protected $fillable = [
        'user_id', 'category_id', 'ticket_id', 'title', 'priority', 'message','status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
