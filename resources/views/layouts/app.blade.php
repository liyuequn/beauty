<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('images/icon/Beauty.png')}}" type="image/x-icon"/>
    <script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>@yield('title')</title>
    <style>
        .navbar-brand{border: 1px solid #f0f0f0;height: 66px!important;position: fixed;top:0;z-index:2;background-color: white;  }
        .login{float: right;width: 60px;border-radius:20px;color: white; margin-left: 10px;margin-right: 10px;}
        .register{float: right;width: 60px;border-radius:20px;color: white;margin-left: 10px;margin-right: 10px; }
        body{background-color: white;}
    </style>
</head>
<body>
    @section('header')
        <header class="nav-justified navbar-brand">
            <div class="container">
                <a href="{{url('/')}}">Beauty</a>
                <a href="" class="btn btn-primary login">登录</a>
                <a href="" class="btn btn-primary register">注册</a>
            </div>
        </header>
    @show

    <div class="container" style="margin-top: 66px;">
        @yield('content')
    </div>
</body>
</html>