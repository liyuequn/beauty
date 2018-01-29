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
    public function index(Request $request){
        $search =$request->input('search');
        $label =$request->input('label');
        $where = [];
        if($search){
            $where[] = ['title','like',"%$search%"];
        }
        if($label){
            $where[] = ['label','like',"%$label%"];
        }
        $articles = Article::where($where)->take(20)->orderBy('updated_at','post_at','desc')->get();
        var_dump($articles);exit;
        $parseDown = new \Parsedown();
        foreach ($articles as $article){
            $article->content =strip_tags($parseDown->text($article->content));
        }
        return view('index',['articles'=>$articles]);
    }
}


