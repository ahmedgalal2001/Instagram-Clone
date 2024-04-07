<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function sendMsg(string $email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            dd($user);
            $randomCode = Str::random(10);
            Mail::to($email)->send(new EmailVerification($randomCode));
        } catch (ModelNotFoundException $e) {
            dd($e);
        }
    }
    public function verificationCode($email)
    {
    }
}
