@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($listaPosts as $umPost)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        {{ $umPost->content }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
