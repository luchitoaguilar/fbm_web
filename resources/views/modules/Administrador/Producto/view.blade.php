@extends('layouts.default')

@section('title', 'Producto')

@section('content')
    <div id="producto-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.producto') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.producto') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.producto') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="col-md-12" style="text-align:right;">
                                <div class="btn-group float-right" v-if="{{ \Auth::user()->cargo_id }}==1 ">
                                    <a href="#" @click.prevent="createProducto"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i
                                            class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
                            <hr>
                            <table id="tabla-producto" name="tabla-producto"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Producto.frmverproducto')
        @include('modules.Administrador.Producto.frmproducto')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_producto = '{{ route('listar_producto') }}';
    var datos_producto = '{{ route('buscar_producto', '') }}';
    var guardar_producto = '{{ route('guardar_producto') }}';
    var actualizar_producto = '{{ route('actualizar_producto', '') }}';
    var eliminar_producto = '{{ route('eliminar_producto', '') }}';

    var getTipoProducto = '{!! route('lista_tipoProducto')!!}';
    var getCiudadVenta = '{!! route('lista_ciudadVenta')!!}';
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Producto/producto.js') !!}
@endpush
