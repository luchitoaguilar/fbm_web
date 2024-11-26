<!-- begin modal dialog -->
<div class="modal fade" id="frmvariables" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }}
                    {{ __('validation.attributes.variables') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }}
                    {{ __('validation.attributes.variables') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Gestión</label>
                        <div class="col-md-9">
                            <input readonly type="number" v-model="gestion" name="gestion" class="form-control mb-5px" placeholder="Ingrese la Gestión"/>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Pago del personal zafrero</label>
                        <div class="col-md-9">
                            <input type="text" v-model="precio_pago_zafrero" name="precio_pago_zafrero"
                                class="form-control mb-5px" placeholder="Pago por zafrero (Bs.)" />
                            <small>debe registrar el monto que se les paga por tonelada</small>
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.precio_pago_zafrero">
                                <li class="parsley-required">@{{ errors.precio_pago_zafrero }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Nombre del Gerente COFADENA</label>
                        <div class="col-md-9">
                            <input type="text" v-model="gerente_cofadena" name="gerente_cofadena"
                                class="form-control mb-5px" placeholder="Nombre del Gerente COFADENA" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.gerente_cofadena">
                                <li class="parsley-required">@{{ errors.gerente_cofadena }}</li>
                            </ul>
                            <small>ingrese el nombre del Gerente General de COFADENA de la presente gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Cargo del Gerente COFADENA</label>
                        <div class="col-md-9">
                            <input type="text" v-model="cargo_gerente_cofadena" name="cargo_gerente_cofadena"
                                class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19"
                                v-if="errors.cargo_gerente_cofadena">
                                <li class="parsley-required">@{{ errors.cargo_gerente_cofadena }}</li>
                            </ul>
                            <small>ingrese el cargo del Gerente COFADENA de la presente gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Nombre del Gerente UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="gerente_upab" name="gerente_upab"
                                class="form-control mb-5px" placeholder="Nombre del Gerente UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.gerente_upab">
                                <li class="parsley-required">@{{ errors.gerente_upab }}</li>
                            </ul>
                            <small>ingrese el nombre del Gerente General de UPAB de la presente gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Cargo del Gerente UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="cargo_gerente_upab" name="cargo_gerente_upab"
                                class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.cargo_gerente_upab">
                                <li class="parsley-required">@{{ errors.cargo_gerente_upab }}</li>
                            </ul>
                            <small>ingrese el cargo del Gerente UPAB de la presente gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Nombre del Jefe de Producción UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="jefe_prod_upab" name="jefe_prod_upab"
                                class="form-control mb-5px" placeholder="Nombre del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.jefe_prod_upab">
                                <li class="parsley-required">@{{ errors.jefe_prod_upab }}</li>
                            </ul>
                            <small>ingrese el nombre del Nombre del Jefe de Producción UPAB de la presente
                                gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Cargo del Jefe de Producción UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="cargo_jefe_prod_upab" name="cargo_jefe_prod_upab"
                                class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19"
                                v-if="errors.cargo_jefe_prod_upab">
                                <li class="parsley-required">@{{ errors.cargo_jefe_prod_upab }}</li>
                            </ul>
                            <small>ingrese el cargo del Jefe de Producción UPAB de la presente gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Nombre del Auxiliar de Producción
                            UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="aux_prod_upab" name="aux_prod_upab"
                                class="form-control mb-5px" placeholder="Nombre del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.aux_prod_upab">
                                <li class="parsley-required">@{{ errors.aux_prod_upab }}</li>
                            </ul>
                            <small>ingrese el nombre del Nombre del Auxiliar de Producción UPAB de la presente
                                gestion</small>
                        </div>
                    </div>
                    <div class="row mb-15px">
                        <label class="form-label col-form-label col-md-3">Cargo del Auxiliar de Producción UPAB</label>
                        <div class="col-md-9">
                            <input type="text" v-model="cargo_aux_prod_upab" name="cargo_aux_prod_upab"
                                class="form-control mb-5px" placeholder="Cargo del Jefe de Producción UPAB" />
                            <ul class="parsley-errors-list filled" id="parsley-id-19"
                                v-if="errors.cargo_aux_prod_upab">
                                <li class="parsley-required">@{{ errors.cargo_aux_prod_upab }}</li>
                            </ul>
                            <small>ingrese el cargo del Auxiliar de Producción UPAB de la presente gestion</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeVariables()" class="btn btn-success"><i
                            class="fa fa-save"></i>
                        {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                    <a href="#" @click.prevent="storeVariables()" class="btn btn-success"><i
                            class="fa fa-save"></i>
                        {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i
                        class="fa fa-window-close"></i>
                    {{ __('messages.botones.cerrar') }} </button>
            </div>
        </div>
    </div>
</div>
