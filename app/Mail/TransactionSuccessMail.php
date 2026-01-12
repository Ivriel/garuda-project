<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transaction Successfull - Boarding Pass',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.success',
            with: ['transaction' => $this->transaction]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $qrCodeUrl = 'data:image/png;base64,'.base64_encode(file_get_contents('https://api.qserver.com/v1/create-qr-code/?size=150x150&data='.$this->transaction->code));

        $pdf = Pdf::loadView('pdf.boading.pass', [
            'transaction' => $this->transaction,
            'qrCode' => $qrCodeUrl,
        ]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(), 'boarding-pass.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
