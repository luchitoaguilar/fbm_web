@extends('layouts.default')

@section('title', 'Reporte')

@section('content')
    <div id="reporte-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.reporte') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.reporte') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.zafrero') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-form-label col-lg-4" for="fecha_inicio">Fecha
                                        Inicio</label>
                                    <div class="col-lg-8">
                                        <input type="date" class="form-control" name="fecha_inicio"
                                            v-model="fecha_inicio">
                                        <ul class="parsley-errors-list filled" id="parsley-id-19"
                                            v-if="errors.fecha_inicio">
                                            <li class="parsley-required">@{{ errors.fecha_inicio }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="form-label col-form-label col-lg-4" for="fecha_fin">Fecha Fin</label>
                                    <div class="col-lg-8">
                                        <input type="date" class="form-control" name="fecha_fin" v-model="fecha_fin">
                                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.fecha_fin">
                                            <li class="parsley-required">@{{ errors.fecha_fin }}</li>
                                        </ul>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="form-label col-form-label col-md-4"> </label>
                                            <div class="col-md-8 pt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" v-model="tipoReporte" id="tipoReporte" value="Diario"
                                                        name="tipoReporte" />
                                                    <label class="form-check-label" for="tipoReporte1">Diario</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" v-model="tipoReporte" id="tipoReporte" value="Global"
                                                        name="tipoReporte" />
                                                    <label class="form-check-label" for="tipoReporte2">Global(mensual)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                                <div class="col-md-12" style="text-align: center">
                                    <a href="#" @click.prevent="reporteDiario()" class="btn btn-lg btn-primary">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-file-text fa-3x me-3 text-black"></i>
                                            <span>
                                                <span class="d-block"><b>Generar Reporte</b></span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- begin includes -->
            @include('modules.Administrador.Zafrero.frmzafrero')
            @include('modules.Administrador.Zafrero.frmverzafrero')
            <!-- end includes -->

        </div>


    @endsection

    @push('variables')
        var auth = {!! Auth::user() !!};
        var get_personal = '{{ route('zafreros') }}';
        var imprimir_reporte_diario = '{{ route('imprimir_reporte_diario') }}';
        
    @endpush

    @push('scripts')
        {!! Html::script('assets/js/modules/Administrador/Reporte/reporte.js') !!}
    @endpush
