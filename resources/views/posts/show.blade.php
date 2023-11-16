@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-md-7">
            <div class="card-header">
                {{$post->user->name}} - {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i:s') }} 
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

        <!-- @if($post->photos->count() > 0)
        <div class="card mb-3 col-md-7">
            <div class="card-body">
                <img src="/storage/image/{{ $post->photos[0]->image_path }}" class="rounded img-fluid float-none">   
            </div>
        </div>
        @endif -->

        @if($post->photos->count() > 0)
        <div class="card mb-3 col-md-7">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    @for($i=0; $i<count($post->photos); $i++)
                    <div class="carousel-item @if($i==0) active @endif">
                        <img src="/storage/image/{{ $post->photos[$i]->image_path }}" class="d-block w-50" />   
                    </div>
                    @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        @endif

        <div class="card mb-3 col-md-7">
            <div class="card-body">
                    <h4>Comentários: {{$post->comments->count()}}</h4>
                    <ol class="group-list list-group-numbered">
                    @foreach($post->comments as $comentario)
                        <li class="list-group-item"><b><a href="/user/{{ $comentario->user->id }}" class="link-underline-light">{{$comentario->user->name}}</a></b> {{ $comentario->content }} <small>{{ \Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y H:i:s') }}</small></li>
                    @endforeach
                    </ol>
                </h4>
                
                <br>
                <h5>Novo Comentário:</h5>
                <form action="/comment" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea class="form-control" name="content" rows="3" placeholder="Escreva um comentário"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Comentar</button>
                </form>
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
