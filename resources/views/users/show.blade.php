@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h1>
                    {{$user->name}}
                    
                    @if(!$usuarioAutenticado->follows->contains($user))
                        <a href="/follow/{{ $user->id }}" class="btn btn-outline-primary float-end">Seguir</a>
                    @else
                        <a href="/unfollow/{{ $user->id }}" class="btn btn-outline-danger float-end">Remover</a>
                    @endif
                </h1>
            </div>
        </div>
        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <h2>Posts <span class="badge bg-secondary float-end">{{ $user->posts->count() }}</span></h2> 
                <ul class="list-group">
                    @foreach($user->posts as $post)
                        <li class="list-group-item">
                            {{$post->content}} 
                            <br> 
                            <span class="float-end"><small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y h:m') }}</small></span>
                            <span class="float-start"><small>{{ $post->comments->count() }} comentários {{ $post->likes->count() }} curtidas</small></span>
                            <br>
                            <span class="float-end"><small><a href="/post/{{$post->id}}">ver mais</a></small></span>
                        </li>
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
