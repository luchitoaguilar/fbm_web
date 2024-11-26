<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title', 'Login')</title>
    {{ Html::favicon( '/images/cofadena.ico' ) }}

<!-- Styles -->
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900') !!}
    {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style('assets/css/vendor.min.css') !!}
    {!! Html::style('assets/css/app.min.css') !!}

</head>

<body class='pace-top'>
<!-- BEGIN #loader -->
<div id="loader" class="app-loader">
    <div class="material-loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
        <div class="message">Cargando...</div>
    </div>
</div>
<!-- END #loader -->

<!-- BEGIN #app -->
<div id="app" class="app">
    <!-- BEGIN login -->
    <div class="login login-with-news-feed">
        <!-- BEGIN news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url({{ url('/') }}/assets/img/logo/fbm_logo.png)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>COFADENA</b> | Pagina WEB</h4>
                <p>
                    FABRICA BOLIVIA DE MUNICIÓN - COFADENA
                </p>
            </div>
        </div>
        <!-- END news-feed -->

        <!-- BEGIN login-container -->
        <div class="login-container">
        @include('partials.errors')
            <!-- BEGIN login-header -->
            <div class="login-header mb-30px">
                <div class="brand">
                    <div class="d-flex align-items-center">
{{--                        <span ><img class="app-logo" src="{{url('/')}}/images/logo_cofadena.png" style="width: 80%"></span>--}}

                        <b>COFADENA </b> | FBM
                    </div>
                    <small>Sistema de Administracion Pagina WEB</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- END login-header -->

            <!-- BEGIN login-content -->
            <div class="login-content">
                <form method="post" action="{{ url('/login') }}" class="fs-13px" data-parsley-validate="true">
                    {!! csrf_field() !!}
                    <div class="form-floating mb-15px">
                        <input type="text" class="form-control h-45px fs-13px" placeholder="Correo Electrónico"
                               id="email" name="email" value="{{ old('email') }}" />
                        <label for="email" class="d-flex align-items-center fs-13px text-gray-600"
                               data-parsley-required="true">Correo Electrónico</label>
                    </div>
                    <div class="form-floating mb-15px">
                        <input type="password" class="form-control h-45px fs-13px" placeholder="Contraseña"
                               id="password" name="password"/>
                        <label for="password" class="d-flex align-items-center fs-13px text-gray-600"
                               data-parsley-required="true">Contraseña</label>
                    </div>
                    <div class="form-check mb-30px">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberMe"/>
                        <label class="form-check-label" for="rememberMe">
                            Recuerdame
                        </label>
                    </div>
                    <div class="mb-15px">
                        <button type="submit" class="btn btn-cyan d-block h-45px w-100 btn-lg fs-14px">Iniciar Sesión
                        </button>
                    </div>
                    <div class="mb-40px pb-40px text-dark">
                        {{-- No tiene usuario? Click <a href="#" class="text-primary">aqui</a> para solicitar a la UTIC. --}}
                        No tiene Usuario? Contactese con el area de informatica
                    </div>
                    <hr class="bg-gray-600 opacity-2"/>
                    <div class="text-gray-600 text-center  mb-0">
                        &copy; FBM Todos los derechos reservados 2024
                    </div>
                </form>
            </div>
            <!-- END login-content -->
        </div>
        <!-- END login-container -->
    </div>
    <!-- END login -->
    <!-- BEGIN scroll-top-btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i
            class="fa fa-angle-up"></i></a>
    <!-- END scroll-top-btn -->
</div>
<!-- END #app -->

<!-- Scripts -->

{!! Html::script('assets/plugins/parsleyjs/dist/parsley.min.js') !!}
{!! Html::script('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') !!}
{{--    {!! Html::script('assets/assets/js/demo/render.highlight.js') !!}--}}
{!! Html::script('assets/js/vendor.min.js') !!}
{!! Html::script('assets/js/app.min.js') !!}
</body>
</html>
