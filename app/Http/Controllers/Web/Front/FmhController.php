<?php

namespace App\Http\Controllers\Web\Front;

use App\Helpers\WechatPostSpider;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;


class FmhController extends Controller
{
    //
    public function index(Request $request)
    {
        $client = new Client();
        $crawler = $client->request('GET', $request->input('wechat_url'));
        $title = $crawler->filter('title')->html();
        $content = $crawler->filter('.rich_media_content')->html();
        $content = str_replace('data-src="','src=/image?url=',$content);

        echo ("<h1>$title</h1>".'<div style="text-align: center">'.$content.'</div>');
    }

}
