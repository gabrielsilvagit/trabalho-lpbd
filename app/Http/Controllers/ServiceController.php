<?php

namespace App\Http\Controllers;

use App\Hiring;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        DB::beginTransaction();
        try {
            $service->fill($data);
            $service->save();
            DB::commit();
            return redirect()->route("service.show", $service);
        } catch(Exception $e) {
            Log::debug($e);
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        DB::beginTransaction();
        try {
            $data = $this->validateRequest($request);
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['price'] = $request->price;
            $service->fill($data);
            $service->save();
            DB::commit();
        } catch(Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }
        return redirect(route('service.show', $service));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    public function hire(Service $service, Request $request)
    {
        $user = Auth::user();
        $service->user->attach($user);

    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'sometimes|required',
        ]);
    }
}
