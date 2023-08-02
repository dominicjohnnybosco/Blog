<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    //function that defines the eloquent relation of many posts belonging to a user
    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
