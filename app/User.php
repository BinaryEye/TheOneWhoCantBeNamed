<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,AuthorizableContract,CanResetPasswordContract


{
    use Authenticatable, Authorizable, CanResetPassword;
    protected $fillable =[
        'first_name',
        'last_name',
        'email',
        'password',
        'sex',
        'date_of_birth'
    ];

    protected $table = 'users';

    protected $dates = ['date_of_birth'];

    protected $hidden = ['password','remember_token'];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function comment_vote()
    {
        return $this->hasMany('App\Comment_Vote');
    }

    public function post_vote()
    {
        return $this->hasMany('App\Post_Vote');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function add_vote_to_post(Post_Vote $vote, Post $post){
        $this->post_vote()->save($vote);
        $post->votes()->save($vote);
    }

    public function tag(){
        return $this->belongsToMany('App\Tag');
    }
}
