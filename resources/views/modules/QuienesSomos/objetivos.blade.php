@extends('layouts.template')

@section('title', 'Objetivos')

@section('contenido')
    <div id="about-us-cover" class="has-bg section-container">

        <div class="cover-bg">
            <img src="{{asset('images/fondo13.jpg')}}" width="100%" alt="" />
        </div>


        <div class="container">

            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Objetivos</li>
            </ul>


            <div class="about-us text-center">
                <h1>PRINCIPALES OBJETIVOS ESTRATÉGICOS INSTITUCIONALES</h1>
            </div>

        </div>

    </div>


    <div id="about-us-content" class="section-container bg-white">

        <div class="container">

            <div class="about-us-content">

                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="service">
                            <div class="icon text-info"><i class="fa fa-graduation-cap"></i></div>
                            <div class="info">
                                <h4 class="title">MEJORAR LA COMPETITIVIDAD Y SOSTENIBILIDAD DE LAS EMPRESAS Y LAS UNIDADES
                                    PRODUCTIVAS MEDIANTE EL APROVECHAMIENTO EFICIENTE DE SU CAPACIDAD INSTALADA.</h4>
                                {{-- <p class="desc">Conjunto de características inherentes que cumple con los requisitos exigidos.</p> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="service">
                            <div class="icon text-muted"><i class="fa fa-key"></i></div>
                            <div class="info">
                                <h4 class="title">POSICIONAR Y CONSOLIDAR EN EL ÁMBITO NACIONAL E INTERNACIONAL, LA IMAGEN
                                    DE COFADENA COMO CORPORACIÓN DEL SECTOR DEFENSA QUE PRODUCE BIENES
                                    Y SERVICIOS CON ALTOS ESTÁNDARES DE CALIDAD, QUE APORTA AL DESARROLLO NACIONAL, DEFENSA
                                    ESTRATÉGICA DEL ESTADO Y BIENESTAR DE LA SOCIEDAD.</h4>
                                {{-- <p class="desc">Conjunto de características inherentes que cumple con los requisitos exigidos.</p> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>

    </div>

@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    {{-- var listar_banner = '{{ route('Banner.listar') }}';
    var datos_banner = '{{ route('Banner.getBanner', '') }}'; --}}
@endpush

@push('scripts')
    {{-- {!! Html::script('assets/js/modules/Administrador/Banner/banner.js') !!} --}}
@endpush
