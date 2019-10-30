@extends("layouts.main")

@section("content")

    <form action="{{ route('service.update', $service) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="title">Titulo:</label>
        <input type="text" placeholder="Titulo" name="title" value="{{ old('title') ?? $service->title }}">
        <label for="description">Descrição:</label>
        <input type="text" placeholder="Descrição" name="description" value="{{ old('description') ?? $service->description }}">
        <label for="price">Preço:</label>
        <input type="text" placeholder="Preço" name="price" value="{{ old('price') ?? $service->price }}">
        <button type="submit">Salvar</button>
    </form>
    <form action="{{ route('service.delete', $service) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Excluir</button>
    </form>
@endsection
