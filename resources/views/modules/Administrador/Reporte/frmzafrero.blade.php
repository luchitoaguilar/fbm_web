<!-- begin modal dialog -->
<div class="modal fade" id="frmzafrero" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.zafrero') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.zafrero') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="nombres" v-model="nombres" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.nombres" >
                            <li class="parsley-required">@{{ errors.nombres }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="paterno">Apellido Paterno</label>
                        <input type="text" class="form-control" name="paterno" v-model="paterno" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.paterno" >
                            <li class="parsley-required">@{{ errors.paterno }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="materno">Apellido Materno</label>
                        <input type="text" class="form-control" name="materno" v-model="materno" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.materno" >
                            <li class="parsley-required">@{{ errors.materno }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="ci">Carnet de Identidad</label>
                        <input type="number" class="form-control" name="ci" v-model="ci" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.ci" >
                            <li class="parsley-required">@{{ errors.ci }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" v-model="complemento" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.complemento" >
                            <li class="parsley-required">@{{ errors.complemento }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="expedido_id">Expedido @{{ persona }}</label>
                        <select type="text" class="form-select " name="expedido_id" v-model="expedido_id"
                            required>
                            <option :value="tp.id" v-for="tp in lugarExpedido">@{{ tp.expedido }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.expedido_id">
                            <li class="parsley-required">@{{ errors.expedido_id }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" class="form-control" name="telefono" v-model="telefono" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.telefono" >
                            <li class="parsley-required">@{{ errors.telefono }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" v-model="fecha_nacimiento" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.fecha_nacimiento" >
                            <li class="parsley-required">@{{ errors.fecha_nacimiento }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                        <select type="text" class="form-select " name="lugar_nacimiento_id" v-model="lugar_nacimiento_id"
                            required>
                            <option :value="tp.id" v-for="tp in lugarNacimiento">@{{ tp.departamento }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.lugar_nacimiento_id">
                            <li class="parsley-required">@{{ errors.lugar_nacimiento_id }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto*</label>
                        <template v-if="foto">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.foto}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_foto" required class="filestyle" id="foto"
                                name="foto" data-buttonname="btn-primary" data-buttontext="Seleccionar...">
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.foto">
                            <li class="parsley-required">@{{ errors.foto }}</li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeZafrero()" class="btn btn-success"><i class="fa fa-save"></i>
                        {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                    <a href="#" @click.prevent="storeZafrero()" class="btn btn-success"><i class="fa fa-save"></i>
                        {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i>
                    {{ __('messages.botones.cerrar') }} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
