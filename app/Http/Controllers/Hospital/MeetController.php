<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;

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
    public function store(Request $request, $idDoc)
    {

        $request->validate([
            'time'=>'required',
            'date-appointment'=>'required',
            'complaint'=>'min:30|max:255',
        ]);

        $time = $request->get('time');
        $date = $request->get('date-appointment');
        $complaint = $request->get('complaint');
        $user_id = auth()->user()->id;

        $meet = new Meet([
            'id_doc' => $idDoc,
            'id_user' => $user_id,
            'time'=>$time,
            'date'=>$date,
            'complaint'=>$complaint,
            'status'=>0,
            'created_at'=>now(),
        ]);

        $resultOfSaveMeet = $meet->save();

        if($resultOfSaveMeet){
            return redirect()->route('appointment.index',$idDoc)
                ->with(['success'=>'Запись добавлена']);
        }else{
            return back()->withErrors(['msg'=>'Error with add'])->withInput();
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
