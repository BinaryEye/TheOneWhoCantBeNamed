<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'private'
    ];

    protected $table = 'tags';

    public function post()
    {
        return $this->belongsToMany('App\Post');
    }

    public function user(){
        return $this->belongsToMany('App\User');
    }
}
