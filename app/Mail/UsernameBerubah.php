<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UsernameBerubah extends Mailable
{
    use Queueable, SerializesModels;
    
     // data yang akan digunakan
     public $user, $usernameBaru, $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $usernameBaru, $url)
    {
        // menggunakan ini agar bisa digunakan oleh variabel dibawahnya
        $this->user=$user;
        $this->usernameBaru=$usernameBaru;
        $this->url=$url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Username Akun Milikmu Diubah',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $tanggal=Carbon::now();
        return new Content(
            view: 'mail.username-berubah',
            with: [
                'usernameBaru'=>$this->usernameBaru,
                'tanggal'=>$tanggal->translatedFormat('d F Y'),
                'waktu'=>$tanggal->translatedFormat('H:i'),
                'url'=>$this->url
            ]
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
