<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <label for="provider">Prestador:</label>
    <a href="{{ route('show.user', $service->owner ) }}"><input type="text" placeholder="Prestador" name="provider" value="{{ old('title') ?? $service->owner->name}}" disabled></a>
    <label for="title">Titulo:</label>
    <input type="text" placeholder="Titulo" name="title" value="{{ old('title') ?? $service->title }}" disabled>
    <label for="description">Descrição:</label>
    <input type="text" placeholder="Descrição" name="description" value="{{ old('description') ?? $service->description }}" disabled>
    <label for="price">Preço:</label>
    <input type="text" placeholder="Preço" name="price" value="{{ old('price') ?? $service->price }}" disabled>

    <form action="{{ route('service.edit', $service) }}" method="get">
    @csrf
    <button type="submit">Editar</button>
    </form>
    <form action="{{ route('service.hire', $service) }}" method="post">
    @csrf
    <button type="submit">Contratar</button>
    </form>

    <h1>Clientes:</h1>
    @foreach ($service->user as $service)
        <h3>{{$service->name}}</h3>
    @endforeach
</body>
</html>
