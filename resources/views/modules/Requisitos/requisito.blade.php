@extends('layouts.template')

@section('title', 'Requisitos')

@section('contenido')
    <div id="requisito-app">

        <!-- BEGIN #product -->
        <div id="product" class="section-container pt-1px pb-1px" style="bottom: 0px">
            <!-- BEGIN container -->
            <div class="containers">
                <!-- BEGIN row -->
                <div id="banner" style="width: 100%; position: relative; bottom:0px ">

                    <div class="btn-pause" id="btnPause">
                        <i class="fa fa-pause"></i>
                    </div>

                    <div class="btn-audio" id="btnAudio">
                        <i class="fa fa-volume-up"></i>
                    </div>

                    <video loop muted autoplay preload="auto" id="video">

                        <source src="{{ asset('assets/video/requisitos_militar.mp4') }}">

                    </video>

                    <div class="content" style="background-color: gray">

                        <h1>Requisitos Para Personal Fuerzas Armadas</h1>
                        <h2 style="text-align: left">- 3 Fotocopias del Carnet Militar</h2>
                        <h2 style="text-align: left">- 3 Fotocopias del Carnet Identidad Vigente</h2>
                        <h2 style="text-align: left">- 3 Fotocopias de la Boleta de Pago</h2>
                        <h2 style="text-align: left">- 2 Fotocopias Baucher Deposito</h2>
                    </div>

                </div>
                <!-- END row -->
            </div>
            <!-- END row -->
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Producto.frmverproducto')
        @include('modules.Administrador.Producto.frmproducto')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_producto = '{{ route('listar_producto') }}';
    var guardar_contacto = '{{ route('guardar_contacto') }}';
    var eliminar_producto = '{{ route('eliminar_producto', '') }}';

    {{--  var getContacto = '{!! route('getContacto') !!}';  --}}
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Contacto/contacto.js') !!}
@endpush
