<?php

namespace App\Http\Controllers\Hospital\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Services\PathCreator;
use Illuminate\Http\Request;

class ControlAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_doc = auth()->user()->id;

        $meets = Meet::where('id_doc',$id_doc)->with('patient')->with('times')->get();
        return view('hospital.user.doctor.show-patient',compact('meets'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $meets = Meet::where('id',$id)->with('patient')->with('times')->with('analyzes')->first();
        $paths = $meets->analyzes->pluck('path');
        $pinnedFiles = (new PathCreator())->splitPath($paths);
        $extensionClassesImg =[
            'pdf'=>'fa-file-pdf-o',
            'doc'=>'fa-file-word-o',
            'jpg'=>'fa-file-image-o',
            'jpeg'=>'fa-file-image-o',
            'png'=>'fa-picture-o',
            'docx'=>'fa-file-word-o',
        ];
        return view('hospital.user.doctor.show-info-appointment',['pinnedFiles'=>$pinnedFiles,'extensionsClass'=>$extensionClassesImg],compact('meets'));
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
        $meet = Meet::findOrFail($id);

        if (!is_null($request->get('status'))){
            $meet->status = $request->get('status');
        }
        $meet->diagnosis = $request->get('diagnosis');
        $result = $meet->save();

        if($result){
            return redirect()->route('patient.doctor.index')->with(['success'=>'Дані зменені']);
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
        //
    }
}
