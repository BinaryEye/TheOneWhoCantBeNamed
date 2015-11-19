<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'private'
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
        return $this->belongsToMany('App\Tag');
    }

    public function upVotes(){
        return Post_Vote::where(['up' => 1, 'post_id' => $this->id])->count();
    }
    public function downVotes(){
        return Post_Vote::where(['up' => 0, 'post_id' => $this->id])->count();
    }
}
