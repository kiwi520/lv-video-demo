<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;

class EntryController extends BaseController
{
    public function index(){
        dd(Auth::guard("admin")->user()->name);
    }


    public function loginFrom(){
        return view("admin.entry.login");
    }

    public function login(Request $request){

        $status = Auth::guard("admin")->attempt([
            "name" => $request->input("username"),
            "password" => $request->input("password"),
        ]);
        if ($status) {
            return redirect("/admin/index/index");
        }

        return redirect("/admin/entry/login")->with("error","用户名或密码错误");
    }
}
