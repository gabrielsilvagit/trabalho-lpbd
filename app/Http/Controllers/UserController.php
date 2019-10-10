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
        //
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
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
