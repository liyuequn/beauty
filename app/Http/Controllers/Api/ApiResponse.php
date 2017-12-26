<?php
namespace App\Http\Controllers\Api;

trait ApiResponse
{
    /**
     * @param $status
     * @param $message
     * @param array $data
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function outPutJson($status,$message,$data = [])
    {
        $res = $this->setData($message,$data);
        return response($res, $status);
    }

    /**
     * @param $message
     * @param array $data
     * @return array
     */
    protected function setData($message,$data = [])
    {
        return [
            'message'=>$message,
            'data'=>$data,
        ];
    }
}