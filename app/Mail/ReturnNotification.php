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
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;
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

        return $this->markdown('emails.return-notification')
            ->with(['details' => $this->details])
            ->subject('Return Notice')
            ->withSwiftMessage(function ($message) use ($logoPath) {
                $cid = $message->embed(\Swift_Image::fromPath($logoPath));
                $this->details['logo'] = $cid;
            });
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
