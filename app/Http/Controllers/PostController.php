<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_Vote;
use App\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Mockery\CountValidator\Exception;
use Response;
use Validator;

class PostController extends Controller
{
    private $post;

    public function _construct(Post $post){
        $this->middleware('auth', ['only' => 'create', 'edit', 'destroy', 'upVote', 'downVote']);
        $this->$post = $post;
    }

    public function create()
    {
        $tags = Tag::lists('name', 'id');
        return view('posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'body' => 'required',
            'private' => 'required',
            'title' => 'required'
        ]);
        if($validator->fails()){
            return Response::make($validator->messages(), 400);
        }
        //$post = Auth::user()->posts()->create($request->all());
        $post = new Post($request->all());
        Auth::user()->posts()->save($post);
        $post->tags()->attach($request->input('tags'));
        return view('posts.show', compact($post));
    }


    public function show($post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::lists('name', 'id');
        $selected_tags = $post->tags()->get()->lists('id')->toArray();
        return view('posts.edit', compact('post','selected_tags','tags'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
        $post->update($request->all());
        $post->tags()->detach();
        $post->tags()->attach($request->input('tags'));
        return view('posts.show',compact($post));
    }


    public function destroy(Post $post)
    {
        if ($post->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
            return view('posts.show', compact($post->delete()));
    }

    public function getComments(Post $post)
    {
        //
    }
    public function checkVotes(Post $post, $vote){
        try{
            $user_vote = Post_Vote::findOrFail([
                'post_id' => $post->getAttribute('id'),
                'user_id' => Auth::id()]);
            if($user_vote->getAttributeValue('up') == $vote){
                return view('posts.show', compact('post'));
            }else{
                vote($post, !$vote);
            }
        }catch (Exception $e){
            vote($post, $vote);
        }
    }
    public function vote(Post $post, $vote)
    {
            if ($vote == true) {
                $voteCount = $post->getAttributeValue('vote_count') + 1;
                $post->update([
                    'vote_count' => $voteCount
                ]);
                Auth::user()->post_vote()->create([
                    'up' => true,
                    'post_id' => $post->getAttributeValue('id')
                ]);
            }else {
                $voteCount = $post->getAttributeValue('vote_count') - 1;
                $post->update([
                    'vote_count' => $voteCount
                ]);
                Auth::user()->post_vote()->create([
                    'up' => false,
                    'post_id' => $post->getAttributeValue('id')
                ]);
            }
        return view('posts.show', compact('post'));
    }
}
