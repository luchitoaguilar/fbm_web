@extends('layouts.template')

@section('title', 'Inicio')

@section('css')
    <style media="screen">

    </style>
@endsection
@section('contenido')
    <!-- BEGIN #slider -->
    <div id="slider" class="section-container p-0 bg-dark">
        <div id="banner" style="width: 100%; position: relative; bottom:0p; ">
            {{-- BOTON DE PAUSA --}}
            {{-- <div class="btn-pause" id="btnPause">
                <i class="fa fa-pause"></i>
            </div> --}}
            {{-- BOTON DE VOLUMEN --}}
            {{-- <div class="btn-audio" id="btnAudio">
                <i class="fa fa-volume-up"></i>
            </div>  --}}

            <video loop muted autoplay playsInline preload="auto" id="video">

                <source src="{{ asset('assets/video/fbm_final.mp4') }}">

            </video>

            <div class="content">
                <h3 class="title mb-5px fadeInLeftBig animated" style="font-size: 70px">FABRICA BOLIVIANA DE MUNICIÓN</h3>
            </div>

        </div>
        <!-- BEGIN carousel -->
        {{-- <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
            <!-- BEGIN carousel-inner -->
            <div class="carousel-inner">
                <!-- BEGIN item -->
                @foreach ($banner as $banner)
                    <div class="{{ $loop->iteration == 1 ? 'carousel-item active' : 'carousel-item' }}"
                        style="background: url({{ $banner->imagen_fondo }}) center 0 / cover no-repeat;">
                        @if ($banner->imagen_frente != null)
                            <div class="container">
                                <img src="{{ $banner->imagen_frente }}"
                                    class="product-img right bottom fadeInRight animated" alt="" />
                            </div>
                        @endif
                        <div class="carousel-caption carousel-caption-left">
                            <div class="container">
                                @if ($banner->nombre != null)
                                    <h3 class="title mb-5px fadeInLeftBig animated">{{ $banner->nombre }}</h3>
                                @endif
                                @if ($banner->datos != null)
                                    <p class="mb-15px fadeInLeftBig animated"> {{ $banner->datos }}</p>
                                @endif
                                @if ($banner->precio != null)
                                    <div class="price mb-30px fadeInLeftBig animated"><small>Desde</small>
                                        <span>Bs.{{ $banner->precio }}</span>
                                    </div>
                                @endif
                                @if ($banner->enlace != null)
                                    <a href="{{ $banner->enlace }}"
                                        class="btn btn-outline btn-lg fadeInLeftBig animated">Conozca mas...</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- END item -->
            </div>
            <!-- END carousel-inner -->
            <a class="carousel-control-prev" href="#main-carousel" data-bs-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#main-carousel" data-bs-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div> --}}
        <!-- END carousel -->
    </div>
    <!-- END #slider -->

    <!-- BEGIN franja -->
    {{-- <div id="policy" class="section-container bg-dark" style="align-content: center; text-align: center">

        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 mb-12 mb-md-0">
                    <div class=" bg-grey">
                        <div class="policy-info bg-grey-dark " style="color: white">
                            <h2>FABRICA BOLIVIANA DE MUNICIÓN</h2>
                            <h5>"SENTANDO SOBERANÍA PRODUCTIVA PARA EL DESARROLLO NACIONAL"</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div> --}}
    <!-- END franja -->
   <br>

    <!-- BEGIN acerca de nosotros -->
    <div id="about-us-cover" class="section-container pt-20px bg-Secondary" style="background-image: url({{asset('images/fondo8.jpg')}}); background-repeat: no-repeat;width: 100%; height: 20%; position: relative;background-size: cover;">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN account-container -->
            <div class="account-container">
                <!-- BEGIN account-sidebar -->
                <div class="account-sidebar" style="width: 100%">
                    <div class="account-sidebar-cover">
                        {{-- <img src="../assets/img/cover/municion1.jpg" alt="" /> --}}
                    </div>
                    <div class="account-sidebar-content">
                        <h4 class="mb-1 mb-lg-3">Acerca de Nosotros</h4>
                        <p class="mb-0 mb-md-2 mb-lg-3">
                            FABRICA BOLIVIANA DE MUNICIÓN
                        </p>
                    </div>
                </div>
                <!-- END account-sidebar -->
                <!-- BEGIN account-body -->
                <div class="account-body">
                    <!-- BEGIN row -->
                    <div class="row">
                        <div class="col-md-12" style="text-align: justify">
                            <h4><img src="{{ asset('assets/img/logo/fbm_logo4.png') }}" width="20%" alt="" /></h4>
                            <h5>LA FÁBRICA BOLIVIANA DE MUNICIÓN – COFADENA (F.B.M.) FUE CREADA EL 5 DE ABRIL DE 1979 POR
                                DECRETO SUPREMO 16359,
                                MEDIANTE EL CUAL EL SUPREMO GOBIERNO ADJUDICA A LA EMPRESA MATRA MANURHIN DE FRANCIA, LA
                                IMPLEMENTACIÓN DE UNA FÁBRICA DE MUNICIÓN DE INFANTERÍA.</h5>
                                {{-- <h5>,
                                    CON UNA CAPACIDAD DE 18.000.000 DE CARTUCHOS DE GUERRA Y 2.000.000 DE CARTUCHOS DE SALVA
                                    ANUAL</h5> --}}

                            <h5>MEDIANTE RESOLUCIÓN MINISTERIAL Nº 2021 DEL 03 DE NOVIEMBRE DE 1981, LA F.B.M.
                                SE CONSTITUYE EN UNA EMPRESA DE CARÁCTER ESTRATÉGICO,
                                DECLARADA DE “RESERVA Y SEGURIDAD”, LAS CONSTRUCCIONES E INSTALACIONES. </h5>

                            <h5> LA FABRICA BOLIVIANA DE MUNICIÓN, FUE CREADA PARA SATISFACER LAS NECESIDADES DE
                                REQUERIMIENTO DE MUNICIÓN DE LAS FUERZAS ARMADAS,
                                EN SUS 45 AÑOS DE EXISTENCIA, HA CONTRIBUIDO AL DESARROLLO NACIONAL Y AL FORTALECIMIENTO DE
                                COFADENA COMO EMPRESA ESTRATÉGICA. </h5>

                            <h5> LOS RECURSOS HUMANOS QUE PARTICIPAN ACTIVAMENTE EN LA TOMA DE DECISIONES TÉCNICAS Y
                                ESTRATÉGICAS, ESTÁ COMPUESTO POR MILITARES INGENIEROS Y CIVILES,
                                QUE EN COORDINACIÓN CON LOS TÉCNICOS SUB OFICIALES Y SARGENTOS DE LAS FF.AA., SE CONSTITUYEN EN
                                LA BASE DEL TRIÁNGULO ORGANIZACIONAL Y EL BRAZO PRODUCTIVO
                                MÁS IMPORTANTE PARA EL CRECIMIENTO Y DIVERSIFICACIÓN DE LAS ACTIVIDADES DE LA EMPRESA, SE
                                HAN LOGRADO RESULTADOS ECONÓMICOS Y SOCIALES IMPORTANTES QUE VAN EN BENEFICIO DIRECTO DE LAS
                                FF.AA.
                                DE LA NACIÓN Y DEL CRECIMIENTO DEL APARATO PRODUCTIVO DEL PAÍS.</h5>

                            <br>
                        </div>
                    </div>
                    <!-- END row -->
                </div>
                <!-- END account-body -->
            </div>
            <!-- END account-container -->
        </div>
        <!-- END container -->
    </div>
    <!-- END acerca de nosotros -->

<br>

    <!-- BEGIN politicas -->
    <div id="policy" class="section-container bg-white" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <div class="policy">
                        <div class="policy-icon"><img src="{{asset('assets/img/politicas/762mm1.png')}}" width="100%"
                                alt="" />
                        </div>
                        <div class="policy-info">
                            <h4>MUNICIÓN</h4>
                            <p>Diferentes calibres</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <div class="policy">
                        <div class="policy-icon"><img src="{{asset('assets/img/politicas/pistola.png')}}" width="140%"
                                alt="" />
                        </div>
                        <div class="policy-info">
                            <h4>ARMAMENTO</h4>
                            <p>Variedad de armas para la venta</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <div class="policy">
                        <div class="policy-icon"><img src="../assets/img/politicas/primers.png" width="70%"
                                alt="" />
                        </div>
                        <div class="policy-info">
                            <h4>PRIMERS</h4>
                            <p>Todo para su munición</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END politicas -->
<br>

    {{-- BEGIN PRODUCTOS --}}
    <div id="about-us-cover" class="section-container pt-20px bg-Secondary" style="background: linear-gradient(#082C51, #6A4E3B); background-repeat: no-repeat;width: 100%; height: 20%; ">
        <main class="col-md-10 mx-auto" style="align-content: center;">
            <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col">
                        {{-- <div class="card h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/municion9-3.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Municion Cal. 9x19mm</h2>
                                <p class="card-s__description">
                                  Municion cal. 9x19mm para todo uso.
                                </p>
                              </div>
                              <a href="{{ route('municion9') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('assets/img/acercaDe/municion1.jpeg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Municion Cal. 7,62x51mm</h2>
                                <p class="card-s__description">
                                  Municion cal. 7,62x51mm de fabricacion Boliviana.
                                </p>
                              </div>
                              <a href="{{ route('municion762') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/armamento.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Armamento</h2>
                                <p class="card-s__description">
                                  Armamento de diferentes calibres y modelos.
                                </p>
                              </div>
                              <a href="{{ route('armamento') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/primers1.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Primers</h2>
                                <p class="card-s__description">
                                  Materia prima de primera calidad.
                                </p>
                              </div>
                              <a href="{{ route('primers') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/puntas1.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Puntas de Plomo</h2>
                                <p class="card-s__description">
                                  Puntas en base a plomo recubiertas.
                                </p>
                              </div>
                              <a href="{{ route('puntas_plomo') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/equipo1.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Equipo Militar</h2>
                                <p class="card-s__description">
                                  Material para su equipo militar de combate.
                                </p>
                              </div>
                              <a href="{{ route('equipo_militar') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/replica.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Replicas</h2>
                                <p class="card-s__description">
                                  Replicas de pistola.
                                </p>
                              </div>
                              <a href="{{ route('replicas') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                    <div class="col">
                        {{-- <div class="card-s h-100 shadow-sm">  --}}
                            <article class="card-s">
                            <img
                              class="card-s__background"
                              src="{{ asset('images/llaveros.jpg') }}"
                              alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                              width="1920"
                              height="2193"
                            />
                            <div class="card-s__content | flow">
                              <div class="card-s__content--container | flow">
                                <h2 class="card-s__title">Otros</h2>
                                <p class="card-s__description">
                                  Llaveros y otros.
                                </p>
                              </div>
                              <a href="{{ route('otros') }}"><button class="card-s__button">Ver mas..</button></a>
                            </div>
                          </article>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </main>
    </div>
    {{-- EBD PRODUCTO --}}

    <br>

    <!-- BEGIN noticias -->
    @if (count($noticia) > 0)
        <div id="trending-items" class="section-container"
            style="background-image: url({{asset('images/image.png')}}); background-repeat: no-repeat; background-size: cover;">

            <div class="container  d-flex justify-content-center">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-3" style="color: white">Ultimas Noticias </h3>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-secondary mb-3 mr-1" data-bs-target="#carouselExampleIndicators2"
                            role="button" data-bs-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-secondary mb-3 " href="#carouselExampleIndicators2" role="button"
                            data-bs-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-12 col-md-12" >
                        <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel" style="height: 600px; width:100%;">

                            <div class="carousel-inner">
                                <div class="row col-md-12" style="justify-content: center">
                                    <div class="col-md-8">
                                        @foreach ($noticia as $noticia)
                                            @if ($noticia->id == $loop->last)
                                                <div class="carousel-item active">
                                                    <div class="card">
                                                        <img class="img-fluid" src="{{ $noticia->imagen_0 }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $noticia->titulo }}</h4>
                                                            {{--  <p class="card-text">{{$noticia->descripcion}}</p>  --}}
                                                            <a href="{{ route('noticia_ver', $noticia->id) }}"
                                                                class="btn btn-sm btn-outline-primary">Conozca mas..</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="carousel-item ">
                                                    <div class="card">
                                                        <img class="img-fluid" src="{{ $noticia->imagen_0 }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $noticia->titulo }}</h4>
                                                            {{--  <p class="card-text">{{$noticia->descripcion}}</p>  --}}
                                                            <a href="{{ route('noticia_ver', $noticia->id) }}"
                                                                class="btn btn-sm btn-outline-primary">Conozca mas..</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- END noticias -->


    <!-- BEGIN suscribirse -->
    {{-- <div id="subscribe" class="section-container">
        <div class="container">
            <div class="row">

                <div class="col-md-8 mb-4 mb-md-0">
                    <div class="subscription">
                        <div class="subscription-intro">
                            <h4> Mantente en contacto</h4>
                            <p>Recibe todas las novedades</p>
                        </div>
                        <div class="subscription-form">
                            <form name="subscription_form" action="index.html" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Ingrese su correo electronico" />
                                    <button type="submit" class="btn btn-dark"><i class="fa fa-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END suscribirse -->



@endsection

@push('css')
    {!! Html::style('assets/css/card-ventas/card-ventas.css') !!}
@endpush

@section('scripts')
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
@endsection
