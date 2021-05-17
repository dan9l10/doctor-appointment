<?php

namespace App\Http\Controllers\Hospital\User;


use App\Exceptions\InvalidUserPageExeption;
use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\User;
use Image;
use File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index($id)
    {
        if($id != auth()->user()->id){
            throw new InvalidUserPageExeption();
        }
        $userInfo = Member::with('user')->where('user_id',$id)->first();
        $meets = Meet::with('times')->where('id_user',$id)->with('doctor')->orderBy('status')->orderBy('date','asc');
        $countMeet = $meets->count();
        $meets = $meets->paginate(3);
        return view('hospital.user.profile',compact('userInfo','meets'),compact('countMeet'));
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
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->last_name = $request->lastName;
        $user->email = $request->email;

        $user->members->phone = $request->phone;
        $user->members->city = $request->city;
        $user->members->DOB = $request->dob;
        $user->members->weight = $request->weight;
        $user->members->rise = $request->rise;

        $user->save();
        $result = $user->members->save();

        return response()->json($result);
    }
    /**
     * Upload and Update user avatar.
     *
     * @param $file
     *
     * @return mixed
     */
    public function upload(Request $request)
    {
        if($request->file('avatar')){
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
            ]);
            $currentUser = auth()->user();
            $avatar = $request->file('avatar');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path('app/public/avatar/users/id/'.$currentUser->id.'/');
            $path = $save_path.$filename;
            File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(350, 300)->save($path);
            $public_path = '/storage/avatar/users/id/'.$currentUser->id.'/'.$filename;
            $currentUser->members->avatar = $public_path;
            $currentUser->members->save();
            return response()->json(['path' => $public_path], 200);
        }else{
            return response()->json(false, 200);
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
