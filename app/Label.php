<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    protected $table = 'labels';
    protected $fillable = ['type_id','name'];
}
