<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('user.edit.post', Auth::user()->id) }}" method="PATCH">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" placeholder="Nome" name="name" value="{{ old('name') ?? Auth::user()->name }}">
        <label for="email">Email:</label>
        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') ?? Auth::user()->email }}">
        <label for="password">Senha:</label>
        <input type="password" placeholder="Senha" name="password">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
