@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-md-7">
            <div class="card-header">
                {{$post->user->name}} - {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y h:m') }} 
            </div>
            <div class="card-body">
                <h4>
                    
                    {{$post->content}}
                    
                    @if(!$post->likes->contains('user_id',$user->id))
                        <a href="/like/{{ $post->id }}" type="button" class="btn btn-outline-primary">Curtir</a>
                    @else
                        <a href="/deslike/{{ $post->id }}" type="button" class="btn btn-outline-danger">Descurtir</a>
                    @endif
                </h4>
            </div>
        </div>

        <div class="card mb-3 col-md-7">
            <div class="card-body">
                    <h4>Comentários: {{$post->comments->count()}}</h4>
                    <ol class="group-list list-group-numbered">
                    @foreach($post->comments as $comentario)
                        <li class="list-group-item"><b><a href="/user/{{ $comentario->user->id }}" class="link-underline-light">{{$comentario->user->name}}</a></b> {{ $comentario->content }} <small>{{ \Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y h:m') }}</small></li>
                    @endforeach
                    </ol>
                </h4>
            </div>
        </div>

        <div class="card mb-3 col-md-7">
            <div class="card-body">
                    <h4>Likes: {{$post->likes->count()}}</h4>
                    <ul class="group-list list-group-numbered">
                    @foreach($post->likes as $curtiu)
                        <li class="list-group-item"><a href="/user/{{ $curtiu->user->id }}" class="link-underline-light">{{$curtiu->user->name}}</a></li>
                    @endforeach
                    </ul>
                </h4>
            </div>
        </div>
    </div>
</div>
@endsection
