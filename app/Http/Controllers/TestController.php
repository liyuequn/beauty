<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(Request $request){
        return $request->all();
    }

}
