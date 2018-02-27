<style>
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
    <div class="row" style="margin-top: 50px;">
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
                        <a href="{{ url("/p/{$article->id}") }}">
                            {{ mb_substr($article->content,0,206) }}
                            {{mb_strlen($article->content)>206?'...':''}}
                        </a>
                    </div>
                    <div class="article-footer">

                        <button class="btn btn-default btn-xs tab right-15">{{$article->type}}</button>
                        <img  src="{{asset('images/icon/eye.png')}}" width="20" alt="">
                        <span class="right-15">{{$article->hits}}</span>
                        <img  src="{{asset('images/icon/comment.png')}}" width="17" alt="">
                        <span class="right-15">{{$article->countComments($article->id)?$article->countComments($article->id):0}}</span>
                        <img  src="{{asset('images/icon/collection.png')}}" width="17" alt="">
                        <span class="right-15">1000</span>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    <img class="thmub"  width="150" src="//upload-images.jianshu.io/upload_images/2206395-3e9a3800e9195ea1.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" alt="">
                </div>
            </div>
            @endforeach
            <apend></apend>
        </div>
        <div class="col-md-4 visible-lg-* hidden-xs  hidden-sm">
            <div class="panel panel-primary">
                <div class="panel-heading">推荐资源</div>
                <div class="panel-body">
                    @foreach($books as $book)
                        <a  style="height: inherit"  href="{{$book->path}}">{{$book->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">热门标签</div>
                <div class="panel-body" style="line-height: 45px;">
                    @foreach($labels as $key => $label)
                        <a   class="btn btn-info btn-sm" style="height: inherit" href="/articles/{{$label->NAME}}">{{$label->NAME}}</a>
                        @if($key%5 == 4)
                            <div style="clear: both;">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">推荐文章</div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($recommendArticle as $item)
                            <li class="list-group-item"><a href="{{url("/p/{$item->id}")}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection