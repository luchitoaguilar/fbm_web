@extends('layouts.template')

@section('title', 'Noticias')

@section('contenido')
    <div id="noticia-app">
        <div id="page-header" class="section-container page-header-container bg-dark">

            <div class="page-header-cover">
                <img src="../fotos_upab/20210512_111910.jpg" alt="" />
            </div>


            <div class="container">
                <h1 class="page-header"><b>Noticias</h1>
            </div>

        </div>


        <div class="section-container">

            <div class="container">

                <div class="search-container" style="justify-content: center">
                    @if (count($noticia) > 0)
                        @foreach ($noticia as $noticia)
                            <div class="row"  style="width: 100%">
                                <div class="col-xl-10 col-sm-6" style="width: 100%">
                                    <div class="card border-5">
                                        <img class="card-img-top" src="{{ $noticia->imagen_0 }}" alt="" height="250px"
                                            width="100%" />
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                            <p class="card-text" {{ $noticia->descripcion }}</p>
                                                <a href="{{ route('noticia_ver', $noticia->id) }}" class="btn btn-primary">Conozca mas..</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row justify-content-center">
                            <p style="background:#1e3469; opacity: 0.6; color:white; font-weight:bold; padding:15px; border:3px solid #f3e498; margin-top:10px; margin-bottom:10px; text-align:center; font-size:22px;
                                    border-radius:10px;"><strong>NO EXISTEN
                                    NOTICIAS EN
                                    ESTE
                                    MOMENTO</strong>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection
