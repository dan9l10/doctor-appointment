<?php

namespace App\Http\Controllers\Hospital\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //SELECT users.name,roles.name,model_has_roles.model_id FROM users INNER JOIN model_has_roles on model_has_
        //roles.c=users.id INNER JOIN roles on roles.id=model_has_roles.model_id

        $users = DB::table('users')
            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->join('roles','roles.id','=','model_has_roles.role_id')
            ->select(['users.id','users.name','users.email','roles.name as role'])->orderBy('id')->paginate(10);
        return view('hospital.admin.users.index',compact('users'));//

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $specials = DB::table('specials')->select(['id','name'])->get();
        $roles = DB::table('roles')->select('name')->get();
        return view('hospital.admin.users.add_doctor',compact('specials','roles'));
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
            'name'=>'required:50',
            'email'=>'required|email',
            'password'=>'required|min:8',
            'role'=>'required'
        ]);

        $user = new User([
            'password'=>Hash::make($request->get('password')),
            'email'=>$request->get('email'),
            'name'=>$request->get('name'),
        ]
        );
        $user->assignRole("{$request->get('role')}");
        $result = $user->save();

        if($result){
            return redirect()->route('users.admin.index')
                ->with(['success'=>'Data added']);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $userEdit = DB::table('users')
            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->join('roles','roles.id','=','model_has_roles.role_id')
            ->select(['users.id as id','users.email as email','roles.name as role','users.name as name'])->where('users.id','=',$id)->orderBy('id')->get()->first();
        $roles = DB::table('roles')->select(['name as role'])->orderBy('id')->get();
        return view('hospital.admin.users.edit_user',compact('roles','userEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if(empty($user)) {
            return back()->withErrors(['msg' => "Record with id[$id] not found"])->withInput();
        }
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        if(!empty($request->get('password'))){
            $user->password=Hash::make($request->get('password'));
        }

        $user->assignRole("{$request->get('role')}");

        $result=$user->save();

        if($result){
            return redirect()->route('users.admin.edit',$id)
                ->with(['success'=>'Data added']);
        }else{
            return back()->withErrors(['msg'=>'Error with add'])->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::where('id',$id);
        $result = $user->delete();


        if($result){
            return redirect()->route('users.admin.index')
                ->with(['success'=>'User deleted']);
        }else{
            return back()->withErrors(['msg'=>'Error with delete'])->withInput();
        }

    }
}
