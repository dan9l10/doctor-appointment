<?php

namespace App\Http\Controllers\Hospital\User;

use App\Http\Controllers\Controller;
use App\Models\Special;
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
        $specials = Special::all(['id','name']);
        return view('hospital.doctors.index',compact('doctorInfo','specials'));

    }

    /**
     * Update doctors use filter
     *
     */
    public function scopeSpecial(Request $request)
    {
        if($request->ajax()){
            if ( $request->has('specials') && $request->specials != '' ) {
                $doctorInfo = Member::with('specials')->with('user')->whereIn('id_spec',$request->specials)->get();
            } else {
                $doctorInfo = Member::with('specials')->with('user')->get();
            }
        }
        return response()->json($doctorInfo);
    }
}
