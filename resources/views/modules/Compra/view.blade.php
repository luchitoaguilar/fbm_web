@extends('layouts.default')

@section('title', 'Compra')

@section('content')
    <div id="compra-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.compra') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.compra') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.compra') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <hr>
                            <table id="tabla-compra" name="tabla-compra"
                                class="table table-striped table-bordered align-middle"></table>

                        </div>
                        <br>
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <div class="alert alert-muted">
                                ENVIAR MENSAJE PREDETERMINADO</div>
                            <form role="form">
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">TITULO</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control mb-5px" placeholder="MENSAJE DE LA FBM"
                                            disabled />
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">MENSAJE</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" id="mensaje" name="mensaje" v-model="mensaje"></textarea>
                                        <small class="fs-12px text-gray-500-darker">Ingrese el mensaje que desea enviar de
                                            manera masiva, tome en cuenta que debe tener los contactos en su agenda</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" @click.prevent="replyWhatsappMasivoCompra()"
                                        class="btn bg-success btn-flat margin" style="text-align:center;display:block"><i
                                            class="fa fa-reply"></i>
                                        Enviar Mensaje</button>
                                </div>
                            </form>
                        </div>
                        <!-- END panel-body -->

                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Compra.frmvercompra')
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_foto = '{{ route('foto') }}';
    var datos_compra = '{{ route('buscar_compra', '') }}';
    var reply_compra = '{{ route('reply_compra', '') }}';
    var reply_whatsapp_compra = '{{ route('reply_whatsapp_compra', '') }}';
    var reply_whatsapp_compra_masiva = '{{ route('reply_whatsapp_compra_masiva', '') }}';

    {{-- var guardar_contacto = '{{ route('guardar_contacto') }}'; --}}
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Compra/compra.js') !!}
@endpush
