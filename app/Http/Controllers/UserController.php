<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_Tag;
use App\Tag_User;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Response;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        redirect('auth/register');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     * @internal param User $user
     * @internal param int $id
     */
    public function update(Request $request)

    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'sex' => 'required',
            'date_of_birth' => 'required'
        ]);
        $request['date_of_birth'] = Carbon::parse($request->get('date_of_birth'));
        Auth::user()->update($request->all());
        return redirect(url('/users/show'))->with('message', "Successfully updated Your info.");
    }

    public function timeLine()
    {
        $tags = Auth::user()->tags()->get();
        $posts = collect([]);
        foreach ($tags as $tag) {
            foreach ($tag->post()->get() as $post) {
                $posts->push($post);
            }
        }
        return new Paginator($posts->unique('id'),10);
    }
}
