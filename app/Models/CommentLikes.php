<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    use HasFactory;

    protected $table = 'commtent_likes';

    protected $fillable = ['post_id', 'user_id', 'comment_id'];

    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function comment()
    // {
    //     return $this->belongsTo(Comment::class);
    // }
}
