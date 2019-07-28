<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eduyear extends Model
{
    protected $fillable = [ 'start', 'end', 'year_id' , 'semester_id' ];
}
