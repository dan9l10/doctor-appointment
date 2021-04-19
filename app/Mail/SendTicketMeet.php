<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketMeet extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$path)
    {
        $this->data = $data;
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send-ticket',['data'=>$this->data])->subject('Meet')->attach($this->path,[
            'as' => 'ticket.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
