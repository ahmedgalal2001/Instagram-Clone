<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;
    protected $fillable = ['tag'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_hashtags');
    }
}
