@extends('layouts.app')
@section('content')
<div class="container">

    <!-- EXIBE MENSAGENS DE SUCESSO -->
    @if(\Session::has('success'))
        <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{\Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-body">
        <h5>Crie um novo Post:</h5>                
        <form action="/post" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" placeholder="Escreva um comentário"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2 float-end">Salvar</button>
        </form>
</div>
        </div>
    </div>
    </div>  

    <div class="row justify-content-center mt-4">
        @foreach($listaPosts as $umPost)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $umPost->user->name }}
                        <a href="/post/{{ $umPost->id }}/destroy" class="btn btn-outline-danger btn-sm float-end">Deletar</a> 
                        <!-- <a href="/post/{{ $umPost->id }}/edit" class="btn btn-outline-warning btn-sm float-end me-2">Editar</a> -->
                    </div>
                    <div class="card-body text-center">
                        {{ $umPost->content }}
                        <br>
                        <span class="float-end"> 
                        <small class="text-muted">
                        {{\Carbon\Carbon::parse($umPost->created_at)->format('d/m/Y h:m')}}
                        </small>
                        </span>
                    </div>
                    @if($umPost->likes->count() > 0 || $umPost->comments->count() > 0)
                    <div class="card-footer">
                        @if($umPost->comments->count() > 0)
                        <p>
                            Comentários: 
                            <span class="badge rounded-pill bg-primary">
                            {{ $umPost->comments->count() }}
                            </span>
                        </p>
                        <ul class="list-group">
                            @foreach($umPost->comments as $umComment)
                                <li class="list-group-item">
                                    <a href="/user/{{$umComment->user->id}}" class="link-underline-light"><b>{{$umComment->user->name}}:</b></a> {{ $umComment->content }} 
                                    <small class="text-muted">
                                        {{\Carbon\Carbon::parse($umComment->created_at)->format('d/m/Y h:m')}}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        @if($umPost->likes->count() > 0)
                        <p class="mt-2">
                            Likes:
                            <span class="badge rounded-pill bg-primary">
                            {{ $umPost->likes->count() }}
                            </span>
                            <ul class="list-group">
                            @foreach($umPost->likes as $umLike)
                                <li class="list-group-item">
                                <a href="/user/{{ $umLike->user->id }}" class="link-underline-light">{{ $umLike->user->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
