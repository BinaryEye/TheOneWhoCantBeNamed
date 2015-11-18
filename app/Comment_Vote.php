<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Vote extends Model
{
    protected $fillable = [
        'up',
        'comment_id'
    ];

    protected $table = 'comment_vote';

    protected function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}
