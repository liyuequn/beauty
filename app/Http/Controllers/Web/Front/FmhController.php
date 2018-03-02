<?php

namespace App\Http\Controllers\Web\Front;

use App\Helpers\WechatPostSpider;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FmhController extends Controller
{
    //
    public function index(Request $request)
    {
        $client = new Client();
        $crawler = $client->request('GET', $request->input('wechat_url'));
        $content = $crawler->filter('html')->html();
        $content = str_replace('data-src="','src=/image?url=',$content);

        echo $content;
    }

    public function res(Request $request){
        $res = $request->input('num');
        $list = DB::table('result')->where('res','=',$res)->take(5)->get();
        return $list;
    }

}
