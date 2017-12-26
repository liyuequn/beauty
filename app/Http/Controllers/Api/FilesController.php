<?php

namespace App\Http\Controllers\Api;


use App\Helpers\Handler\ImageUploadHandler;
use Illuminate\Http\Request;


class FilesController extends ApiController
{


    public function ImageUpload(Request $request)
    {

        if (!$request->hasFile('file')){
            return $this->respondWithError('上传文件不能为空');
        }


        $file = $request->file('file');

        $imageHander = new ImageUploadHandler();
        $result = $imageHander->uploadImage($file);

        return $this->respondWithSuccess([
            'image' => '/'.$result['filename']
        ]);
    }
}
