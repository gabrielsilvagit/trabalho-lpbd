@extends("layouts.main")

@section("page-title", "Home" )

@section("content")
    <div class="container">
        <div class="box shadow-sm p-3 mb-5 bg-white rounded">
            <h1 class="nav justify-content-center">Bem vindo novamente, {{ Auth::user()->name }}!</h1>
        </div>
    </div>
@endsection
