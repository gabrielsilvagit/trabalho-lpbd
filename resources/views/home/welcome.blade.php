@extends("layouts.main")

@section("page-title", "Home" )

@section("content")
    <div class="container">
        <div class="box shadow-sm p-3 mb-5 bg-white rounded">
            <h1 class="nav justify-content-center">Bem vindo, {{ Auth::user()->name }}!</h1>
            <h2>Divulge seu serviços, resolva seus problemas!</h2>
        </div>
    </div>
@endsection
