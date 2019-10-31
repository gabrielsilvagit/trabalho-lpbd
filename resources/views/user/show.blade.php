@extends("layouts.main")

@section("page-title", Auth::user()->name )

@section("content")


    <form action="{{ route('user.update', $user) }}" method="POST">

        @csrf
        @method("put")

        <fieldset {{ Auth::user() == $user ? "" : "disabled=disabled" }}>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="staticEmail">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old("name", $user->name) }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="staticEmail" >Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old("email", $user->email) }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary">Voltar</a>
                @if( Auth::user() == $user)
                <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-info">Adicionar Serviço</a>
                @endif
            </div>
        </div>
    </form>

    <h1>Serviços</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th style="width: 80px;"></th>
            </tr>
        </thead>
        @foreach ($services as $service)
        @if( $service->user_id == $user->id )
        <tbody>
            <tr>
                <th><a href="{{ route('service.show', $service) }}">{{ $service->title }}</a></th>
                <th>{{ $service->description }}</th>
                <th>{{ $service->price }}</th>
                <th>
                    @if( Auth::user() == $service->owner)
                    <a href="{{ route('service.delete', $service) }}">
                        <i class="fa fa-trash text-danger"></i>
                    </a>
                    @endif
                </th>
            </tr>
        </tbody>
        @endif
        @endforeach
    </table>
@endsection
