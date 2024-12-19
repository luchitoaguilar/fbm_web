@extends('layouts.default')

@section('title', 'Foto')

@section('content')
    <div id="foto-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.foto') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.foto') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.foto') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="col-md-12" style="text-align:right;">
                                <div class="btn-group float-right"
                                    v-if="{{ \Auth::user()->cargo_id }}==1 ">
                                    <a href="#" @click.prevent="createFoto"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i
                                            class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
<hr>
                            <table id="tabla-foto" name="tabla-foto"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Foto.frmverfoto')
        @include('modules.Administrador.Foto.frmfoto')
        @include('modules.Administrador.Foto.frmmostrarfoto')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_foto = '{{ route('foto') }}';
    var datos_foto = '{{ route('buscar_foto', '') }}';
    var guardar_foto = '{{ route('guardar_foto') }}';
    var eliminar_foto = '{{ route('eliminar_foto', '') }}';
    var mostrar_foto = '{{ route('mostrar_foto', '') }}';

@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Foto/foto.js') !!}
@endpush
