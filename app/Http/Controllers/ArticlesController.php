<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{

    //
    public function store(Request $request)
    {
////        return $request->input('id');
//        $articles = Article::find($request->input('id'));
//        return $articles;

        if($request->input('id')){
             DB::table('articles')->where('id',$request->input('id'))->update($request->all());
            $articles = Article::find($request->input('id'));
        }else{
            $articles = Article::create($request->all());

        }
        return $articles;
    }
}
