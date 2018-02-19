<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Dashboard - kiwi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    {{--<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">--}}
    <link href="{{ asset('admin/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/site.css') }}" rel="stylesheet">
    @yield("css")
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    {{--<script src="{{ asset('admin/js/jquery.min.js') }}"></script>--}}
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    {{--<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>--}}
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin/js/site.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Akira</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="active">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li>
                            <a href="settings.htm">Account Settings</a>
                        </li>
                        <li>
                            <a href="help.htm">Help</a>
                        </li>
                        <li class="dropdown">
                            <a href="help.htm" class="dropdown-toggle" data-toggle="dropdown">Tours <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="help.htm">Introduction Tour</a>
                                </li>
                                <li>
                                    <a href="help.htm">Project Organisation</a>
                                </li>
                                <li>
                                    <a href="help.htm">Task Assignment</a>
                                </li>
                                <li>
                                    <a href="help.htm">Access Permissions</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li class="nav-header">
                                    Files
                                </li>
                                <li>
                                    <a href="help.htm">How to upload multiple files</a>
                                </li>
                                <li>
                                    <a href="help.htm">Using file version</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search" />
                    </form>
                    <ul class="nav pull-right">

                        <li>
                            <a href="/admin/member/passwordFrom">{{Auth::guard("admin")->user()->name}}</a>
                        </li>
                        <li>
                            <a href="/admin/logout">退出</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include("admin.layout.silde")
        @yield("content")
    </div>
</div>
@include("admin.layout.message")
@include('flash::message')
<script>
    $('#flash-overlay-modal').modal();
</script>
@yield("js")
<script type="text/javascript">
    var uirs = window.location.pathname;
    var objul=document.getElementsByTagName("ul")[3];
    var lis=objul.getElementsByTagName("li");
    for(var i=0;i<lis.length;i++){
            var hrefs=lis[i].getElementsByTagName("a")[0];
            if(hrefs != undefined){
                var sliceNum = hrefs.toString().search("/admin");
                if(hrefs.toString().slice(sliceNum) == uirs){
                    lis[i].className="active"
                }
            }
    }
</script>
</body>
</html>