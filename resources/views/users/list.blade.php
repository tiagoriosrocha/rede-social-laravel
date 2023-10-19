@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($listaUsuarios as $umUser)
            <div class="card mb-3 col-md-7">
                <div class="card-body">
                    <a href="/user/{{ $umUser->id }}" class="link-underline-light">
                        {{$umUser->name}}
                    </a>
                    @if(!$usuarioAutenticado->follows->contains($umUser))
                        <button type="button" class="btn btn-outline-primary btn-sm float-end">Seguir</button>
                    @else
                        <button type="button" class="btn btn-outline-danger btn-sm float-end">Remover</button>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="col-md-12 text-center">
            {{ $listaUsuarios->links() }}
        </div>
    </div>
</div>
@endsection
