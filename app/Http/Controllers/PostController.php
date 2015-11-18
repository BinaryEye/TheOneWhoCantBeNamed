<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use App\Post_Vote;
use Auth;
use Request;
use Response;
use Validator;

class PostController extends Controller
{
    private $post;

    /**
     * @param Post $post
     */
    public function _construct(Post $post){
        $this->middleware('auth', ['only' => 'create', 'edit', 'destroy', 'upVote', 'downVote']);
        $this->$post = $post;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'body' => 'required',
        ]);
        if($validator->fails()){
            return Response::make($validator->messages(), 400);
        }
        $post = Auth::user()->posts()->create($request->all());
        return view('posts.show', compact($post));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Auth::user()->posts()->findOrFail($id);
        return view('posts.show', compact($post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @internal param int $id
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
        $post->update($request->all());
        return redirect('posts.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
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

    public function upVote(Post $post)
    {
        $voteCount = $post->getAttributeValue('vote_count') + 1;
        $post->update([
            'vote_count' => $voteCount
        ]);
        Auth::user()->post_vote()->create([
            'up' => true,
            'post_id' => $post->getAttributeValue('id')
        ]);
        return view('posts.show', compact($post));
    }

    public function downVote(Post $post)
    {
        $voteCount = $post->getAttributeValue('vote_count') - 1;
        $post->update([
            'vote_count' => $voteCount
        ]);
        Auth::user()->post_vote()->create([
            'up' => true,
            'post_id' => $post->getAttributeValue('id')
        ]);
        return view('posts.show', compact($post));
    }
}
