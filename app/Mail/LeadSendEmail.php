<?php
namespace App\Mail;

use App\Models\SentEmails;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class LeadSendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $leadMail;

    public function __construct(SentEmails $leadMail)
    {
        $this->leadMail = $leadMail;
    }

    public function build()
    {
        $email = $this->subject($this->leadMail->subject)
                      ->view('emails.lead_mail')
                      ->with([
                          'description' => $this->leadMail->body,
                          'subject' => $this->leadMail->subject,
                      ]);

                    if (!empty($this->leadMail->attachments)) {
                        foreach ($this->leadMail->attachments as $file) {
                            $email->attach(public_path('uploads/leads/email_attachments/' . $file));
                        }
                    }

        return $email;
    }
}

?>