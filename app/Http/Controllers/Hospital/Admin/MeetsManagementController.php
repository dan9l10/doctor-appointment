<?php

namespace App\Http\Controllers\Hospital\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Meet;
use App\Models\Member;
use App\Models\Time;
use Illuminate\Http\Request;

class MeetsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meets = Meet::with('doctor')->with('times')->with('patient')->paginate(5);
        return view('hospital.admin.meet.index',compact('meets'));

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
        //
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
    public function edit($id)
    {
        $meets = Meet::with('doctor')->with('times')->with('patient')->where('id',$id)->get()->first();
        return view('hospital.admin.meet.edit',compact('meets'));
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

        $request->validate([
            'date'=>'required|date',
            'time'=>'required',
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
            return redirect()->route('meets.admin.edit',$id)
                ->with(['success'=>'Data added']);
        }else{
            return back()->withErrors(['msg'=>'Error with add'])->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meet = Meet::findOrFail($id);

        $meet->times->status = 0;
        $tmp = $meet->times->save();

        $result = $meet->delete();

        if($result){
            return redirect()->route('meets.admin.index')
                ->with(['success'=>'Meet deleted']);
        }else{
            return back()->withErrors(['msg'=>'Error with delete'])->withInput();
        }
    }
}
