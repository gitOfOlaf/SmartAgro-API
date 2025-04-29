<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $str_random_password;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $str_random_password)
    {
        $this->user = $user;
        $this->str_random_password = $str_random_password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if (config('services.app_environment') == 'DEV') {
            return new Envelope(
                subject: 'Recuperación de contraseña - SmartAgro - DEV',
            );
        } else {
            return new Envelope(
                subject: 'Recuperación de contraseña - SmartAgro',
            );
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recover_password_user',
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
