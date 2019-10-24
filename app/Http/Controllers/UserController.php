<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('auth.create');
    }

    public function store(User $user,Request $request)
    {
        $data = $this->validateRequest($request);
        $data["password"] = Hash::make($request->password);
        try {
            $user = User::create($data);
            return redirect()->route("login");
        } catch(Exception $e) {
            return redirect()->route("user.register.create");
        }
    }

    public function show(User $user)
    {
        $services = Service::all();
        return view('user.show', compact('user','services'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        try {
            $data = $this->validateRequest($request);
            $user->update($data);
            return redirect(route('show.user', $user));
        } catch(Exception $e) {
            return redirect(route('user.edit', $user));
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('login'));
    }

    public function loginIndex()
    {
        return view('auth.login');
    }
    public function loginPost(Request $request)
    {
        $data = $this->validateRequest($request);
        if(!Auth::attempt($data)) {
            return redirect()->back()->with('msg','Email ou senha invalidos');
        }
        return redirect('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'name' => 'sometimes|required',
            'email' => 'required',
            'password' => 'sometimes|required',
        ]);
    }
}
