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
    <div>
    <tr>
        <td>Nome</td>
        <td>Email</td>
        <td>Visitar perfil</td>
    </tr>
    </div>
    <div>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{ route('show.user', $user) }}">Perfil</a></td>
        </tr>
    @endforeach
    </div>
</body>
</html>