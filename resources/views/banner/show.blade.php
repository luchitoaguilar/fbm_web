@extends('layouts.template')

@section('titulo', 'COFADENA | Boletin')

@section('class_navbar', 'rd-navbar rd-navbar-default')

@section('data_navbar', '')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('contenido')

    <section class="section-md">
        <div class="bg-decor d-flex align-items-center"
            data-parallax-scroll="{&quot;y&quot;: 50,  &quot;smoothness&quot;: 50}"><img
                src="{{ asset('assets/imagenes_background/bg-decor-10.png') }}" alt="" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="section-title" data-aos="fade-up">
                        <h2><strong>Boletin informativo</strong></h2>
                        <p>Corporacion de las Fuerzas Armadas para el Desarrollo Nacional</p>
                    </div>
                </div>
            </div>
            <!-- ======= Menu Section ======= -->
            <div class="container" data-aos="fade-up">
                <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach ($boletin as $boletin)
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <iframe src="{{ asset($boletin->archivo) }}" type="application/pdf"
                                        frameBorder="0"
                                        scrolling="auto"
                                        height="700px"
                                        width="1200px"></iframe>
                                </div>
                            </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('pages/manuales/index.js') }}" type="text/javascript"></script>
@endsection
