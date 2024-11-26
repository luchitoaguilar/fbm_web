@extends('layouts.template')

@section('title', 'Armamento')

@section('contenido')
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade show" style="
  background: rgba(76, 175, 80, 0.1);
  background: url(/images/fondo23.jpg);
  background-repeat: no-repeat; background-size: cover;" >

        <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-dark"  style="background: linear-gradient(#044486, #6A4E3B); opacity:0.9">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                {{-- <img src="../assets/img/cover/azucar_cover.jpg" alt="" /> --}}
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header"><b>Armamento</b></h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->

        <!-- BEGIN search-results -->
        <div id="search-results" class="section-container">
            <!-- BEGIN container -->
            <div class="container"
                style="width:100vw;display:flex;justify-content:space-around;flex-wrap:wrap;padding:40px 20px;">

                @foreach ($producto as $producto)
                    {{-- 2 es cbba, en el futuro si cambia el precio por ciudades se implementa--}}
                    @if (2 == $producto->id_ciudad)
                        <div class="card">
                            <div class="card-image">
                                @if ($producto->imagen != null)
                                    <img src="{{ $producto->imagen }}">
                                @endif
                            </div>
                            <div class="card-text">
                                @if ($producto->nombre != null || $producto->presentacion != null)
                                    <p class="card-meal-type">{{ $producto->presentacion }}</p>
                                    <h2 class="card-title">{{ $producto->nombre }}</h2>
                                    <p class="card-body">{{ $producto->descripcion }}</p>
                                @endif
                            </div>
                            @if ($producto->precio != null)
                                <strong><div class="card-price">{{ $producto->precio }} Bs</div></strong>
                            @endif
                        </div>
                    @endif
                @endforeach

            </div>
            <!-- END container -->
        </div>
        <!-- END search-results -->

    </div>
    <!-- END #page-container -->
@endsection

@push('css')
    {!! Html::style('assets/css/productos/productos.css') !!}
@endpush