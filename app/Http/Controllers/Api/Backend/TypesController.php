<?php

namespace App\Http\Controllers\Api\Backend;


use App\Http\Resources\TypesCollection;
use App\models\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index (Request $request)
    {
        $where = [];
        $name = $request->input('name');
        if($name){
            $where[] = ['name','like',"$name%"];
        }
        return new TypesCollection(
            Type::where($where)->orderBy('created_at','desc')->get()
        );
    }

    public function store(Request $request)
    {
        if($request->input('id')){
            $types = Type::find($request->input('id'));
            $types->update($request->all());
        }else{
            $types = Type::create($request->all());
        }
        return $types;
    }
}
