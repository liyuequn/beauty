<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_label;
use App\Label;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * @param Request $request
     * @return \App\Http\Resources\ArticleCollection
     */
    public function index(Request $request)
    {
        $where = [];
        $type = $request->input('type');
        $title = $request->input('title');
        $pageSize = $request->input('pageSize');
        if($title){
            $where[] = ['title','like',"$title%"];
        }
        if($type){
            $where[] = ['type','=',$type];
        }
        return new \App\Http\Resources\ArticleCollection
        (
            \App\Article::where($where)->orderBy('created_at','desc')->paginate($pageSize)
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if($request->input('id')){
            $articles = Article::find($request->input('id'));
            $articles->update($request->all());
        }else{
            $articles = Article::create($request->all());
        }
        //1.对比标签，存储
        $labels = explode(',',$request->input('label'));
        $label_ids = [];
        foreach ($labels as $label){
            $label_ids[] = Label::firstOrCreate($label);
        }
        //2.标签文章关联表
        Article_label::Create();

        return $articles;
    }

    /**
     *
     */
    public function detail($id){
        $article = Article::find($id);
        $Parsedown = new \Parsedown();
        $article->content =  $Parsedown->text($article->content);
        return view('article.index',['article'=>$article]);
    }

}
