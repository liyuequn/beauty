@extends('layouts.app')
@section('title','写文章')
@section('content')
    <form action="/fmh" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">输入文章地址</label>
            {{ csrf_field() }}
            <input name="wechat_url" id="article" class="form-control article" placeholder="输入文章地址">
        </div>
        <button type="submit" id="submit" class="btn btn-default">Submit</button>
    </form>
@endsection