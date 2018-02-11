<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\models\Article;

class ArticlesController extends Controller
{
    /**
     *
     */
    public function show($id){
        $article = Article::find($id);
        Article::where('id',$id)->update(['hits'=>$article->hits+1]);
        $Parsedown = new \Parsedown();
        $article->content =  $Parsedown->text($article->content);
        return view('article.index',['article'=>$article]);
    }
}
