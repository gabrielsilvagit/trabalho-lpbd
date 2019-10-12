<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
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
            return redirect()->route("login");
        } catch(Exception $e) {
            Log::debug($e);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function show(User $user)
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        DB::beginTransaction();
        try {
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
