<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function sendMsg(string $email)
    {
        $user = User::where("email", $email)->firstOrFail();
        if($user){
            dd($user);
        }
        $randomCode = Str::random(10);
        Mail::to($email)->send(new EmailVerification($randomCode));
    }
    public function verificationCode($email)
    {

    }
}
