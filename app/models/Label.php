<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    protected $table = 'labels';
    protected $fillable = ['type_id','name'];

    public function articles()
    {

        return $this->belongsToMany('App\Article');
    }
}
