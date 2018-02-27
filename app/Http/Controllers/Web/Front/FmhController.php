<?php

namespace App\Http\Controllers\Web\Front;

use App\Helpers\WechatPostSpider;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;


class FmhController extends Controller
{
    //
    public function store(Request $request)
    {
        $url = $request->input('url');
        $client = new Client();
        $wechatPostSpider = new WechatPostSpider($client, $url);
        $this->savePost($wechatPostSpider);
    }
    protected function savePost(WechatPostSpider $wechatPostSpider)
    {
        $arr = [
            'url' => $wechatPostSpider->getUrl(),
            'author' => $wechatPostSpider->getAuthor(),
            'title' => $wechatPostSpider->getTitle(),
            'content' => $wechatPostSpider->getContent(),
            'post_date' => $wechatPostSpider->getPostDate(),
        ];
    }
}
