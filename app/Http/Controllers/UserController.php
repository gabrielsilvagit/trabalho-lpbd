<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        dd("teste222");
        $user = User::create($this->validateRequest());
        return redirect('/');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(User $user)
    {
        $user->update($this->validateRequest());
        return redirect('/');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }
}
