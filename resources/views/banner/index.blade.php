@extends('layouts.template')

@section('titulo', 'COFADENA | Banner')

@section('class_navbar', 'rd-navbar rd-navbar-default')

@section('data_navbar', '')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style_team.css') }}">
@endsection

@section('contenido')
    <div class="bg-decor d-flex align-items-center"
         data-parallax-scroll="{&quot;y&quot;: 50,  &quot;smoothness&quot;: 50}">
        <img src="{{ asset('assets/imagenes_background/bg-decor-10.png') }}" alt=""/>
    </div>
    <div class="section-title" data-aos="fade-up">
        <h2><strong>Banner</strong></h2>
    </div>
    <div class="container" data-aos="fade-up">
        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
            @if ($agenda)
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ '/'.$banner->archivo }}"></iframe>
                </div>
            @else
                <div class="row justify-content-center col-12">
                    <p style="background:#1e3469; opacity: 0.6;
                    color:white; font-weight:bold; padding:15px; border:3px solid #f3e498; margin-top:10px; margin-bottom:10px; text-align:center; font-size:22px;
                    border-radius:10px;"><strong>NO EXISTEN BANNER EN ESTE MOMENTO</strong></p>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('scripts')
@endsection
