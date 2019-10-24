<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
    <tr>
        <td>Prestador</td>
        <td>Titulo</td>
        <td>Descrição</td>
        <td>Preço</td>
    </tr>
    </div>
    <div>
    @foreach($services as $service)
        <tr>
            <td>{{ $service->owner->name }}</td>
            <td>{{ $service->title }}</td>
            <td>{{ $service->description }}</td>
            <td>{{ $service->price }}</td>
        </tr>
    @endforeach
    </div>
</body>
</html>