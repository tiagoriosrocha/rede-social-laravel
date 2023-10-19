@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($listaPosts as $umPost)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $umPost->user->name }}
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
                    <div class="card-footer">
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
                        <br>
                        <p>
                            Likes:
                            <span class="badge rounded-pill bg-primary">
                            {{ $umPost->likes->count() }}
                            </span>
                            <ul class="list-group">
                            @foreach($umPost->likes as $umLike)
                                <li class="list-group-item">
                                    {{ $umLike->user->name }}
                                </li>
                            @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
