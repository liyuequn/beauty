<?php

namespace App\Http\Controllers;

use App\Article;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use Laravoole\Wrapper\SwooleWebSocketWrapper;

use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    //
    public function index(){
        return Redis::llen('comment_list');
    }
    public function indexRedis()
    {
        while(Redis::llen('comment_list')>0){
            echo Redis::rpop('comment_list');
        }
    }
    public function ws()
    {
        $ws = new SwooleWebSocketWrapper("127.0.0.1",9050);

//监听WebSocket连接打开事件
        $ws->on('open', function ($ws, $request) {
            var_dump($request->fd, $request->get, $request->server);
            $ws->push($request->fd, "hello, welcome\n");
        });

//监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
            echo "Message: {$frame->data}\n";
            $ws->push($frame->fd, "server: {$frame->data}");
        });

//监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });
    }
    public function excel(){

        set_time_limit(0);
        ini_set('memory_limit','1024M');
        Excel::create('test',function($excel)  {
            $excel->setTitle('测试');
            // Chain the setters
            $excel->setCreator('李岳群')
                ->setCompany('北京幼狮科技有限公司');
            // Call them separately
            $excel->setDescription('我是一个描述');
            //设置一页
            // Our first sheet
            $excel->sheet('First sheet', function($sheet)  {
                // Append multiple rows

                for ($i=0;$i<68;$i++){

                    $data = Article::skip($i*10000)->take(10000)->get()->toArray();
                    sleep(1);
                    $sheet->rows($data);
                    unset($data);
                }
            });

        })->download('xlsx');;
        //store on server
//        })->store('xls',storage_path('excel/exports'));
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
