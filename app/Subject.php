<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [ 'name', 'room' , 'professor', 'assistant', 'description', 'min_mark' , 'max_mark' , 'pass_mark' , 'type' ];
}
