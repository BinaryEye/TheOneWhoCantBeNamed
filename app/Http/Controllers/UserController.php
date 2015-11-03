<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        redirect('auth/register');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request)

    {
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'sex' => 'required',
            'date_of_birth' => 'required'
        ]);
        Auth::user()->update(['first_name' => $request->first_name, 'last_name' => $request->last_name,
            'sex' => $request->sex, 'date_of_birth' => Carbon::parse($request->date_of_birth)]);
        return redirect(url('/users/show'))->with('message',"Successfully updated Your info.");
    }
}
//{!!Form::open(['method' => 'PATCH', 'class' => 'form-horizontal' , 'role' => 'form', 'action' => ['UserController@update',Auth::user()->id]]) !!}