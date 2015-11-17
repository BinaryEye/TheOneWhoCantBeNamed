<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class CommentController extends Controller
{
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
