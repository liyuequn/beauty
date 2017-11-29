<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function store(Request $request)
    {
        $articles = Article::create($request->all());
        return $articles;
    }
}
