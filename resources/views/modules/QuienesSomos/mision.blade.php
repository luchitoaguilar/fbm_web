@extends('layouts.template')

@section('title', 'Mision')

@section('contenido')
    <div id="about-us-cover" class="has-bg section-container">

        <div class="cover-bg">
            <img src="{{asset('images/fondo10.jpg')}}" width="100%" alt="" />
        </div>


        <div class="container">

            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Misión</li>
            </ul>


            <div class="about-us text-center">
                <h1 style="font-family:monospace;">MISIÓN</h1>
                
                    <p style="font-size: 25px; font-family:verdana; color: white; ">
                        LA FABRICA BOLIVIANA DE MUNICIÓN “F.B.M.” TIENE LA MISIÓN DE PRODUCIR MUNICIÓN DE DIFERENTES
                        CALIBRES,
                        ASÍ COMO SUMINISTRAR Y BRINDAR SERVICIOS DE MANTENIMIENTO DE ARMAS PARA LAS FUERZAS MILITARES Y
                        POLICIALES
                        A FIN DE CONTRIBUIR CON LA SEGURIDAD Y DEFENSA DEL ESTADO PLURINACIONAL DE BOLIVIA, EL
                        FORTALECIMIENTO DE LAS FF.AA. Y EL DESARROLLO INTEGRAL DEL PAÍS.
                    </p>
                
            </div>

        </div>

    </div>


    {{-- <div id="about-us-content" class="section-container bg-white">

    <div class="container">

        <div class="about-us-content">

            <div class="row">

                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-muted"><i class="fa fa-star"></i></div>
                        <div class="info">
                            <h4 class="title">Calidad</h4>
                            <p class="desc">Conjunto de características inherentes que cumple con los requisitos exigidos.</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-blue"><i class="fa fa-arrow-up-wide-short"></i></div>
                        <div class="info">
                            <h4 class="title">Eficacia</h4>
                            <p class="desc">Alcanzar las metas establecidas en esta Unidad.</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-info"><i class="fa fa-award"></i></div>
                        <div class="info">
                            <h4 class="title">Eficiencia</h4>
                            <p class="desc">Alcanzar nuestras metas con la menor cantidad de recursos.</p>
                        </div>
                    </div>
                </div>

            </div>

            <hr />

            <div class="row">

                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-danger"><i class="fab fa-connectdevelop"></i></div>
                        <div class="info">
                            <h4 class="title">Transparencia</h4>
                            <p class="desc">Basados en valores éticos y morales.</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-dark"><i class="fas fa-industry"></i></div>
                        <div class="info">
                            <h4 class="title">Industrializacion</h4>
                            <p class="desc">Producción de bienes a gran escala.</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4">
                    <div class="service">
                        <div class="icon text-success"><i class="fa fa-money-bill-1"></i></div>
                        <div class="info">
                            <h4 class="title">Economia</h4>
                            <p class="desc">Generando empleos.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div> --}}

@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    {{--  var listar_banner = '{{ route('Banner.listar') }}';
    var datos_banner = '{{ route('Banner.getBanner', '') }}';  --}}
@endpush

@push('scripts')
    {{--  {!! Html::script('assets/js/modules/Administrador/Banner/banner.js') !!}  --}}
@endpush
