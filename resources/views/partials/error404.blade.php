@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
    <!-- BEGIN #app -->
    <div id="app" class="app">
        <!-- BEGIN error -->
        <div class="error">
            <div class="error-code">Error 404</div>
            <div class="error-content">
                <div class="error-message">No pudimos encontrar la pagina que esta buscando...</div>
                <div class="error-desc mb-4">
                    La pagina que esta buscando no existe o quizas ud no tenga los permisos necesarios. <br />
                    Si necesita ayuda contactese con la UTIC utic@cofadena.gob.bo
                </div>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-success px-3">Regrese al Inicio</a>
                </div>
            </div>
        </div>
        <!-- END error -->
    </div>

@endsection

