<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>FBM | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/fbm_logo2.png') }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="Unidad Productiva Agricola Bermejo" />
    <meta content="" name="FBM" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    {!! Html::style('assets/css/e-commerce/vendor.min.css') !!}
    {!! Html::style('assets/css/e-commerce/app.min.css') !!}
    {{-- VIDEO BANNER --}}
    {!! Html::style('assets/css/video-banner/video.css') !!}
    {!! Html::style('assets/css/video-banner/estilo.css') !!}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- ================== END core-css ================== -->
    @stack('css')
</head>

<body>
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade show">
        <!-- BEGIN #top-nav -->
        <div id="top-nav" class="top-nav">
            <!-- BEGIN container -->
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="https://maps.app.goo.gl/ewcnXVN1JgbbTxvx8" target="_blank" > <i class="fa fa-map"> </i> Dirección: Av. Bilbao Rioja No. 13, Cotapachi - Quillacollo -
                                Bolivia</a>
                            </li>
                        </li>
                    </ul>
                    @if ($zafra)
                    <ul class="nav navbar-nav">
                        <li>
                            <a style="color: yellow"><i class="fa fa-bullseye"></i> Municion cal. 9x19mm {{ date('Y') }}: {{ round($zafra ?? '',2) }} Ton.</a>
                            </li>
                        </li>
                    </ul>
                    @endif
                    <ul class="nav navbar-nav navbar-end">
                        <li><a href="https://www.facebook.com/fbmcofadena" target="_blank"><i class="fab fa-facebook-f f-s-14"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter f-s-14"></i></a></li>
                         <li><a href="#"><i class="fab fa-instagram f-s-14"></i></a></li>
                        <li><a href="#"><i class="fab fa-dribbble f-s-14"></i></a></li>
                        <li><a href="#"><i class="fab fa-google f-s-14"></i></a></li> 
                    </ul>
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #top-nav -->
        <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN containocupeer -->
            <div class="container container-xl">
                <!-- BEGIN header-container -->
                <div class="header-container ">
                    <!-- BEGIN navbar-toggle -->
                    <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#navbar-collapse">
                        <span style="align-content: center"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- END navbar-toggle -->
                    <!-- BEGIN header-logo -->
                    <div class="header-logo">

                        <a href="{{ route('inicio') }}">
                            <img src="{{ asset('assets/img/logo/fbm_logo2.png') }}" alt="" />
                            <h3>|</h3>
                            <span class="brand-text">
                                
                                {{--  <span>COFADENA</span>  --}}
                                <small>Fabrica Boliviana de Munición</small>
                                
                            </span>
                        </a>
                    </div>
                    <!-- END header-logo -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <div class="collapse navbar-collapse navbar-expand-xxxl" id="navbar-collapse">
                            <ul class="nav justify-content-center">
                                <li class="active"><a href="{{ route('inicio') }}">Inicio</a></li>
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-bs-toggle="dropdown">
                                       Acerca de
                                        <b class="caret"></b>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('mision') }}">Mision</a>
                                        <a class="dropdown-item" href="{{ route('vision') }}">Vision</a>
                                        <a class="dropdown-item" href="{{ route('objetivos') }}">Objetivos</a>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-bs-toggle="dropdown">
                                        Productos
                                        <b class="caret"></b>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('municion9') }}">Municion Cal. 9x19mm</a>
                                        <a class="dropdown-item" href="{{ route('municion762') }}">Municion Cal. 7,62x51mm</a>
                                        <a class="dropdown-item" href="{{ route('armamento') }}">Armamento</a>
                                        <a class="dropdown-item" href="{{ route('primers') }}">Primers</a>
                                        <a class="dropdown-item" href="{{ route('puntas_plomo') }}">Puntas de plomo</a>
                                        <a class="dropdown-item" href="{{ route('equipo_militar') }}">Equipo Militar</a>
                                        <a class="dropdown-item" href="{{ route('replicas') }}">Replicas</a>
                                        <a class="dropdown-item" href="{{ route('otros') }}">Otros</a>
                                    </div>
                                </li>
                                <li><a href="{{ route('requisitos') }}">Requisitos</a></li>
                                <li><a href="{{ route('formularios') }}">Formularios</a></li>
                                <li><a href="{{ route('video') }}">Videos</a></li>
                                <li><a href="{{ route('noticia') }}">Noticias</a></li>
                                <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END header-nav -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav justify-content-end">
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('login') }}">
                                    <img src="{{ asset('assets/img/user/soldado.png') }}" class="user-img" alt="" /> 
                                    <span class="d-none d-xl-inline">Login</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->

        <!-- Main content -->
        @yield('contenido')
        <!-- Main content -->


        @include('includes.template_commerce.pre_footer')

        @include('includes.template_commerce.footer')


    </div>
    <!-- END #page-container -->

    <!-- ================== BEGIN BASE JS ================== -->
    {!! Html::script('assets/js/e-commerce/vendor.min.js') !!}
    {!! Html::script('assets/js/e-commerce/app.min.js') !!}
    {{-- VIDEO BANNER --}}
    {!! Html::script('assets/js/video-banner/estilo.js') !!}
    {!! Html::script('assets/js/video-banner/video.js') !!}
    {{--  componente para vue-js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    <script type="text/javascript">

        //para cambiar el idioma a los datatables y otros
        var ruta_tabla_traduccion = '{{ route('api.getTraduccionTabla') }}';
    
        @stack('variables')
    
    </script>

</body>

</html>
