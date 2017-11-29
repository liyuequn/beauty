<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'articles';

    protected $fillable = ['title','content','author_id','type','post_at'];
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
//    protected $guarded = [];
}
