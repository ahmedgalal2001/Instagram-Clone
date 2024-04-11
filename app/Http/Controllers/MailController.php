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
        $user = User::where('email', $email)->first();
        if ($user) {
            if (!$user->email_verified_at) {
                $randomCode = Str::random(10);
                $user->code = $randomCode;
                $user->save();
                Mail::to($email)->send(new EmailVerification($randomCode));
                return view("auth.verify-email-code")->with('email', $email);
            } else return back()->withErrors(['email' => 'user is verified']);
        } else {
            return back()->withErrors(['email' => 'The User Not Found.']);
        }
    }
    public function verificationCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'code' => ['required', 'string', 'max:10', 'min:10'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (!$user->email_verified_at) {
                if ($user->code == $request->code) {
                    $user->email_verified_at = now(); // or any other method of setting the current time
                    $user->save();
                    return redirect()->route('login');
                } else {
                    return back()->withErrors(['code' => 'The code provided is incorrect.']); // Redirect back with error message
                }
            }
            return back()->withErrors(['code' => 'user is verified']);
        } else {
            return back()->withErrors(['code' => 'The User Not Found.']);
        }
    }
}
