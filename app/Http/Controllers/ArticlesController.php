<?php

namespace App\Http\Controllers;

use App\Article;
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
             DB::table('articles')->where('id',$request->input('id'))->update($request->all());
            $articles = Article::find($request->input('id'));
        }else{
            $articles = Article::create($request->all());
        }
        return $articles;
    }

}
