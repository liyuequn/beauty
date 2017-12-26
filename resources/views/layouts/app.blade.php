<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('images/icon/Beauty.png')}}" type="image/x-icon"/>
    <script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>@yield('title')</title>
    <style>
        .navbar-brand{border: 1px solid #f0f0f0;height: 66px!important;position: fixed;top:0;z-index:2;background-color: white;  }
        .login{float: right;width: 60px;border-radius:20px;color: white; margin-left: 10px;margin-right: 10px;}
        .register{float: right;width: 60px;border-radius:20px;color: white;margin-left: 10px;margin-right: 10px; }
        .write{float: right;margin-left: 10px;}
        body{background-color: white;}
        .modal-dialog{margin: 130px auto;width: 90%;}
        .input-group{
            margin-top: 20px;
        }
    </style>
    @yield('style')
</head>
<body>
        <div id="app">
            @section('header')
                <header class="nav-justified navbar-brand" id="header">
                    <div class="container" >
                        <a href="{{url('/')}}">Beauty</a>
                        @if(!session('user'))
                            <a href="{{url('/login')}}" class="btn btn-primary login">登录</a>
                            <a href="{{url('/register')}}" class="btn btn-primary register" >注册</a>
                        @endif
                        @if(session('user'))
                            <a href="javascript:;" id="logout" class="btn btn-primary write">退出</a>
                            <a href="{{url('/write')}}" class="btn btn-success write">写文章</a>
                        @endif
                    </div>
                </header>
            @show
            <div class="container" style="margin-top: 66px;">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('js/front.js') }}"></script>
        <script>
            $("#logout").click(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/logout",
                    success: function (msg) {
                        window.location.href = '/';
                        console.log(msg)
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            })
        </script>
        @yield('script')


</body>
</html>