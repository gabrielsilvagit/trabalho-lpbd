@extends("layouts.main")

@section("page-title", $service->title )

@section("content")


<form action="{{ route('service.update', $service) }}" method="POST">

        @csrf
        @method("put")

        <fieldset {{ Auth::user() == $service->owner ? "" : "disabled=disabled" }}>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail">Titulo</label>
                        <input type="text" class="form-control" name="title" value="{{ old("title", $service->title) }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail" >Email</label>
                        <input type="text" class="form-control" name="description" value="{{ old("description", $service->description) }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail" >Preco</label>
                        <input type="text" class="form-control" name="price" value="{{ old("price", $service->price) }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail" >Prestador</label>
                        <input disabled type="text" class="form-control" name="owner" value={{ $service->owner->name }}>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-xs-12 text-right">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary">Voltar</a>
                @if( Auth::user() == $service->owner)
                <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                @endif
            </div>
        </div>
    </form>


    @if ( Auth::user() != $service->owner)
    @if( $service->user->contains(Auth::user()) )
    <form action="{{ route('service.cancel', [$service, Auth::user()]) }}" method="post">
    @csrf
    <button class="btn btn-danger" type="submit">Cancelar</button>
    </form>
    @else
    <form action="{{ route('service.hire', $service) }}" method="post">
    @csrf
    <button class="btn btn-primary" type="submit">Contratar</button>
    </form>
    @endif
    @endif
    <h1>Clientes:</h1>
    @foreach ($service->user as $user)
    <tr>
        <td>
        <h3>{{$user->name}}</h3>
        @if(Auth::user() == $service->owner)
        <form action="{{ route('service.cancel', [$service, $user]) }}" method="post">
        @csrf
        <button class="btn btn-danger" type="submit">Cancelar</button>
        </form>
        @endif
        </td>
    </tr>
    @endforeach
@endsection
