<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Vote extends Model
{
    protected $fillable = [
        'up'
    ];

    protected $table = 'post_votes';

    protected function post()
    {
        return $this->belongsTo('App\Post');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}
