<?php

namespace App\Http\Controllers;

use App\Http\Resources\LabelsCollection;
use App\Label;
use Illuminate\Http\Request;

class LabelsController extends Controller
{
    public function index (Request $request)
    {
        $where = [];
        $name = $request->input('name');
        $type_id = $request->input('type_id');
        $pageSize = $request->input('pageSize');
        if($name){
            $where[] = ['name','like',"$name%"];
        }
        if($type_id){
            $where[] = ['type_id',$type_id];
        }
        return new LabelsCollection(
            Label::where($where)->orderBy('created_at','desc')->paginate($pageSize)
        );
    }

    public function store(Request $request)
    {
        if($request->input('id')){
            $labels = Label::find($request->input('id'));
            $labels->update($request->all());
        }else{
            $labels = Label::create($request->all());
        }
        return $labels;
    }
}
