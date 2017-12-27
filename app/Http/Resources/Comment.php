<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Comment extends Resource
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
            'article_id'=>$this->article_id,
            'user_id'=>$this->user_id,
            'comment'=>$this->comment,
            'tops'=>$this->tops,
            'floor'=>$this->floor
        ];
    }
}
