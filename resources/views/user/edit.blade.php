<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('user.edit.post', $user) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="name">Nome:</label>
        <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? $user->name }}">
        <label for="email">Email:</label>
        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? $user->email }}">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
