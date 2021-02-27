<?php

namespace App\Http\Controllers\Hospital\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $countUsers = DB::table('users')->count();
        return view('hospital.admin.index',compact('countUsers'));
    }
}
