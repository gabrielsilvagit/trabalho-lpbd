<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('layouts.menu')
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
</body>
</html>
