@extends('layouts.template')

@section('title', 'Vision')

@section('contenido')
<div id="about-us-cover" class="has-bg section-container">

    <div class="cover-bg">
        <img src="{{asset('images/fondo6.jpg')}}" width="100%" alt="" />
    </div>


    <div class="container">

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active">Visión</li>
        </ul>


        <div class="about-us text-center">
            <h1 style="">VISIÓN</h1>
            <p style="font-size: 25px; font-family:verdana; color: white;background-color: #000; opacity:0.7">
                SER LA EMPRESA LÍDER Y REFERENTE DEL PAÍS EN LA PRODUCCIÓN Y DISTRIBUCIÓN DE MUNICIÓN DE DIFERENTES CALIBRES CON CERTIFICACIÓN NACIONAL E INTERNACIONAL.
            </p>
        </div>

    </div>

</div>



@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    {{--  var listar_banner = '{{ route('Banner.listar') }}';
    var datos_banner = '{{ route('Banner.getBanner', '') }}';  --}}
@endpush

@push('scripts')
    {{--  {!! Html::script('assets/js/modules/Administrador/Banner/banner.js') !!}  --}}
@endpush
