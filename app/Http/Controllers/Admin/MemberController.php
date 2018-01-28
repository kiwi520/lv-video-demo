<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminMemberRequest;
use Auth;
class MemberController extends BaseController
{


    public function passwordFrom(){
        return view("admin.member.passwordFrom");
    }

    public function changePassword(AdminMemberRequest $request){
        $model = Auth::guard("admin")->user();
        $model->password = bcrypt($request->input("password"));
        $model->save();
        flash('密码修改成功！！！')->overlay();

        return redirect()->back();
    }



}
