<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['name','path','description','label'];

    public function getPathAttribute($value)
    {
        return Storage::url($value);
    }
}
