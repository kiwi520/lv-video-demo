<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class BaseController extends Controller
{

    public function __construct(){

        if (!Auth::guard("admin")->check()) {
            return view("admin.entry.login");
        }
    }

    public function logout(){
        Auth::guard("admin")->logout();
        return redirect("admin/entry/login");
    }
}
