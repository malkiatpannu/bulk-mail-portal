<?php

namespace App\Jobs;

use App\Mail\CampaignEmail;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendCampaignEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Retry attempts.
     */
    public int $tries = 3;

    /**
     * Retry delay.
     */
    public array $backoff = [60, 300, 600];

    /**
     * Campaign instance.
     */
    public Campaign $campaign;

    /**
     * Contact instance.
     */
    public Contact $contact;

    /**
     * Create job.
     */
    public function __construct(
        Campaign $campaign,
        Contact $contact
    ) {
        $this->campaign = $campaign;
        $this->contact = $contact;
    }

    /**
     * Execute job.
     */
    public function handle(): void
    {
        try {

            $template = $this->campaign->template;

            /*
            |--------------------------------------------------------------------------
            | Parse placeholders
            |--------------------------------------------------------------------------
            */

            $subject = $this->parseContent(
                $template->subject
            );

            $body = $this->parseContent(
                $template->body
            );

            /*
            |--------------------------------------------------------------------------
            | Send email
            |--------------------------------------------------------------------------
            */

            Mail::to($this->contact->email)
                ->send(new CampaignEmail(
                    $subject,
                    $body
                ));

            /*
            |--------------------------------------------------------------------------
            | Log success
            |--------------------------------------------------------------------------
            */

            EmailLog::create([
                'campaign_id' => $this->campaign->id,
                'contact_id' => $this->contact->id,
                'status' => 'sent',
                'sent_at' => now(),
            ]);

        } catch (Throwable $exception) {

            /*
            |--------------------------------------------------------------------------
            | Log failure
            |--------------------------------------------------------------------------
            */

            EmailLog::create([
                'campaign_id' => $this->campaign->id,
                'contact_id' => $this->contact->id,
                'status' => 'failed',
                'error_message' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    /**
     * Replace placeholders.
     */
    private function parseContent(
        string $content
    ): string {

        $replacements = [
            '{{name}}' => $this->contact->name,
            '{{email}}' => $this->contact->email,
            '{{phone}}' => $this->contact->phone,
        ];

        /*
        |--------------------------------------------------------------------------
        | Dynamic fields
        |--------------------------------------------------------------------------
        */

        if ($this->contact->custom_fields) {

            foreach (
                $this->contact->custom_fields as $key => $value
            ) {

                $replacements['{{'.$key.'}}'] = $value;
            }
        }

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $content
        );
    }
}