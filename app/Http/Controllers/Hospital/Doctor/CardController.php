<?php

namespace App\Http\Controllers\Hospital\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index($id){
        $infoMeetForUser = Meet::where('id_user',$id)->with('times')->with('doctor')->get();
        dd($infoMeetForUser);
    }
}
