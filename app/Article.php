<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

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
    protected $guarded = [];
    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user(){

        return $this->belongsTo('App\User','author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 获取该文章的多个标签
     */
    public function labels(){

        return $this->belongsToMany(Label::class);
    }

    /**
     * @param $value
     * @return string
     * 字段修改器，预处理
     */
    public function getContentAttribute($value)
    {
        $route = Route::current();
        if($route->uri=='api/articles'){
            $parseDown = new \Parsedown();
            return strip_tags($parseDown->text($value));
        }else{
            return $value;
        }

    }
}
