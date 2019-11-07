<?php

namespace App\Http\Controllers;

use App\User;
use App\Hiring;
use App\Service;
use App\Traits\ShowMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    use ShowMessages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(15);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $request['user_id'] = Auth::user()->id;
        $data = $this->validateRequest($request);
        $service->create($data);
        $this->showMessage("Serviço salvo com sucesso!");
        return redirect()->route("service.show", $service);
    }

    public function show(Service $service)
    {
        $customers = User::join("service_user as p", "p.user_id", "=", "users.id")
            ->join("services as s", "s.id","=","p.service_id")
            ->where("p.service_id", $service->id)
            ->select("users.*")
            ->whereNull("s.deleted_at")->paginate(50, ["*"], "customers");
        return view('services.show',compact('service','customers'));
    }


    public function update(Request $request, Service $service)
    {
        $data = $this->validateRequest($request);
        $service->update($data);
        $this->showMessage("Serviço salvo com sucesso!");
        return redirect()->route("service.show", $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        $this->showMessage("Serviço excluído com sucesso!");
        return redirect(route('show.user', $service->owner));
    }

    public function hire(Request $request, Service $service)
    {
        $user = Auth::user();
        $service->user()->attach($user);
        $this->showMessage("Serviço contratado com sucesso!");
        return redirect(route('service.show', $service));
    }
    public function cancel(Service $service, User $user)
    {
        $service->user()->detach($user);
        $this->showMessage("Serviço cancelado com sucesso!");
        return redirect(route('service.show', $service));
    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'sometimes|required',
        ],[
            "title.required" => "Titulo é obrigatório",
            "description.required" => "Descrição é obrigatório",
            "price.required" => "Preço é obrigatório"
        ]);
    }
}
