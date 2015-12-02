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
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function create()
    {
        $tags = Tag::lists('name', 'id');
        return view('posts.create', compact('tags'));
    }

    public function store(PostRequest $request)
    {
        $post = new Post($request->all());
        Auth::user()->posts()->save($post);
        $post->tags()->attach($request->input('tags'));
        return view('posts.show', compact('post'));
    }


    public function show($post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::lists('name', 'id');
        $selected_tags = $post->tags()->get()->lists('id')->toArray();
        return view('posts.edit', compact('post', 'selected_tags', 'tags'));
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($post->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
        $post->update($request->all());
        $post->tags()->detach();
        $post->tags()->attach($request->input('tags'));
        return view('posts.show', compact('post'));
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

    public function checkVotes(Post $post, Request $request)
    {
        $vote = $request->only('vote');
        try {
            $user_vote = Post_Vote::findOrFail([
                'post_id' => $post->id,
                'user_id' => Auth::id()])->first();
            if ($user_vote->up == $vote) {
                return view('posts.show', compact('post'));
            } else {
                $this->vote($post, !$vote);
            }
        } catch (ModelNotFoundException $e) {
            $this->vote($post, $vote);
        }
    }

    public function upVote(Post $post)
    {

        $user_vote = Post_Vote::where([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'up' => 1])->first();
        if (!$user_vote) {
            return $this->vote($post, 1);
        } else {
            return redirect()->route('posts.show', compact('post'))->with("warning", "You 've already upvoted this post");
        }
    }

    public function downVote(Post $post)
    {
        $user_vote = Post_Vote::where([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'up' => 0])->first();
        if (!$user_vote) {
            return $this->vote($post, 0);
        } else {
            return redirect()->route('posts.show', compact('post'))->with("warning", "You 've already downvoted this post");
        }
    }

    private function vote(Post $post, $vote)
    {
        if ($vote == 1) {
            $voteCount = $post->getAttributeValue('vote_count') + 1;
        } else {
            $voteCount = $post->getAttributeValue('vote_count') - 1;
        }
        $post->update([
            'vote_count' => $voteCount
        ]);
        Auth::user()->post_vote()->create([
            'up' => $vote,
            'post_id' => $post->getAttributeValue('id')
        ]);
        return view('posts.show', compact('post'));
    }
}
