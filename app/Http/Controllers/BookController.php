<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        return DB::table('books')->get();
    }
    public function store(Request $request){
        $path = $request->file('file')->store('file');
        return $path;
    }
    public function update(Request $request)
    {
         Book::create($request->all());
    }
}
