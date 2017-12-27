<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['comment','user_id','article_id','comment','tops','floor'];
}
