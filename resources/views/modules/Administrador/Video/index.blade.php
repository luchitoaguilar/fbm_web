@extends('layouts.template')

@section('title', 'Videos')

@section('contenido')
    <div id="video-app">
        <div id="page-header" class="section-container page-header-container bg-dark">

            <div class="page-header-cover">
                <img src="../fotos_upab/20210516_073501.jpg" alt="" />
            </div>


            <div class="container">
                <h1 class="page-header"><b>Videos</h1>
            </div>

        </div>


        <div class="section-container">

            <div class="container">

                <div class="search-container" style="justify-content: center">
                    @if (count($video) > 0)
                        <div class="salto">
                            @foreach ($video as $video)
                                <div class="col-md-12 col-xs-12 col-md-6">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <div class="card border-5" style="width: 100%">
                                            <video style="width: 100%" src="{{ asset($video->video) }}#t=0.001" controls
                                                playsinline>
                                                <source src="{{ asset($video->video) }}#t=0.001" type="video/mp4" />
                                                <source src="{{ asset($video->video) }}" type="video/ogv" />
                                                <source type="{{ asset($video->video) }}" type="video/webm" />
                                            </video>
                                            {{-- <a href="#" @click.prevent="mostrarVideo({{ $video->id }})"><img class="card-img-top"
                                                src="{{ asset('images/logo_upab.png') }}" alt="" height="250px" width="100%" /></button> --}}
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $video->titulo }}</h5>
                                                {{-- <a href="{{ route('video_ver', $video->id) }}" class="btn btn-primary">Conozca mas..</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <p style="background:#1e3469; opacity: 0.6; color:white; font-weight:bold; padding:15px; border:3px solid #f3e498; margin-top:10px; margin-bottom:10px; text-align:center; font-size:22px;
                                                    border-radius:10px;"><strong>NO EXISTEN VIDEOS EN ESTE MOMENTO</strong>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Video.frmmostrarvideo')
        <!-- end includes -->


    </div>
@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var datos_video = '{{ route('buscar_video', '') }}';
    var guardar_video = '{{ route('guardar_video') }}';
    var mostrar_video = '{{ route('mostrar_video', '') }}';
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Video/video.js') !!}
@endpush
