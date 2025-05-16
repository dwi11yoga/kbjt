<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserDiblokir extends Mailable
{
    use Queueable, SerializesModels;

    // data yang akan digunakan
    public $user, $kontribusi, $laporan, $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $kontribusi, $laporan, $url)
    {
        // menggunakan ini agar bisa digunakan oleh variabel dibawahnya
        $this->user = $user;
        $this->kontribusi = $kontribusi;
        $this->laporan = $laporan;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun kbjt kamu diblokir',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $tanggal = Carbon::now();
        return new Content(
            view: 'mail.akun-diblokir',
            with: [
                'user' => $this->user,
                'kontribusi' => $this->kontribusi,
                'laporan' => $this->laporan,
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
