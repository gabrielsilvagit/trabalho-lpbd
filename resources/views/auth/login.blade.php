<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fazer Login</title>
</head>
<body>
    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" placeholder="E-mail" name="email">
        <label for="password">Senha:</label>
        <input type="password" placeholder="Senha" name="password">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
