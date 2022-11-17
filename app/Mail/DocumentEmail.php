<?php

namespace App\Mail;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DocumentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $organization_name;
    public $document_path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($organization_name, $document_path)
    {
        $this->organization_name = $organization_name;
        $this->document_path = $document_path;
    }

    /**
     * Get the attachments for the message.
     *
     * @return \Illuminate\Mail\Mailables\Attachment[]
     */
    public function attachments()
    {
        return [
            Attachment::fromStorage($this->document_path),
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.document')
                    ->subject("Attached Document");
    }
}
