<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
</body>
</html>