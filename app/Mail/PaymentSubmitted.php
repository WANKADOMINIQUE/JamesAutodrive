<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $payment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[James AutoDrive] New Payment – ' . $this->payment['ref_number'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment',
            with: ['payment' => $this->payment],
        );
    }
}
