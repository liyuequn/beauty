<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页包括文章资源
     */
    public function index(){
        $where = [];
        $articles = Article::where($where)->take(20)->orderBy('post_at','desc')->get();
        return view('index',['articles'=>$articles]);
    }
}
