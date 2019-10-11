<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('auth.create');
    }

    public function store(User $user,Request $request)
    {
        $data = $this->validateRequest($request);
        $data["password"] = Hash::make($request->password);

        DB::beginTransaction();
        try {
            $user->fill($data);
            $user->save();
            DB::commit();
        } catch(Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }

        return redirect()->route("login");
    }

    public function show(User $user)
    {
        // return redirect('/user/',compact($user));
    }

    public function edit(User $user)
    {
        return view('user.edit');
    }

    public function update(User $user, Request $request)
    {
        DB::beginTransaction();
        try {
            dd($request);
            $data = $this->validateRequest($request);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $user->fill($data);
            $user->save();
            DB::commit();
        } catch(Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }
        return redirect(route('user.edit.post', $user->id));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
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
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'name' => 'sometimes|required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }
}
