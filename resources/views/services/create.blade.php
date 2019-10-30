@extends("layouts.main")

@section("content")
    <form action="{{ route('service.store') }}" method="post">
        @csrf
        <label for="title">Titulo:</label>
        <input type="text" placeholder="Titulo" name="title">
        <label for="description">Descrição:</label>
        <input type="text" placeholder="Descrição" name="description">
        <label for="price">Preço:</label>
        <input type="text" placeholder="Preço" name="price">
        <button type="submit">Salvar</button>
    </form>
@endsection
