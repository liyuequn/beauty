<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProxyImageController extends Controller {

    public function index(Request $request){
        $url = $request->input('url');
        header("content-type:image/jpeg");
        echo file_get_contents($url);
        die();
    }
}