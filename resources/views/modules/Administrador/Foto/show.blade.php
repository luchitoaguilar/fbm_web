@extends('layouts.template')

@section('title', 'Video Detalle')

@section('contenido')
    <!-- BEGIN #product -->
    <div id="product" class="section-container pt-20px">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN breadcrumb -->
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Detalle Video</a></li>
            </ul>
            <!-- END breadcrumb -->
            <!-- BEGIN product -->
            <div class="product">
                @foreach ($video as $video)
                    <!-- BEGIN product-detail -->
                    <div class="product-detail">
                        <!-- BEGIN product-image -->
                        <div class="product-image col-9">
                            <!-- BEGIN product-thumbnail -->
                            <div class="product-thumbnail">
                                <ul class="product-thumbnail-list">
                                    <li class="active"><a href="#" data-click="show-main-image"
                                            data-url="{{ url('') }}/{{ $video->imagen_0 }}"><img
                                                src="{{ url('') }}/{{ $video->imagen_0 }}" alt="" /></a></li>
                                    @if ($video->imagen_1 != '/assets/videos/images/video_default.png')
                                        <li><a href="#" data-click="show-main-image"
                                                data-url="{{ url('') }}/{{ $video->imagen_1 }}"><img
                                                    src="{{ url('') }}/{{ $video->imagen_1 }}" alt="" /></a></li>
                                    @endif
                                    @if ($video->imagen_2 != '/assets/videos/images/video_default.png')
                                        <li><a href="#" data-click="show-main-image"
                                                data-url="{{ url('') }}/{{ $video->imagen_2 }}"><img
                                                    src="{{ url('') }}/{{ $video->imagen_2 }}" alt="" /></a>
                                        </li>
                                    @endif
                                    @if ($video->imagen_3 != '/assets/videos/images/video_default.png')
                                        <li><a href="#" data-click="show-main-image"
                                                data-url="{{ url('') }}/{{ $video->imagen_3 }}"><img
                                                    src="{{ url('') }}/{{ $video->imagen_3 }}" alt="" /></a>
                                        </li>
                                    @endif
                                    @if ($video->imagen_4 != '/assets/videos/images/video_default.png')
                                        <li><a href="#" data-click="show-main-image"
                                                data-url="{{ url('') }}/{{ $video->imagen_4 }}"><img
                                                    src="{{ url('') }}/{{ $video->imagen_4 }}" alt="" /></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- END product-thumbnail -->
                            <!-- BEGIN product-main-image -->
                            <div class="product-main-image" data-id="main-image">
                                <img src="{{ url('') }}/{{ $video->imagen_0 }}" alt="" />
                            </div>
                            <!-- END product-main-image -->
                        </div>
                        <!-- END product-image -->
                        <!-- BEGIN product-info -->
                        <div class="product-info col-4">
                            <!-- BEGIN product-warranty -->
                            <div class="product-warranty">
                                <div>
                                    <h2 style="color: blue"><b>{{ $video->titulo }}</b></h2>
                                </div>
                            </div>
                            <!-- END product-warranty -->
                            <!-- BEGIN product-social -->
                            <div class="product-social">
                                <h5>{!!nl2br(str_replace(" ", " &nbsp;", $video->descripcion))!!}</h5>
                            </div>
                            <!-- END product-social -->
                        </div>
                        <!-- END product-info -->
                    </div>
                    <!-- END product-detail -->
                @endforeach
            </div>
            <!-- END product -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #product -->

@endsection
