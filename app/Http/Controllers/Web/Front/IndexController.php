<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\models\Article;
use App\models\Book;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 首页包括文章资源
     */
    public function index($search = ''){
        if($search){
            $articles = Article::search($search)->get();
        }else{
            $articles = Article::take(20)->orderBy('updated_at','post_at','desc')->get();
        }
        //推荐文章
        $recommendArticles = Article::take(5)->orderBy('hits','desc')->get();
        //热门标签
        $labels = DB::connection('mysql')->select("SELECT count(label_id) AS num ,labels. NAME FROM labels INNER JOIN article_label al ON labels.id = al.label_id GROUP BY
	    label_id ORDER BY num DESC,labels.created_at limit 10");
        //推荐资源
        $books = Book::take(10)->orderBy('created_at','desc')->get();
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
            'books'=>$books,
        ]);
    }
}


