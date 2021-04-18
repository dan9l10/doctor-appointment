<?php

namespace App\Http\Controllers\Hospital\User;

use App\Http\Controllers\Controller;
use App\Models\Special;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $doctors = User::select('id')->role('doctor')->get()->toArray();
        $doctorInfo = Member::whereIn('user_id',$doctors)->paginate(3);
        $specials = Special::select('id','name')->orderBy('name', 'ASC')->get();
        return view('hospital.doctors.index',compact('doctorInfo','specials'));
    }

    /**
     * Update doctors use filter
     *
     */
    public function scopeSpecial(Request $request)
    {
        if($request->ajax())
        {
            $specials = $request->get('specials');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $doctorInfo = Member::query();
            if ($specials != null) {
                $doctorInfo = $doctorInfo->whereHas("specials", function ($query) use ($specials) {
                    $query->whereIn('id_spec',  $specials);
                });
            }

            if($query != null){
                $users = User::select('id')
                    ->where('Name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%')
                    ->orWhere('patronymic', 'like', '%' . $query . '%')
                    ->role('doctor')->get()->toArray();
                $doctorInfo = $doctorInfo->whereIn('user_id',$users);
            }

            if($specials == null && $query == null){
                $doctors = User::select('id')->role('doctor')->get()->toArray();
                $doctorInfo = Member::whereIn('user_id',$doctors);
            }

        }
        $doctorInfo = $doctorInfo->with('specials')->with('user')->paginate(3);
        return response()->json(view('hospital.doctors.doctor-data', compact('doctorInfo'))->render());
    }

    /**
     * Search doctor
     *
     */
    public function scopeDoctor(Request $request)
    {
        if($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $doctors = User::select('id')
                    ->where('Name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%')
                    ->orWhere('patronymic', 'like', '%' . $query . '%')
                    ->role('doctor')->get()->toArray();
                $data = Member::with('specials')->with('user')->whereIn('user_id',$doctors)->get();
            }
            else {
                $doctors = User::select('id')->role('doctor')->get()->toArray();
                $data = Member::with('specials')->with('user')->whereIn('user_id',$doctors)->get();
            }

        }
        return response()->json($data);
    }
}
