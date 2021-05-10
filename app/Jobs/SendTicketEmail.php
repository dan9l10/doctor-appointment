<?php

namespace App\Jobs;

use App\Services\Mailer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pathToFile;
    private $recipient;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pathToFile, $recipient, $data)
    {
        $this->pathToFile = $pathToFile;
        $this->recipient =  $recipient;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->sendTicket($this->recipient,$this->data,$this->pathToFile);
    }
}
