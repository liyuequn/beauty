<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleLabel;
use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $article = Article::find($request->input('id'));
            $article->update($request->all());
        }else{
            $article = Article::create($request->all());
        }
        //1.对比标签，存储
        $labels = explode(',',$request->input('label'));
        $articleLabel = [];
        foreach ($labels as $key => $label){
            $articleLabel[$key]['label_id'] = Label::firstOrCreate(['name'=>$label])->id;
            $articleLabel[$key]['article_id'] = $article->id;
        }
        //2.标签文章关联表
        ArticleLabel::where('article_id','=',$article->id)->delete();
        DB::table('article_label')->insert($articleLabel);
        $article->label = $request->input('label');
        return $article;
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

    public function detailApi($id)
    {
        $article = Article::find($id);
        $labels ='';
        foreach ($article->labels as $label){
            $labels .=  $label->name.',';
        }
        $labels = substr($labels,0,-1);
        $article->label = $labels;
        return $article;
    }
}
