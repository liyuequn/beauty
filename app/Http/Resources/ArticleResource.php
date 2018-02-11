<?php

namespace App\Http\Resources;

use App\models\User;
use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>strlen($this->content)>200?mb_substr($this->content,0,200).'...':$this->content,
            'author_id'=>$this->author_id,
            'author_name'=>User::find($this->author_id)->name,
            'post_at'=>$this->post_at,
            'hits'=>$this->hits,
            'isTop'=>$this->hits,
            'type'=>$this->type,
            'last_comment_at'=>$this->last_comment_at,
            'post_status'=>$this->post_status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
