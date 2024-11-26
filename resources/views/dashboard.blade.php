@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
    <div id="unidad-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>


            <h1 class="page-header">DASHBOARD <small>Informacion general...</small></h1>


            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-teal">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-star fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">BANNER</div>
                            <div class="stats-number">{{ $banner }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.destinado / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_banner') }}">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">PRODUCTOS</div>
                            <div class="stats-number">{{ $producto }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.item / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_producto') }}" >Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-pink">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-video fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">VIDEO</div>
                            <div class="stats-number">{{ $video }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.eventual / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_video') }}">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-gray">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-newspaper fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">NOTICIA</div>
                            <div class="stats-number">{{ $noticia }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.consultor / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_noticia') }}">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-red">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-car fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">VEHICULO</div>
                            <div class="stats-number">{{ $vehiculo }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.consultor / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_vehiculo') }}" >Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-leaf fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">ZAFRA</div>
                            <div class="stats-number">{{ round($zafra,2) }} Ton.</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: @{{ tipo_contrato.consultor / tipo_contrato.total * 100 }}%;"></div>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('listar_zafra') }}">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                {{--  <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Ultimos usuarios agregados</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                   data-toggle="panel-collapse"><i
                                        class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger"
                                   data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">

                            <table id="tabla-usuario" name="tabla-usuario" class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>  --}}

                {{-- <div class="col-xl-4">
                    <div class="panel panel-inverse" data-sortable-id="index-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Calendario</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default"
                                   data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="datepicker-inline"
                                 class="datepicker-full-width overflow-y-scroll position-relative">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection

{{--            @include('administrador.dependencia.frmdependencia')--}}


@push('variables')

    {{--  var lista_usuarios = '{{ route('dashboard.getListDataTableUsuario') }}';
    var lista_tipo_contrato = '{{ route('dashboard.getListTipoContrato') }}';  --}}

@endpush

@push('scripts')

    {{--  {!! Html::script(mix('assets/js/modules/Administrador/dashboard.js')) !!}  --}}
@endpush
