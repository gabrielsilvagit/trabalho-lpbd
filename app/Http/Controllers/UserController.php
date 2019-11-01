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
        $users = User::paginate(15);
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
        $user = User::create($data);
        return redirect()->route("login");
    }

    public function show(User $user)
    {
        $services = Service::where('user_id', '=', $user->id)->paginate(5);
        return view('user.show', compact('user','services'));
    }

    public function update(User $user, Request $request)
    {
        $data = $this->validateRequest($request);
        $user->update($data);
        return redirect(route('show.user', $user));
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
            return redirect('/login');
        }
        return redirect('/home');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/home');
    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'name' => 'sometimes|required',
            'email' => 'required',
            'password' => 'sometimes|required',
        ],[
            "name.required" => "Nome é obrigatório",
            "email.required" => "Email é obrigatório"
        ]);
    }
}
