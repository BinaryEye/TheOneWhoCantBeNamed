<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Vote extends Model
{
    protected $fillable = [
        'up',
        'post_id'
    ];

    protected $table = 'post_vote';

    protected function post()
    {
        return $this->belongsTo('App\Post');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}
