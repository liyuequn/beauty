<style>
    .navbar-brand{border: 1px solid #f0f0f0;height: 66px!important;position: fixed;top:0;z-index:2;background-color: white;  }
    .login{float: right;width: 60px;border-radius:20px;color: white; }
    .banner{overflow: hidden;max-height: 300px;}
    .article{overflow:hidden;min-height:280px;max-height:500px;height:20%;width:100%;padding-bottom:0%;padding-top: 25px;background-color: white;border-bottom: 1px solid #f0f0f0;}
    .recommend-author{height: 500px;margin-left: 30px;background-color: #66afe9 }
    .article .title{color:#333;display: inherit;font-size: 18px;font-weight: 700;line-height: 1.5;}
    .article .abstract{margin-top: 10px;line-height: 24px;}
    .article .nickname{margin-left:10px;color: #333;font-size: 16px;}
</style>
@extends('layouts.app')
@section('title', 'Index')
@section('header')
    <header class="nav-justified navbar-brand">
        <div class="container">
            <a href="">Beauty</a>
            <a href="" class="btn btn-primary login">登录</a>
        </div>
    </header>
@endsection
@section('content')
    <div class="row">
        <div id="carousel-example-generic" class="carousel slide banner" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512116377644&di=671380ec5ab6c5795bc3797af929909a&imgtype=0&src=http%3A%2F%2Fimage.tianjimedia.com%2FuploadImages%2F2014%2F340%2F24%2F2EOENARNOWUU_1000x500.jpg" alt="...">
                        <div class="carousel-caption">

                        </div>
                    </div>
                    <div class="item">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512118118295&di=bc8089d9d5ac8c2cb76e2fba760a7cca&imgtype=jpg&src=http%3A%2F%2Fimg3.imgtn.bdimg.com%2Fit%2Fu%3D199734178%2C804954580%26fm%3D214%26gp%3D0.jpg" alt="">
                        <div class="carousel-caption">

                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
    <div class="row">
        <div class="col-md-8" style="background-color:white">
            <div class="article" style="">
                <div class="col-md-9">
                    <img width="40" src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80" class="img-circle" alt="">
                    <a href="" class="nickname">author</a>
                    <span style="margin-left:10px;">2017-11-01</span>
                    <a class="title" >
                        彩礼记：一道90后必须跨过的千年门槛
                    </a>
                    <span class="abstract">
                    01 毕业这些年，我参加同学好友婚礼的次数越来越频繁。 这些当年还是小花童的90后们现在都已经成为婚礼现场的主角，他们走在婚礼的红毯上，穿着西装和婚纱，在亲朋好友面前接受祝福...
                    </span>
                    <div class="footer" style="position: relative;">
                        <button class="btn-sm btn-default">生活</button>
                    </div>
                </div>
                <div class="col-md-3">
                </div>

            </div>
            <div class="article">
                <span>author</span>
                <span>2017-11-01</span>
            </div>
            <div class="article">
                <span>author</span>
                <span>2017-11-01</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="recommend-author">

            </div>
        </div>
    </div>
    <script>
        $('.carousel').carousel({
            interval: 5000
        })
    </script>
@endsection