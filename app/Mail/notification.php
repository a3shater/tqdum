<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;


class notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $email, public $title, public array $content)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->to_email(),
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd($this->content);
        return new Content(
            view: 'mail',
            with: $this->content
        );
    }

    public function to_email(): array
    {
        // $arr = [new Address("a.3.shater@gmail.com"), new Address("a.3.shater@outlook.com")];
        // $arr = [new Address("a.3.shater@gmail.com")];
        $arr = [];
        foreach ($this->email as $email) {
            $arr[] = new Address($email);
        }
        return $arr;
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
