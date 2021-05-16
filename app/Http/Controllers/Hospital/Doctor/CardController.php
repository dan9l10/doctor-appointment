<?php

namespace App\Http\Controllers\Hospital\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index($id){
        $infoMeetForUser = Meet::where('id_user',$id)->where('status',1)->with('times')->with('doctor')->get();

        //dd($infoMeetForUser);
        return view('hospital.user.doctor.index-card',compact('infoMeetForUser'));
    }
}
