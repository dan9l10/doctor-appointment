<?php

namespace App\Services;

use App\Mail\SendConclusion;
use App\Mail\SendTicketMeet;
use App\Mail\WelcomeMessage;
use Illuminate\Support\Facades\Mail;

class Mailer{

    public function sendWelcome($recipient,$data){

        Mail::to($recipient)->send(new WelcomeMessage($data));

    }

    public function sendTicket($recipient,$data,$pathToTicket){

        Mail::to($recipient)->send(new SendTicketMeet($data,$pathToTicket));

    }

    public function sendConclusion($recipient,$pathToConclusion){

        Mail::to($recipient)->send(new SendConclusion($pathToConclusion));

    }
}
