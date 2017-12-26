<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $connection = 'mysql_omc';
    protected $table = 'messages';
    protected $fillable = [
        'send_from_id',
        'send_from_name',
        'send_from_sys',
        'send_to_id',
        'send_to_name',
        'send_to_sys',
        'phone',
        'type',
        'is_message',
        'is_web',
        'content',
    ];
}
