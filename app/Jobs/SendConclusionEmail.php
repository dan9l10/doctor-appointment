<?php

namespace App\Jobs;

use App\Services\Mailer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendConclusionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pathToFile;
    private $recipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pathToFile, $recipient)
    {
        $this->pathToFile = $pathToFile;
        $this->recipient = $recipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->sendConclusion($this->recipient,$this->pathToFile);
    }
}
