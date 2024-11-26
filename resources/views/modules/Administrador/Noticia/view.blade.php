@extends('layouts.default')

@section('title', 'Noticia')

@section('content')
    <div id="noticia-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.noticia') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.noticia') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.noticia') }}</h4>
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
                                    <a href="#" @click.prevent="createNoticia"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i
                                            class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
<hr>
                            <table id="tabla-noticia" name="tabla-noticia"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Noticia.frmvernoticia')
        @include('modules.Administrador.Noticia.frmnoticia')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_banner = '{{ route('listar_banner') }}';
    var datos_noticia = '{{ route('buscar_noticia', '') }}';
    var guardar_noticia = '{{ route('guardar_noticia') }}';
    var actualizar_banner = '{{ route('actualizar_banner', '') }}';
    var eliminar_noticia = '{{ route('eliminar_noticia', '') }}';

@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Noticia/noticia.js') !!}
@endpush
