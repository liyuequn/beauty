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
        $articles = Article::where($where)->take(20)->orderBy('updated_at','post_at','desc')->get();
        $parseDown = new \Parsedown();
        foreach ($articles as $article){
            $article->content =strip_tags($parseDown->text($article->content));
        }
        return view('index',['articles'=>$articles]);
    }
}
