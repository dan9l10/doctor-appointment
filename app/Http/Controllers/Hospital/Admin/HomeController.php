<?php

namespace App\Http\Controllers\Hospital\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $countUsers = User::count();
        $countMeets = Meet::count();

        return view('hospital.admin.index',compact('countUsers','countMeets'));
    }
}
