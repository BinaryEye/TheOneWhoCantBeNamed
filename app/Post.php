<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id',
        'body',
        'vote_count'
    ];

    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function votes()
    {
        return $this->hasMany('App\Post_Vote');
    }

    public function tags()
    {
        return $this->hasMany('App\Post_Tag');
    }
}
