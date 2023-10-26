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
                        <a href="/follow/{{ $umUser->id }}" class="btn btn-outline-primary btn-sm float-end">Seguir</a>
                    @else
                        <a href="/unfollow/{{ $umUser->id }}" class="btn btn-outline-danger float-end">Remover</a>
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
