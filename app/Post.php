<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
      }
    public function comments(){
        return $this->hasMany(\App\Comment::class,'post_id','id');
    }
}
