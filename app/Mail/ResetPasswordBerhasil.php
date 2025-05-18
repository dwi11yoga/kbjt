<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordBerhasil extends Mailable
{
    use Queueable, SerializesModels;

    // data yang akan digunakan 
    public $user, $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $url)
    {
        // menggunakan ini agar bisa digunakan oleh variabel dibawahnya
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kata Sandi Akun Kamu Telah Diperbarui',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $tanggal = Carbon::now();
        return new Content(
            view: 'mail.reset-password-berhasil',
            with: [
                'user' => $this->user,
                'url' => $this->url,
                'tanggal' => $tanggal->translatedFormat('d F Y'),
                'waktu' => $tanggal->format('H:i'),
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
