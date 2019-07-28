<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name' , 'address', 'town' , 'county' , 'post_code' , 'country' , 'telephone' , 'email' , 'website' , 'facebook' , 'twitter' , 
     	'instagram' , 'youtube'];
}
