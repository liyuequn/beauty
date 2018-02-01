<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="laravel,php,PHP框架,linux,mysql,李岳群的博客">
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
        .footer-title{font-size: 16px;}
        .footer{background-color: #3798CF;min-height: 200px;color: white;padding: 20px 0px 20px 0px ;width: 100%;text-align: center;}
        body,html{height: 100%;}
    </style>
    @yield('style')
</head>
<body>
        <div id="app" style="height: 100%;">
            @section('header')
                <a href="top"></a>
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
                                            <li><a href="/user/center"><img width="20" src="{{asset('images/icon/user.png')}}" alt=""> 个人中心</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:;" id="logout"> <img width="20" src="{{asset('images/icon/logout.png')}}" alt=""> 退出</a></li>
                                        </ul>
                                    </div>
                                    <a href="{{url('/write')}}" class="btn btn-success write">写文章</a>
                                @endif
                        </div>
                        {{--大屏幕时显示--}}
                        @if(Request::path()=='/')
                        <el-input  name="search1" class="visible-lg-12 visible-md-12 hidden-xs" value="{{$search?$search:''}}" placeholder="搜索" style="float: left;width: 50%;margin: 14px 0 0 5%;">
                            <el-button class="search1" slot="append" icon="el-icon-search"></el-button>
                        </el-input>
                        {{--小屏幕时显示--}}
                        <el-input name="search2" v-if="" class="hidden-lg hidden-md hidden-sm visible-xs-12" value="{{$search?$search:''}}" style="margin: 0 0 10px 0" placeholder="搜索">
                            <el-button class="search2"  slot="append" icon="el-icon-search"></el-button>
                        </el-input>
                        @endif
                    </div>
                </header>
            @show
            <div class="container" style="margin:120px auto 0px;min-height: 100%;height: auto!important;">
            @yield('content')
                <div id="toTop" style="position: fixed;right: 100px;bottom: 181px;right: 10%;display: none;">
                    <a href="#top" class="btn btn-primary">返回顶部</a>
                </div>
                <div style="height: 270px;"></div>
            </div>
            @yield('footer')
            <div class="footer" style="margin-top: -200px;">
                    <div style="bottom: 0px;text-align: center;margin-top: 4%;">
                        本博客致力于技术的锻炼和总结，作为一名独立开发者，初衷是想把所有的先进技术都能从本博客上进行演练，并分享出来。
                        Designed by liyuequn
                    </div>
                </div>
        </div>
        <script src="{{ asset('js/front.js') }}"></script>
        <script>
            $(document).ready(function(){
                var wh=$(window).height();
                $(window).scroll(function() {
                    if($(window).scrollTop()>500){
                        $("#toTop").fadeIn();
                    }else{
                        $("#toTop").fadeOut();
                    }
                });
            });
            $(function () {
                $("input[name='search1']").keydown(function(event) {
                    if (event.keyCode == 13) {
                        window.location.href="?search="+$("input[name='search1']").val();
                    }
                })
                $(".search1").click(function () {
                    window.location.href="?search="+$("input[name='search1']").val();
                })
                $("input[name='search2']").keydown(function(event) {
                    if (event.keyCode == 13) {
                        window.location.href="?search="+$("input[name='search2']").val();
                    }
                })
                $(".search2").click(function () {
                    window.location.href="?search="+$("input[name='search2']").val();
                })
                $("#logout").click(function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "/logout",
                        success: function (msg) {
                            sessionStorage.removeItem('userId');
                            sessionStorage.removeItem('userInfo');
                            sessionStorage.removeItem('access_token')
                            sessionStorage.removeItem('refresh_token')
                            sessionStorage.removeItem('token_type')
                            window.location.href = '/';
                            console.log(msg)

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                })
            })

        </script>
        @yield('script')


</body>
</html>