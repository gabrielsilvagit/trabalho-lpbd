<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Service;
use App\Traits\ShowMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use ShowMessages;

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

        $this->showMessage("Usuário salvo com sucesso!");

        return redirect()->route("login");
    }

    public function show(User $user)
    {
        $services = Service::where('user_id', '=', $user->id)->paginate(50, ["*"], "services");
        $customers = User::join("service_user as p", "p.user_id", "=", "users.id")
            ->join("services as s", "s.id","=","p.service_id")
            ->where("s.user_id", $user->id)
            ->select("users.name as u_name","users.id as u_id", "s.title as s_title", "s.id as s_id")
            ->whereNull("s.deleted_at")->paginate(50, ["*"], "customers");
        return view('user.show', compact('user','services', 'customers'));
    }

    public function update(User $user, Request $request)
    {
        $data = $this->validateRequest($request);
        $user->update($data);

        $this->showMessage("Usuário salvo com sucesso!");

        return redirect(route('show.user', $user));
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            Service::where("user_id", "=", $user->id)->delete();
            $user->delete();
            $this->showMessage("Usúario excluído com sucesso!");
            DB::commit();
            return redirect(route('login'));
        } catch(Exception $e) {
            $this->showMessage("Erro ao excluir usúario!", "error");
            return redirect()->back();
            DB::rollBack();
        }
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
            "email.required" => "Email é obrigatório",
            "password.required" => "Senha é obrigatório"
        ]);
    }
}
