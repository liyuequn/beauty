<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(Request $request)
    {
        return 1;
        return $request->all();
    }

    public function index(Request $request)
   {
       $client = new Client([
               'base_uri' => 'http://127.0.0.1:8000',
               'timeout'  => 2.0,
               ]
       );
       $response = $client->post('/oauth/token',[
           'json'=>[
               'grant_type' => 'password',
               'client_id' => env('CLIENT_ID'),
               'client_secret' => env('CLIENT_SECRET'),
               'username' => $request->input('username'),
               'password' => $request->input('password'),
               'scope' => '',
           ]
       ]);
       echo $response->getBody();exit;


       return json_decode((string) $response->getBody(), true);
   }

}
