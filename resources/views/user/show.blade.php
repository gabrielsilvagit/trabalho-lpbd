<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <label for="name">Nome:</label>
    <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? $user->name }}" disabled>
    <label for="email">Email:</label>
    <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? $user->email }}" disabled>
    <form action="{{ route('user.logout') }}" method="post">
    @csrf
    <button type="submit">Sair</button>
    </form>
</body>
</html>
