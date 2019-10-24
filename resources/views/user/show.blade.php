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
    <label for="name">Nome:</label>
    <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? $user->name }}" disabled>
    <label for="email">Email:</label>
    <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? $user->email }}" disabled>
    @if(Auth::user() == $user)
    <form action="{{ route('user.edit', $user) }}" method="get">
    @csrf
    <button type="submit">Editar</button>
    </form>
    <form action="{{ route('service.create') }}" method="get">
    @csrf
    <button type="submit">Criar Serviço</button>
    </form>
    @endif
    <h1>Serviços</h1>
    @foreach ($services as $service)
        @if( $service->user_id == $user->id )
        <tr>
            <th><a href="{{ route('service.show', $service) }}">{{ $service->title }}</a></th>
            <th>{{ $service->description }}</th>
            <th>{{ $service->price }}</th>
        </tr>
        @endif
    @endforeach

</body>
</html>
