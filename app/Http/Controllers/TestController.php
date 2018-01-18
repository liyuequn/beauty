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
    public function index()
    {
        $str = "1,2sa,sfaw,sfa";
        $s = '';
        for($i=0;$i<strlen($str);$i++){
            if($str[$i]==','){
                $arr[]= $s;
                $s="";
            }else{
                $s.=$str[$i];
                if($i==strlen($str)-1){
                    $arr[]= $s;
                }
            }
        }
        var_dump($arr);

    }
    public function set()
    {
//        $res = Redis::sadd('r_username','liyuequn');
        $res = Redis::smembers('r_username');
        var_dump($res);
    }
    //
    public function redisList()
    {
        $queue = '我关注的';
//        Redis::lpush($queue,'文学');
//        Redis::lpush($queue,'科技');
//        Redis::lpush($queue,'购物');
//        Redis::rpush($queue,'PHP');
//        Redis::rpush($queue,'JAVA');
//        Redis::rpush($queue,'Golang');
        $len = Redis::llen($queue);
//        print_r($len);
       // Redis::lset($queue,1,'hello');
//        Redis::linsert($queue,'BEFORE','hello','world');
//        Redis::linsert($queue,'AFTER','hello','world');
        Redis::blpop($queue,0);
        $list = Redis::lrange($queue,0,$len-1);
//        $list = Redis::ltrim($queue,0,1);
//        $list = Redis::lindex($queue,1);
//        Redis::lrem($queue,5,'hello');
        //print_r($list);
    }
    public function index2()
    {
        echo 1;
        $queue = '我关注的';
        Redis::lpush($queue,'接触阻塞');
        $len = Redis::llen($queue);
        $list = Redis::lrange($queue,0,$len-1);
        print_r($list);
    }
    public function hash(){
        $cacheKey = 'user';
        $username = 'liyuequn';
        Redis::hset($cacheKey.$username,'nickname','一手指天地');
        $info = Redis::hget($cacheKey.$username,'nickname');
        Redis::hmset($cacheKey.$username,'nickname','一手指天地','age',25);
        $info = Redis::hmget($cacheKey.$username,'nickname','age');
        $info = Redis::hlen($cacheKey.$username);
        $info = Redis::hkeys($cacheKey.$username);
        $info = Redis::hvals($cacheKey.$username);
        $info = Redis::hgetall($cacheKey.$username);
        print_r($info);
    }
    public function string(){
        Redis::set('username','liyuequn');
        Redis::set('username2','liyuequn2');
        Redis::get('username');
        Redis::getset('username','liyuequn2');
        Redis::mget('username','username2');
        Redis::mset('username','fengtingting','age',18);
        Redis::setnx('username','liyuequn');
        Redis::mget('username','age');
        Redis::incr('age');
        Redis::decr('age');
        Redis::incrby('age',7);
        Redis::decrby('age',7);
        Redis::append('liyuequn','shigeshuaige');
        return Redis::GETRANGE('username',0,4);
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
