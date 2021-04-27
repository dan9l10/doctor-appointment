<?php

namespace App\Http\Controllers\Hospital;

use App\Exceptions\InvalidIdDoctorExeption;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index($id)
    {
        $member = Member::findOrFail($id);
        $appointments=$member->with('appointments')->with('user')->with('specials')
            ->where('user_id',$id)->first();

        if(is_null($appointments->specials) ){
            throw new InvalidIdDoctorExeption();
        }
        return view('hospital.appointment.index',compact('appointments'));

    }


    public function returnAppointmentsTime(Request $request)
    {
        $data= '';
        if($request->ajax()) {

            $query = $request->get('date');
            if ($query != '') {
                $data = Appointment::with('times')->where('date',$request->get('date'))->where('doc_id',$request->get('id'))->get();

            } else {
                $data = null;
            }
        }
        return response()->json($data);
    }

    public function returnAppointmentsAvailableDate(Request $request)
    {
        $data= '';
        if($request->ajax()) {
            $idDoc = $request->get('id_doc');
            if($idDoc) $data = Appointment::select('date')->where('doc_id',$idDoc)->get();
        }
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->get('time'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
