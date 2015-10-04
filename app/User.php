<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable =[
        'first_name',
        'last_name',
        'email',
        'password',
        'sex',
        'date_of_birth'
    ];

    protected $table = 'users';

    protected $hidden = ['password'];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function comment_votes()
    {
        return $this->hasMany('App\Comment_Vote');
    }

    public function post_votes()
    {
        return $this->hasMany('App\Post_Vote');
    }

}
