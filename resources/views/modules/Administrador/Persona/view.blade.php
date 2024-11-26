@extends('layouts.default')

@section('title', 'Persona')

@section('content')
    <div id="persona-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.persona') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.persona') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.persona') }}</h4>
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
                                    <a href="#" @click.prevent="newPersona"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i
                                            class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                            </div>
                            <hr>
                            <table id="tabla-persona" name="tabla-persona"
                                class="table table-striped table-bordered align-middle">
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- begin includes -->
        @include('modules.Administrador.Persona.frmpersona')
        @include('modules.Administrador.Persona.frmverpersona')
        <!-- end includes -->

    </div>


@endsection

@push('variables')

    var auth = {!! Auth::user() !!};
    var listar_persona = '{{ route('personas') }}';
    var datos_persona = '{{ route('buscar_persona', '') }}';
    var guardar_persona = '{{ route('guardar_persona') }}';
    var actualizar_persona = '{{ route('actualizar_persona', '') }}';
    var eliminar_persona = '{{ route('eliminar_persona', '') }}';
    var lugar_nacimiento = '{{ route('listar_ciudad') }}'
    var expedido = '{{ route('listar_expedido') }}'
    var activar_persona = '{{ route('activar_persona', '') }}'

@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Persona/persona.js') !!}
@endpush
