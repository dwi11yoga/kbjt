<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailBerubah extends Mailable
{
    use Queueable, SerializesModels;

    // data yang akan digunakan
    public $user, $emailBaru, $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $emailBaru, $url)
    {
        // menggunakan ini agar bisa digunakan oleh variabel dibawahnya
        $this->user = $user;
        $this->emailBaru = $emailBaru;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alamat email akun anda berubah',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $tanggal = Carbon::now();
        return new Content(
            view: 'mail.email-berubah', //view yang akan dikirim
            with: [ // data yang akan dikirim ke view
                'user' => $this->user,
                'emailBaru' => $this->emailBaru,
                'tanggal' => $tanggal->translatedFormat('d F Y'),
                'waktu' => $tanggal->format('H:i'),
                'url' => $this->url
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
