<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
   public function index()
   {
       $arr = [
           'msg'=>'hello world',
       ];
       return $arr;
   }

}
