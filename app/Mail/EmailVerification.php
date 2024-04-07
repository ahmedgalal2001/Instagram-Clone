<?php

namespace App\Mail;

use Dotenv\Util\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    private $code;
    public function __construct(string $code)
    {
        $this->code = $code;
    }
    public function build()
    {
        return $this->subject('Test Email')
            ->view('email')->with(['code' => $this->code]);
    }
}
