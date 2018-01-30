<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 首页包括文章资源
     */
    public function index(Request $request){
        $search =$request->input('search');
        $articles = Article::whereHas(
            'labels', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->take(20)->orderBy('updated_at','post_at','desc')->get();
        $where = [];
        //推荐文章
        $recommendArticles = Article::where($where)->take(5)->orderBy('hits','desc')->get();
        //热门标签
        $labels = DB::connection('mysql')->select("SELECT count(label_id) AS num ,labels. NAME FROM labels INNER JOIN article_label al ON labels.id = al.label_id GROUP BY
	    label_id ORDER BY num DESC,labels.created_at limit 10");
//        var_dump($labels);exit;
        //parseDown处理markdown的格式
        $parseDown = new \Parsedown();
        foreach ($articles as $article){
            $article->content =strip_tags($parseDown->text($article->content));
        }
        return view('index',[
            'articles'=>$articles,
            'recommendArticle'=>$recommendArticles,
            'search'=>$search,
            'labels'=>$labels,
        ]);
    }
}


