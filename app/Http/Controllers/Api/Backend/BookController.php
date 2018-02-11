<?php

namespace App\Http\Controllers\Backend;

use App\models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        $page = $request->input('page',0);
        $pageSize = $request->input('pageSize',10);
        return Book::skip(($page-1)*$pageSize)->take($pageSize)->get();
    }
    public function store(Request $request)
    {
         Book::create($request->all());
    }
    public function delete($id){
        Book::find($id)->delete();
        $file = new UploadController();
        return $file->delete($id);
    }
}
