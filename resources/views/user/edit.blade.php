@extends("layouts.main")

@section("page-title", "Editar:" Auth::user()->name )

@section("content")
    <form action="{{ route('user.update', $user) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="name">Nome:</label>
        <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? $user->name }}">
        <label for="email">Email:</label>
        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? $user->email }}">
        <button type="submit">Salvar</button>
    </form>
@endsection
