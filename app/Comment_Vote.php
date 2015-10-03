<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Vote extends Model
{
    protected $fillable = [
        'up'
    ];

    protected $table = 'comment_votes';

    protected function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}