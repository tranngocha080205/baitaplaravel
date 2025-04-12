<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

 class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sentData;

    /**
     * Create a new message instance.
     */
    public function __construct($sentData)
    {
        $this->sentData = $sentData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('ha769ha@gmail.com', 'From ha'),
            replyTo: [
                new Address('ha769ha@gmail.com', 'To ha'),
            ],
            subject: 'yêu cầu cấp lại mật khẩu từ shop bánh',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.interfaceEmail',
            with: [
                'sentData' => $this->sentData,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
------------------------------

public function getInputEmail(){
        return view('emails.input-email');
    }
 <a href="{{route('getInputEmail')}}">Quên mật khẩu ?</a>
--------------------------------------

Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');
-----------------------------------

use Illuminate\Support\Facades\Mail;
 Mail::to($email)->send(new \App\Mail\SendMail($sentData));