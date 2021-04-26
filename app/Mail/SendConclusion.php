<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendConclusion extends Mailable
{
    use Queueable, SerializesModels;

    private $path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send-conclusion')->subject('Meet')->attach($this->path,[
            'as' => 'Висновок.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
