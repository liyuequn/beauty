<style>
    .banner{overflow: hidden;max-height: 300px;}
    .article{overflow:hidden;max-height:500px;width:100%;padding-bottom:25px;padding-top: 17px;background-color: white;border-bottom: 1px solid #f0f0f0;}
    .article-title{color:#333;display: inherit;font-size: 18px;font-weight: 700;line-height: 1.5;}
    .article .abstract{margin-top: 10px;line-height: 24px;overflow:hidden;}
    .article .nickname{margin-left:10px;color: #333;font-size: 16px;}
    .article .tab{background-color: white;border-color: hotpink;}
     article-footer {margin-top: 8px;}
    .article .thmub {margin-top: 18px;float: right;}
    .article .col-md-8 {padding: 0;}
    .article .col-md-4 {padding-right: 0;}
    .right-15{margin-right: 15px;}
</style>
@extends('layouts.app')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div id="carousel-example-generic" class="carousel slide banner" data-ride="carousel">
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
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="false"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="false"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4 visible-lg-* hidden-xs  hidden-sm">
            <div class="panel panel-primary">
                <div class="panel-heading">推荐视频</div>
                <div class="panel-body">
                    <a href="/video/1">绿箭侠</a><br>
                    <a href="/video/2">闪电侠</a><br>
                    <a href="/video/3">吸血鬼日记</a><br>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            @foreach ($articles as $article)
            <div class="article">
                <div class="col-md-8">
                    <img width="40" src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80" class="img-circle" alt="">
                    <a href="" class="nickname">{{$article->user->name}}</a>
                    <span style="margin-left:10px;">{{$article->post_at}}</span>
                    <a class="article-title" href="{{ url("/p/{$article->id}") }}">
                        {{$article->title}}
                    </a>
                    <div class="abstract">
                        {{ mb_substr($article->content,0,206) }}
                        {{mb_strlen($article->content)>206?'...':''}}
                    </div>
                    <div class="article-footer">

                        <button class="btn btn-default btn-xs tab right-15">{{$article->type}}</button>
                        <img  src="{{asset('images/icon/eye.png')}}" width="20" alt="">
                        <span class="right-15">{{$article->hits}}</span>
                        <img  src="{{asset('images/icon/comment.png')}}" width="17" alt="">
                        <span class="right-15">{{$article->comment}}</span>
                        <img  src="{{asset('images/icon/collection.png')}}" width="17" alt="">
                        <span class="right-15">10000</span>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    <img class="thmub"  width="150" src="//upload-images.jianshu.io/upload_images/2206395-3e9a3800e9195ea1.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" alt="">
                </div>
            </div>
                @endforeach

        </div>
        <div class="col-md-4 visible-lg-* hidden-xs  hidden-sm">
            <div class="panel panel-primary">
                <div class="panel-heading">推荐文章</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.carousel').carousel({
            interval: 5000
        })
    </script>
@endsection