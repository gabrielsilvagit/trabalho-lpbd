<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fazer Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .container {
            padding-top: 100px;
            width: 40%;
        }

        .btn {
            margin: 15px 0;
        }
        body {
            background-color: #f1f4f7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box shadow-sm p-3 mb-5 bg-white rounded">
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <label for="email">Email:</label>
                <input class="form-control" type="email" placeholder="E-mail" name="email">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="password">Senha:</label>
                <input class="form-control" type="password" placeholder="Senha" name="password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary" type="submit">Entrar</button>
            </form>
            <a href="{{ route('user.register.create') }}">Não tem uma conta? Clique Aqui</a>
        </div>
    </div>
</body>
</html>
