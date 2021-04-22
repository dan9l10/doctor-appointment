<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Mail\SendTicketMeet;
use App\Models\Analyzes;
use App\Models\Meet;
use App\Models\Member;
use App\Models\Time;
use App\Models\User;
use App\Services\GeneratePdf;
use Illuminate\Http\Request;
use FileUpload;
use Illuminate\Support\Facades\Mail;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, GeneratePdf $pdf, $idDoc)
    {
        //dd($request);
        $request->validate([
            'time'=>'required',
            'date-appointment'=>'required',
            'complaint'=>'max:255',
            //'files'=>'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'
        ]);

        $time = $request->get('time');
        $date = $request->get('date-appointment');
        $complaint = $request->get('complaint');
        $user_id = auth()->user()->id;
        $typeMeet = $request->get('type-meet');

        $times = Time::findOrFail($time);
        $meet = new Meet([
            'id_doc' => $idDoc,
            'id_user' => $user_id,
            'time'=>$time,
            'date'=>$date,
            'complaint'=>$complaint,
            'status'=>0,
            'created_at'=>now(),
            'type'=>$typeMeet,
        ]);

        $doctor = User::with('specials')->findOrFail($idDoc);
        $dataMeet = [
            'date'=>$date,
            'complaint'=>$complaint,
            'time'=>$times->time,
            'doctor_name'=>$doctor->name,
            'doctor_lastname'=>$doctor->last_name,
            'doctor_patronymic'=>$doctor->patronymic,
            'doctor_special'=>$doctor->specials[0]->name,
        ];

        if($typeMeet === 'online'){
            $linkToMeet = "https://meet.jit.si/".uniqid();
            $meet->link = $linkToMeet;
        }else if($typeMeet === 'offline'){
            $pathToFile = $pdf->generateTicket($user_id,$dataMeet);
            $meet->ticket = $pathToFile;
            Mail::to(auth()->user()->email)->send(new SendTicketMeet($dataMeet,$pathToFile));
        }

        if(!$times || $times->status == 1){
            return back()->withErrors(['msg'=>'Запис не додано. Спробуйте ще раз'])->withInput();
        }
        $times->status=1;
        $resultOfSaveMeet = $times->meets()->save($meet);
        if($request->hasFile('files'))
        {
            $files = $request->file('files');
            foreach ($files as $file){
                $path = FileUpload::upload($file);
                if($path){
                    $analyze = new Analyzes([
                        'path'=>$path
                    ]);
                    $resultOfSaveMeet->analyzes()->save($analyze);
                }
            }
        }
        $times->save();

        //

        if($resultOfSaveMeet){
            return redirect()->route('appointment.index',$idDoc)
                ->with(['success'=>'Запис додано. Інформацію можна переглянути у своємо профілі']);
        }else{
            return back()->withErrors(['msg'=>'Запис не додано. Спробуйте ще раз'])->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        if($request->ajax()){
            $meet = Meet::with('times')->with('doctor')->where('id',$request->id)->first();
            return response()->json($meet);
        }
    }


    public function filterMeet(Request $request)
    {
        if($request->ajax())
        {
            $meets = Meet::query();
            $sortBy = $request->get('sorting');
            if($sortBy != null){
                $meets = $meets->where('status',$sortBy);
            }
            $meets = $meets->with('times')->with('doctor');
        }
        $meets = $meets->paginate(3);
        return response()->json(view('hospital.user.show-meets-profile', compact('meets'))->render());
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

        dd($id);
        $request->validate([
            'date'=>'required|date',
            'time'=>'required'
        ]);

        $meet = Meet::findOrFail($id);
        $time = Time::findOrFail($request->get('time'));
        $time->status = 1;
        $time->save();

        $meet->times->status = 0;
        $meet->times->save();
        $meet->date = $request->get('date');
        $meet->time = $request->get('time');

        $result = $meet->save();

        if($result){
            return redirect()->route('user.profile',auth()->user()->id)
                ->with(['success'=>'Data added']);
        }else{
            return back()->withErrors(['msg'=>'Error with add'])->withInput();
        }
        dd($request);
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
