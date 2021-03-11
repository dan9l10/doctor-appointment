<?php

namespace App\Http\Controllers\Hospital\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Member;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $doctorInfo = User::role('doctor')->with('specials')->with('members')->get();
        return view('hospital.doctors.index',compact('doctorInfo'));

    }
}
