<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bodyText;
    public $subjectText;
    public $file;

    public function __construct($subjectText, $bodyText, UploadedFile $file = null)
    {
        $this->subjectText = $subjectText;
        $this->bodyText    = $bodyText;
        $this->file        = $file;
    }

    public function build()
    {
        $mail = $this->subject($this->subjectText)
                     ->markdown('emails.welcome')
                     ->with([
                         'bodyText' => $this->bodyText,
                     ]);

        if ($this->file) {
            $mail->attach($this->file->getRealPath(), [
                'as'   => $this->file->getClientOriginalName(),
                'mime' => $this->file->getMimeType(),
            ]);
        }

        return $mail;
    }
}
