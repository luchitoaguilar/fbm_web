@extends('layouts.template')

@section('title', 'Replicas')

@section('contenido')
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade show" style="
  background: rgba(76, 175, 80, 0.1);
  background: url(/images/llaveros.jpg);
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
                <h1 class="page-header"><b>Otros</b></h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->

        {{-- PARA SELECCIONAR LA CIUDAD EN EL FUTURO IMPLEMENTACION --}}
        {{-- @if (!$_GET)    
            @php($id_ciudad = 9)
        @else
            @php($id_ciudad = $_GET['id_ciudad'])
        @endif --}}
   
        <!-- BEGIN search-results -->
        <div id="search-results" class="section-container">

             {{-- PARA IMPLEMENTAR EN EL FUTURO LAS CIUDADES DIFERENTES PRODUCTOS O PRECIOS --}}
                {{-- <div class="search-toolbar">
                    <div class="row">
                        <div class="col-lg-3">
                            <h4>Envios a todo el País</h4>
                        </div>
                        <div class="col-lg-9 text-end">
                            <ul class="sort-list">
                                <li class="text"><i class="fa fa-globe"></i> Seleccione su Ciudad: </li>
                                @foreach ($ciudad as $ciudad)
                                    <li value="{{ $ciudad->id }}"
                                        class="{{ $id_ciudad == $ciudad->id ? 'active' : '' }}" onclick="getValue(this)">
                                        <a href="#">{{ $ciudad->departamento }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}
                
                
                
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
                                {{-- <strong><div class="card-price">{{ $producto->precio }} Bs</div></strong> --}}
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
<script type="text/javascript">
    function getValue(e) {
        const ciudad = e.value;
        location.href = '?id_ciudad=' + ciudad;
    }
</script>
