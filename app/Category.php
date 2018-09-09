<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //In eloquent ORM, $fillable is an array which contains all those fields of table which can be filled using mass-assignment. Mass -assignment :- means to send an array to the model to directly create a new record in DB. You can define those fields whiach can be created/ filled by mass-assignment by use of fillable.
    protected $fillable = ['name'];


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
