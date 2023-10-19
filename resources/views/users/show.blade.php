@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h1>
                    {{$user->name}}
                    
                    @if($usuarioAutenticado->follows->contains($user))
                        <button type="button" class="btn btn-outline-primary float-end">Seguir</button>
                    @else
                        <button type="button" class="btn btn-outline-danger float-end">Remover</button>
                    @endif
                </h1>
            </div>
        </div>
        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h2>Posts <span class="badge bg-secondary float-end">{{ $user->posts->count() }}</span></h2> 
                <ul class="list-group">
                    @foreach($user->posts as $post)
                        <li class="list-group-item">{{$post->content}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h2>Seguidores <span class="badge bg-secondary float-end">{{ $user->followers->count() }}</span></h2>
                <ul class="list-group">
                    @foreach($user->followers as $follower)
                        <li class="list-group-item">
                            <a href="/user/{{ $follower->id }}" class="link-underline-light">
                                {{$follower->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h2>Seguindo <span class="badge bg-secondary float-end">{{ $user->follows->count() }}</span></h2>
                <ul class="list-group">
                    @foreach($user->follows as $follows)
                        <li class="list-group-item">
                            <a href="/user/{{ $follows->id }}" class="link-underline-light">
                                {{$follows->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
