<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $fillable = [
        'follower_id',
        'following_id',
    ];



    public function followers(){

            return $this->belongsToMany(User::class,'followes','following_id','follower_id');
    }


    public function followingi()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','following_id');
    }
}
