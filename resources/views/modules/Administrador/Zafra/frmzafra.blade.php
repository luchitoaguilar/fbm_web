<!-- begin modal dialog -->

<div class="modal fade" id="frmzafra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.zafra') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.zafra') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="num_recibo">Numero de Recibo</label>
                        <input type="number" class="form-control" name="num_recibo" v-model="num_recibo" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.num_recibo"><li class="parsley-required">@{{ errors.num_recibo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="tipo_cosecha">Tipo de Cosecha</label>
                        <select type="text" class="form-select " name="tipo_cosecha" v-model="tipo_cosecha">
                            
                            <option value="Manual">Manual</option>
                            <option value="Mecanizada">Mecanizada</option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.tipo_cosecha">
                            <li class="parsley-required">@{{ errors.tipo_cosecha }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="personal_zafra_id">Personal de Zafra</label>
                        <select type="text" class="selectpicker form-control" name="personal_zafra_id" id="ex-search"  v-model="personal_zafra_id" multiple>
                            
                            <option :value="p.id" v-for="p in personal">@{{ p.nombres }} @{{ p.paterno }} @{{ p.materno }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.personal_zafra_id">
                            <li class="parsley-required">@{{ errors.personal_zafra_id }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="cod_vehiculo">Placa Vehiculo</label>
                        <select type="text" class="form-select " name="cod_vehiculo" v-model="cod_vehiculo"
                            required>
                            
                            <option :value="veh.id" v-for="veh in vehiculos">@{{ veh.placa }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.cod_vehiculo">
                            <li class="parsley-required">@{{ errors.cod_vehiculo }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha Ingreso</label>
                        <input type="date" class="form-control" name="fecha_ingreso" v-model="fecha_ingreso" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.fecha_ingreso"><li class="parsley-required">@{{ errors.fecha_ingreso }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="peso_neto">Peso Neto</label>
                        <input type="number" class="form-control" name="peso_neto" v-model="peso_neto" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.peso_neto"><li class="parsley-required">@{{ errors.peso_neto }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones (opcional)</label>
                        <input type="number" class="form-control" name="observaciones" v-model="observaciones">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.observaciones"><li class="parsley-required">@{{ errors.observaciones }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo (opcional)</label>
                        <template v-if="archivo">
                            <div><img class=" ml-5 rounded" :src="modelo.archivo" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_archivo" class="filestyle" id="archivo" name="archivo" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.archivo"><li class="parsley-required">@{{ errors.archivo }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeZafra()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeZafra()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>

<!-- end modal dialog -->
