<?php

namespace App\Http\Controllers;

use App\Message;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function create(Request $request)
    {
        //创建消息
        $message =  Message::create($request->all());
        //发送短信
        if($request->input('is_message')==1){
            $this->sendMessage($request->input('phone'),$request->input('content'));
        }
        return [
            'success'=>true,
            'data'=>$message,
        ];

    }

    /**
     * @param $id
     * 设置已读
     */
    public function read($id)
    {
        //是否已读
        Message::where('id', $id)->update(
            [
                'status'=>1,
                'read_at'=>date('Y-m-d')
                ]);
    }

    /**
     * @param $send_to_id
     * @param $sys
     * 根据发送跟谁查看自己的信息
     */
    public function index($send_to_id,$sys)
    {
        return Message::where([
            ['send_to_id','=',$send_to_id],
            ['send_to_sys','=',$sys]
        ])->get();
    }

}
