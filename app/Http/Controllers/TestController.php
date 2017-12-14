<?php

namespace App\Http\Controllers;

use App\Article;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //
    public function index(){
        Redis::set('name','liyuequn');
        $name = Redis::get('name');
        var_dump($name);
    }
    public function test2(){
        $article = Article::find(105773);
        foreach ($article->labels as $label){
            echo $label->name;
        }
    }
    public function test(){
        set_time_limit(0);
        //清空并关闭输出缓存
        ob_end_clean();
        //flush();
        echo '<div id="jindu" style="height: 20px;background-color: greenyellow;z-index: 1000000;"></div>';
        for ($j=1;$j<=100;$j++){
            $jindu = $j*10;
            echo '<script>
                var jindu = document.getElementById("jindu");
                jindu.style.width = "'.$jindu.'px";
                jindu.innerHTML = "'.$j.'%";
            </script>';
            for ($i=0;$i<200000;$i++){
                DB::table('articles')->insert([
                    'title'=>str_random(10),
                    'content'=>str_random(100),
                    'author_id'=>rand(0,10),
                    'type'=>rand(1,2),
                    'post_at'=>date('y-m-d H:i:s',time()),
                ]);
            }
        }
    }

}
