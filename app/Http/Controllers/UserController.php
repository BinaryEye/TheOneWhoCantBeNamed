<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
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
        $age = Carbon::now() - Carbon::parse(Auth::user()->getAttributeValue('date_of_birth'));
        return view('users.show', [Auth::user()->toArray(), 'age' => $age]);
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
     * @param User $user
     * @param  \Illuminate\Http\Request $request
     * @return Response
     * @internal param int $id
     */
    public function update(User $user, Request $request)
    {
        $user->update($request->all());
        return redirect('users.show');
    }
}
