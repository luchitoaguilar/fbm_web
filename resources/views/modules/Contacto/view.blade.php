@extends('layouts.default')

@section('title', 'Contacto')

@section('content')
    <div id="contacto-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.contacto') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.contacto') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.contacto') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
<hr>
                            <table id="tabla-contacto" name="tabla-contacto"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Contacto.frmvercontacto')
        {{-- @include('modules.Administrador.Foto.frmfoto')
        @include('modules.Administrador.Foto.frmmostrarfoto') --}}
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_foto = '{{ route('foto') }}';
    var datos_contacto = '{{ route('buscar_contacto', '') }}';
    var reply_contacto = '{{ route('reply_contacto', '') }}';

    {{-- var guardar_contacto = '{{ route('guardar_contacto') }}'; --}}

@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Contacto/contacto.js') !!}
@endpush
