@extends('layouts.default')

@section('title', 'Zafra')

@push('css')
    {!! Html::style('assets/plugins/select-picker/dist/picker.min.css') !!}
@endpush

@section('content')
    <div id="zafra-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.zafra') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.zafra') }}<small></small></h1>

            <div class="alert alert-success alert-dismissible fade show">
                <h3>Hasta la fecha: se tiene un total de <strong>@{{ total_zafra }} Ton.</strong></h3>
            </div>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.zafra') }}</h4>
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
                                    <a href="#" @click.prevent="createZafra"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
                            <hr>
                            <table id="tabla-zafra" name="tabla-zafra"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Zafra.frmverzafra')
        @include('modules.Administrador.Zafra.frmzafra')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_zafra = '{{ route('listar_zafra') }}';
    var datos_zafra = '{{ route('buscar_zafra', '') }}';
    var guardar_zafra = '{{ route('guardar_zafra') }}';
    var actualizar_zafra = '{{ route('actualizar_zafra', '') }}';
    var personal_zafra = '{{ route('personal_zafra') }}';
    var eliminar_zafra = '{{ route('eliminar_zafra', '') }}';
    var get_vehiculos = '{{ route('get_vehiculo') }}';
    var get_personal = '{{ route('zafreros') }}';
    var get_total_zafra = '{{ route('get_total') }}';
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Zafra/zafra.js') !!}
    {!! Html::script('assets/plugins/select-picker/dist/picker.min.js') !!}
    <script>
        $('#ex-search').picker({
            search: true
        });
    </script>
@endpush
