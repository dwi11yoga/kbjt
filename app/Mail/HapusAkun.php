<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HapusAkun extends Mailable
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
            subject: 'Akun kamu telah dihapus',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $tanggal = Carbon::now();
        return new Content(
            view: 'mail.hapus-akun',
            with: [
                'user' => $this->user,
                'url' => $this->url,
                'tanggal' => $tanggal->translatedFormat('d F Y'),
                'waktu' => $tanggal->format('H:i')
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
