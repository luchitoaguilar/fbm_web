@extends('layouts.default')

@section('title', 'Reporte')

@section('content')
    <div id="variables-app">
        <div class="content">
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
                <li class="breadcrumb-item active">{{ __('validation.attributes.variables') }}</li>
            </ol>


            <h1 class="page-header">{{ __('validation.attributes.variables') }} <small></small></h1>

            <div class="row">

                <div class="col-xl-12">

                    <div class="panel panel-inverse">

                        <div class="panel-heading">
                            <h4 class="panel-title">Detalle de {{ __('validation.attributes.variables') }}</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                    data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="btn-group float-right"
                                    v-if="{{ \Auth::user()->rol_id }}==2 || {{ \Auth::user()->rol_id }}==1 ">
                                    <a href="#" @click.prevent="newVariables"
                                        class="btn btn-success waves-effect waves-light m-l-10"><i class="fa fa-plus"></i>
                                        Nuevo</a>
                                </div>
                                <hr>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Pago del personal zafrero</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.precio_pago_zafrero" name="precio_pago_zafrero" class="form-control mb-5px" placeholder="Pago por zafrero (Bs.)" readonly readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Nombre del Gerente COFADENA</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.gerente_cofadena" name="gerente_cofadena" class="form-control mb-5px" placeholder="Nombre del Gerente COFADENA" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Cargo del Gerente COFADENA</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.cargo_gerente_cofadena" name="cargo_gerente_cofadena" class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Nombre del Gerente UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.gerente_upab" name="gerente_upab" class="form-control mb-5px" placeholder="Nombre del Gerente UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Cargo del Gerente UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.cargo_gerente_upab" name="cargo_gerente_upab" class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Nombre del Jefe de Producción UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.jefe_prod_upab" name="jefe_prod_upab" class="form-control mb-5px" placeholder="Nombre del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Cargo del Jefe de Producción UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.cargo_jefe_prod_upab" name="cargo_jefe_prod_upab" class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Nombre del Auxiliar de Producción UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.aux_prod_upab" name="aux_prod_upab" class="form-control mb-5px" placeholder="Nombre del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Cargo del Auxiliar de Producción UPAB</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="modelo.cargo_aux_prod_upab" name="cargo_aux_prod_upab" class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-15px">
                                        <label class="form-label col-form-label col-md-3">Gestión</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="modelo.gestion" name="gestion" class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" readonly/>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- begin includes -->
        @include('modules.Administrador.Variables.frmvariables')
        <!-- end includes -->
    </div>


@endsection

@push('variables')
    var auth = {!! Auth::user() !!};
    var listar_variables = '{{ route('listar_variables') }}';
    var guardar_variables = '{{ route('guardar_variables') }}'
    {{--  var datos_variables = '{{ route('buscar_variables', '') }}';  --}}
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Administrador/Variables/variable.js') !!}
@endpush
