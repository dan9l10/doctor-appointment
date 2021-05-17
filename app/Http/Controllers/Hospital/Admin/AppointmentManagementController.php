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

        $chekAppointmentForDoctor = (new Checker())->checkAppointmentForDoctor($docId,$date);

        if($chekAppointmentForDoctor){
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit()
    {
        $doctors = User::role('doctor')->get();
        return view('hospital.admin.appointment.edit',compact('doctors'));
    }

    public function getAppointmentTimeToAdd(Request $request){


        $times = ['09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00',
            '16:30','17:00','17:30','18:00'];

        $appointments = Appointment::where([
            ['date',$request->get('date')],
            ['doc_id',$request->get('idDoc')]
        ])->first();

        if(!$appointments){
            return response()->noContent();
        }

        $arr = [];
        foreach ($appointments->times as $time){
            $arrayNumbers = explode(':',$time->time);
            array_pop($arrayNumbers);
            $ImplodeTime = implode(':',$arrayNumbers);
            array_push($arr,$ImplodeTime);
        }

        $result = array_diff($times,$arr);

        /*foreach ($appointments->times as $time){
            if ($time->status == 0){
                $time->delete();
            }
        }*/
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $appointment = Appointment::where([
            ['date',$request->get('date')],
            ['doc_id',$request->get('doctor')]
        ])->first();
        foreach ($request->get('time') as $time){
            $newTime = new Time([
                'status'=>0,
                'time'=>$time,
            ]);
            $appointment->times()->save($newTime);
        }

        return redirect()->route('admin.appointment.edit')
            ->with(['success'=>'Data added']);
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
