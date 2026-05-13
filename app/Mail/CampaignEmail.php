<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email subject.
     */
    public string $emailSubject;

    /**
     * Email body.
     */
    public string $emailBody;

    /**
     * Create instance.
     */
    public function __construct(
        string $emailSubject,
        string $emailBody
    ) {
        $this->emailSubject =   $emailSubject;
        $this->emailBody    =   $emailBody;
    }

    /**
     * Build message.
     */
    public function build(): self
    {
        return $this->subject($this->emailSubject)
            ->view('emails.campaign');
    }
}