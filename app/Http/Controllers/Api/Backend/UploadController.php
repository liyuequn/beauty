<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function store(Request $request){
        $path = $request->file('file')->store('public/doc');
        return $path;
    }
    public function delete($path){
         Storage::delete($path);
    }
}
