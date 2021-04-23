<?php

namespace App\Http\Controllers\Hospital\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\User;
use App\Services\Checker;
use Illuminate\Http\Request;

class AppointmentManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::role('doctor')->with('specials')->with('members')->get();
        return view('hospital.admin.appointment.index',compact('doctors'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor'=>'required',
            'date'=>'required|date',
            'time'=>'required',
        ]);

        $docId = $request->get('doctor');
        $date = $request->get('date');

        $chekAppointmenfForDoctor = (new Checker())->checkAppointmentForDoctor($docId,$date);

        if($chekAppointmenfForDoctor){
            return back()->withErrors(['msg'=>'Цей доктор має розклад на цю дату'])->withInput();
        }

        $appointment = Appointment::create([
            'doc_id'=>$docId,
            'date'=>$date,
        ]);

        foreach ($request->get('time') as $time){
            $time = new Time([
                'status'=>0,
                'time'=>$time,
            ]);
            $appointment->times()->save($time);
        }

        $result = $appointment->save();

        if($result){
            return redirect()->route('appointments.admin.index')
                ->with(['success'=>'Графік створений']);
        }else{
            return back()->withErrors(['msg'=>'Помилка при створенні графіку'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$appointments = Appointment::with('times')->where([
            ['date','2021-04-22'],
            ['doc_id','2']
        ])->first();
        dd($appointments);*/
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
