@extends("admin.layout.master")
@section("content")
    <div class="span9">
        <h1>修改密码</h1>
        <form id="login-form" class="well" method="POST" action="/admin/member/changePassword">

            <div class="panel-body">
                {{csrf_field()}}
                <div class="from-group">
                    <label for="" class="col-sm-2 control-label">原密码</label>
                    <input type="text" name="oldpassword" class="span2" placeholder="" /><br />
                </div>

                <div class="from-group">
                    <label for="" class="col-sm-2 control-label">新密码</label>
                    <input type="text" name="password" class="span2" placeholder="" /><br />
                </div>

                <div class="from-group">
                    <label for="" class="col-sm-2 control-label">确认密码</label>
                    <input type="text" name="password_confirmation" class="span2" placeholder="" /><br />
                </div>
                @if(session("error"))
                    <div class="alert alert-danger">
                        <strong>{{session("error")}}</strong>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">保存修改</button>
        </form>
    </div>
@endsection