<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('images/icon/Beauty.png')}}" type="image/x-icon"/>
    <title>@yield('title')</title>
    <style>
        .navbar-brand1{border: 1px solid #f0f0f0;position: fixed;height:auto;top:0;z-index:2;background-color: white;  }
        .login{width: 60px;border-radius:20px;color: white; margin:15px 10px 15px 10px}
        .register{width: 60px;border-radius:20px;color: white;margin-left: 10px;margin-right: 10px; }
        body{background-color: white;}
        .user{height: 100%;background-color: white;border: none;}
        .user:hover{background-color: #f5f5f5}
        .logo{float: left;line-height:66px;font-size:22px;}
        .person-center{float: right;height: 100%;}
        .person-center >.dropdown{float: left;height:66px;margin-right: 20px;}
        .write{float: left;height: 50px;margin-top: 8px;line-height: 34px;font-size: 16px;}
        .footer{margin: 100px 15% 100px 15%}
    </style>
    @yield('style')
</head>
<body>
        <div id="app">
            @section('header')
                <header class="nav-justified navbar-brand1" id="header">
                    <div class="container">
                        <div class="logo">
                            <a href="{{url('/')}}">Beauty</a>
                        </div>
                        <div class="person-center">
                            @if(!session('user'))
                                <a href="{{url('/login')}}" class="btn btn-primary login">登录</a>
                                <a href="{{url('/register')}}" class="btn btn-primary register" >注册</a>
                            @endif
                            @if(session('user'))
                                    <div class="dropdown">
                                        <button class="dropdown-toggle user"  type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <a href="javascript:;">
                                                <img width="36"  src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80" alt="" class="img-circle">
                                            </a>
                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu" style="min-width: 0px!important;" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><img width="20" src="{{asset('images/icon/user.png')}}" alt=""> 个人中心</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:;" id="logout"> <img width="20" src="{{asset('images/icon/logout.png')}}" alt=""> 退出</a></li>
                                        </ul>
                                    </div>
                                    <a href="{{url('/write')}}" class="btn btn-success write">写文章</a>

                                @endif
                        </div>

                    </div>
                </header>
            @show
            <div class="container" style="margin-top: 70px;">
            @yield('content')
            </div>
            @yield('footer')
            <div class="footer">
                到底了。我是网站底部。
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