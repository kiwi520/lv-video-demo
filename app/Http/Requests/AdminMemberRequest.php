<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard("admin")->check();
    }

    public function addCheckPassword(){
        //验证用户密码是否正确
        Validator::extend("check_passwd",function ($attribute,$value,$parameters,$validator){
            return Hash::check($value,Auth::guard("admin")->user()->password);
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->addCheckPassword();
        return [
            "password"=>"sometimes | required | confirmed",
            "oldpassword"=>"sometimes | required | check_passwd",
            "password_confirmation"=>"sometimes | required",
        ];
    }

    public function messages()
    {
        return [
            "password.required" =>"密码不能为空",
            "password.confirmed" =>"两次密码输入不一致",
            "oldpassword.check_passwd" =>"原密码输入错误",
            "oldpassword.required" =>"原密码输入不能为空",
            "password_confirmation.required" =>"确认密码不能为空",
        ];
    }
}
