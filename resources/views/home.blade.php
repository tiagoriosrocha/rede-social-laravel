@extends('layouts.app')

@section('head')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">    
        <style>
            .h1 {
                letter-spacing: -0.02em;
            }
            .dropzone {
                overflow-y: auto;
                border: 0;
                background: transparent;
            }
            .dz-preview {
                width: 70px;
                margin: 0 !important;
                height: 50px;
                padding: 5px;
                position: relative !important;
                top: -110px;
            }
            .dz-photo {
                height: 100%;
                width: 100%;
                overflow: hidden;
                border-radius: 12px;
                background: #eae7e2;
            }
            .dz-drag-hover .dropzone-drag-area {
                border-style: solid;
                border-color: #86b7fe;;
            }
            .dz-thumbnail {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .dz-image {
                width: 90px !important;
                height: 90px !important;
                border-radius: 6px !important;
            }
            .dz-remove {
                display: none !important;
            }
            .dz-delete {
                width: 24px;
                height: 24px;
                background: rgba(0, 0, 0, 0.57);
                position: absolute;
                opacity: 0;
                transition: all 0.2s ease;
                top: 30px;
                right: 30px;
                border-radius: 100px;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dz-delete > svg {
                transform: scale(0.75);
                cursor: pointer;
            }
            .dz-preview:hover .dz-delete, 
            .dz-preview:hover .dz-remove-image {
                opacity: 1;
            }
            .dz-message {
                height: 100%;
                margin: 0 !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dropzone-drag-area {
                height: 120px;
                position: relative;
                padding: 0 !important;
                border-radius: 10px;
                border: 3px dashed #dbdeea;
            }
            .was-validated .form-control:valid {
                border-color: #dee2e6 !important;
                background-image: none;
            }
        </style>
@endsection


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
        <form method="POST" action="/post" class="overflow-visible p-0" id="formDropzone" enctype="multipart/form-data" novalidate>
            @csrf
            <input hidden id="file" name="file" multiple="multiple" />
            <div class="form-group">
                <label class="form-label text-muted opacity-75 fw-medium" for="content">
                            Texto:
                        </label>    
                <textarea class="form-control" name="content" rows="3" placeholder="Escreva um comentário"></textarea>
            </div>
            <div class="form-group mb-4">
                        <label class="form-label text-muted opacity-75 fw-medium" for="formImage">
                            Image
                        </label>
                        <div class="dropzone dropzone-drag-area form-control" id="previews">      
                            <div class="d-none" id="dzPreviewContainer">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-photo">
                                        <img class="dz-thumbnail" data-dz-thumbnail />
                                    </div>
                                    
                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        
                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                <span>Arraste e solte suas imagens!</span>
                            </div> 
                        </div>
            </div>
            <div class="form-group mb-4">      
                    <button class="btn btn-primary fw-medium py-3 px-4 mt-3 float-end" id="formSubmit" type="submit">
                        <span class="spinner-border spinner-border-sm d-none me-2" aria-hidden="true"></span>
                        Salvar
                    </button>
            </div>
        </form>
</div>
        </div>
    </div>
    </div>  

    <div class="row justify-content-center mt-4">
        @for($i=0; $i< count($listaPosts); $i++)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $listaPosts[$i]->user->name }}
                        <span class="float-end">
                            <small class="text-muted">
                                {{\Carbon\Carbon::parse($listaPosts[$i]->created_at)->format('d/m/Y H:i:s')}}
                            </small>
                            <a href="/post/{{ $listaPosts[$i]->id }}" class="btn btn-outline-primary btn-sm">Detalhes</a>  
                            <a href="/post/{{ $listaPosts[$i]->id }}/destroy" class="btn btn-outline-danger btn-sm">Deletar</a>
                        </span>
                    </div>
                    <div class="card-body">

                    @if($listaPosts[$i]->photos->count() > 0)
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div id="carousel_{{ $i }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @for($j=0; $j<count($listaPosts[$i]->photos); $j++)
                                    <div class="carousel-item @if($j==0) active @endif">
                                        <img src="/storage/image/{{ $listaPosts[$i]->photos[$j]->image_path }}" width="160px" height="150px" />   
                                    </div>
                                    @endfor
                                </div>
                                @if($listaPosts[$i]->photos->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $i }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $i }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span classs="position-absolute bottom-50 end-50">{{ $listaPosts[$i]->content }}</span>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <span classs="position-absolute bottom-50 end-50">{{ $listaPosts[$i]->content }}</span>
                        </div>
                    </div>
                    @endif
                    
                    </div>
                    @if($listaPosts[$i]->likes->count() > 0 || $listaPosts[$i]->comments->count() > 0)
                    <div class="card-footer">
                        @if($listaPosts[$i]->comments->count() > 0)
                        <p>
                            Comentários: 
                            <span class="badge rounded-pill bg-primary">
                            {{ $listaPosts[$i]->comments->count() }}
                            </span>
                        </p>
                        <ul class="list-group">
                            @foreach($listaPosts[$i]->comments as $umComment)
                                <li class="list-group-item">
                                    <a href="/user/{{$umComment->user->id}}" class="link-underline-light"><b>{{$umComment->user->name}}:</b></a> {{ $umComment->content }} 
                                    <small class="text-muted">
                                        {{\Carbon\Carbon::parse($umComment->created_at)->format('d/m/Y h:m')}}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        @if($listaPosts[$i]->likes->count() > 0)
                        <p class="mt-2">
                            Likes:
                            <span class="badge rounded-pill bg-primary">
                            {{ $listaPosts[$i]->likes->count() }}
                            </span>
                            <ul class="list-group">
                            @foreach($listaPosts[$i]->likes as $umLike)
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
        @endfor
    </div>
</div>
@endsection

@section('javascript')
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;

            /**
             * Setup dropzone
             */
            $('#formDropzone').dropzone({
                previewTemplate: $('#dzPreviewContainer').html(),
                url: '/post',
                addRemoveLinks: true,
                autoProcessQueue: false,       
                uploadMultiple: true,
                parallelUploads: 3,
                maxFiles: 3,
                acceptedFiles: '.jpeg, .jpg, .png, .gif',
                thumbnailWidth: 900,
                thumbnailHeight: 600,
                previewsContainer: "#previews",
                timeout: 0,
                init: function() 
                {
                    myDropzone = this;

                    // when file is dragged in
                    this.on('addedfile', function(file) { 
                        $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
                    });
                },
                success: function(file, response) 
                {
                    console.log(response);
                    window.location.href = '/home'
                }
            });

            /**
             * Form on submit
             */
            $('#formSubmit').on('click', function(event) {
                event.preventDefault();
                var $this = $(this);
                
                // show submit button spinner
                $this.children('.spinner-border').removeClass('d-none');
                
                // validate form & submit if valid
                if ($('#formDropzone')[0].checkValidity() === false) {
                    event.stopPropagation();

                    // show error messages & hide button spinner    
                    $('#formDropzone').addClass('was-validated'); 
                    $this.children('.spinner-border').addClass('d-none');

                    // if dropzone is empty show error message
                    if (!myDropzone.getQueuedFiles().length > 0) {                        
                        $('.dropzone-drag-area').addClass('is-invalid').next('.invalid-feedback').show();
                    }
                } else {

                    // if everything is ok, submit the form
                    myDropzone.processQueue();
                }
            });

        </script>
@endsection
