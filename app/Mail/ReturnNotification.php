<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use Swift_Image;

class ReturnNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $logo;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    public function build()
    {
        $logoPath = public_path('images/logo.png');

        $this->withSwiftMessage(function ($message) use ($logoPath) {
            $this->logo = $message->embed(Swift_Image::fromPath($logoPath));
        });

        return $this->markdown('emails.return-notification')
            ->with([
                'details' => $this->details,
                'logo'    => $this->logo, // pass the CID string to Blade
            ])
            ->subject('Return Notice');
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('nicolejose.perez@nmsc.edu.ph','CICT Equipment Borrower'),
            subject: 'Return Notice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.return-notification',
            with: ['details' => $this->details]
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
