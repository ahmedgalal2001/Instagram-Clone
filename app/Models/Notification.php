<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notification";

    // Define relationships with User model
    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'reciverId');
    }
}
