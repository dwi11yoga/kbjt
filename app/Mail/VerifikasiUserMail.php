<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiUserMail extends Mailable
{
    use Queueable, SerializesModels;
    // data yang akan digunakan 
    public $user, $url, $kode;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $url, $kode)
    {
        // menggunakan ini agar bisa digunakan oleh variabel dibawahnya
        $this->user = $user;
        $this->url = $url;
        $this->kode = $kode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.verifikasi-user',
            with: [
                'user' => $this->user,
                'url' => $this->url,
                'kode' => $this->kode,
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
