@extends('layouts.default')

@section('title', 'Vehiculo')

@section('content')
    <div id="vehiculo-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.vehiculo') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.vehiculo') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.vehiculo') }}</h4>
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
                                    v-if="{{ \Auth::user()->rol_id }}==2 || {{ \Auth::user()->rol_id }}==1 ">
                                    <a href="#" @click.prevent="createVehiculo"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i
                                            class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
<hr>
                            <table id="tabla-vehiculo" name="tabla-vehiculo"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Vehiculo.frmvervehiculo')
        @include('modules.Administrador.Vehiculo.frmvehiculo')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_vehiculo = '{{ route('listar_vehiculo') }}';
    var datos_vehiculo = '{{ route('buscar_vehiculo', '') }}';
    var guardar_vehiculo = '{{ route('guardar_vehiculo') }}';
    var actualizar_vehiculo = '{{ route('actualizar_vehiculo', '') }}';
    var eliminar_vehiculo = '{{ route('eliminar_vehiculo', '') }}';

@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Vehiculo/vehiculo.js') !!}
@endpush
