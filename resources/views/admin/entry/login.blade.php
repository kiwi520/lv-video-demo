<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Login - kiwi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link href="{{ asset('admin/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/site.css') }}" rel="stylesheet">
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div id="login-page" class="container">
    <h1>kiwi System</h1>
    <form id="login-form" class="well" method="POST" action="/admin/entry/loginFrom">
        {{csrf_field()}}
        <input type="text" name="username" class="span2" placeholder="username" /><br />
        <input type="password" name="password" class="span2" placeholder="Password" /><br />
        @if(session("error"))
            <div class="alert alert-danger">
                <strong>{{session("error")}}</strong>
            </div>
        @endif
        <label class="checkbox"> <input type="checkbox" /> 记住我 </label>
        <button type="submit" class="btn btn-primary">登陆</button>
        <button type="submit" class="btn">忘记密码</button>
    </form>
</div>
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/site.js') }}"></script>
</body>
</html>
