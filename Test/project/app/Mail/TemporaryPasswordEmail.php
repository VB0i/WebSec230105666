<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $temporaryPassword;
    public $name;

    public function __construct($temporaryPassword, $name)
    {
        $this->temporaryPassword = $temporaryPassword;
        $this->name = $name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Temporary Password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.temporary_password',
            with: [
                'temporaryPassword' => $this->temporaryPassword,
                'name' => $this->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}