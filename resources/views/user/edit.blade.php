@extends("layouts.main")


@section("content")
    <form action="{{ route('user.edit.post', $user) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="name">Nome:</label>
        <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? $user->name }}">
        <label for="email">Email:</label>
        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? $user->email }}">
        <button type="submit">Salvar</button>
    </form>
@endsection
