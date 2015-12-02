<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Comment_Vote;
use Auth;
use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class CommentController extends Controller
{
    public function __construct(Comment $comment)
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'body' => 'required',
            'post_id' => 'required'
            ]);
        if($validator->fails()){
            return Response::make($validator->messages(), 400);
        }
        $comment = Auth::user()->comments()->create($request->all());
        return view('comments.show', compact($comment));
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show', Auth::user()->comments()->findOrFail($comment));
    }

    /**
     * Show the form for editin g the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact($comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
        $comment->update($request->all());
        return redirect('comments.show');
    }

    /**
       * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user()->getResults() != Auth::user()) {
            return response('Unauthorized.', 401);
        }
        return view('posts.show', compact($comment->delete()));
    }

    public function upVote(Comment $comment)
    {
        $user_up_vote = Comment_Vote::where([
            'comment_id' => $comment->id,
            'user_id' => Auth::id(),
            'up' => 1])->first();
        $user_down_vote = Comment_Vote::where([
            'comment_id' => $comment->id,
            'user_id' => Auth::id(),
            'up' => 0])->first();
        if (!$user_up_vote) {
            if($user_down_vote)
                $user_down_vote->delete();
            return $this->vote($comment, 1);
        } else {
            return redirect()->route('comment.show', compact('comment'))->with("warning", "You 've already upvoted this comment");
        }
    }

    public function downVote(Comment $comment)
    {
        $user_up_vote = Comment_Vote::where([
            'post_id' => $comment->id,
            'user_id' => Auth::id(),
            'up' => 1])->first();
        $user_down_vote = Comment_Vote::where([
            'post_id' => $comment->id,
            'user_id' => Auth::id(),
            'up' => 0])->first();
        if (!$user_down_vote) {
            if($user_up_vote)
                $user_up_vote->delete();
            return $this->vote($comment, 0);
        } else {
            return redirect()->route('comments.show', compact('comment'))->with("warning", "You 've already downvoted this comment");
        }
    }

    private function vote(Comment $comment, $vote)
    {
        if ($vote == 1) {
            $voteCount = $comment->getAttributeValue('vote_count') + 1;
        } else {
            $voteCount = $comment->getAttributeValue('vote_count') - 1;
        }
        $comment->update([
            'vote_count' => $voteCount
        ]);
        Auth::user()->comment_vote()->create([
            'up' => $vote,
            'comment_id' => $comment->getAttributeValue('id')
        ]);
        return view('comments.show', compact('comment'));
    }
}
