<!-- begin modal dialog -->

<div class="modal fade" id="frmproducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }}
                    {{ __('validation.attributes.banner') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }}
                    {{ __('validation.attributes.banner') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" v-model="nombre" style="text-transform: uppercase;">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.nombre" >
                            <li class="parsley-required">@{{ errors.nombre }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="tipo_producto">Tipo de Producto</label>
                        <select type="text" class="form-select " name="tipo_producto" v-model="tipo_producto"
                            required>
                            <option :value="tp.id" v-for="tp in tipoProducto">@{{ tp.tipo_producto }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.tipo_producto">
                            <li class="parsley-required">@{{ errors.tipo_producto }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="tipo_producto">Ciudad de Venta</label>
                        <select type="text" class="form-select " name="id_ciudad" v-model="id_ciudad"
                            required>
                            <option :value="cd.id" v-for="cd in ciudadVenta">@{{ cd.departamento }}
                            </option>
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.id_ciudad">
                            <li class="parsley-required">@{{ errors.tipo_producto }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio Actual (Bs)</label>
                        <input type="number" class="form-control" name="precio" v-model="precio">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.precio">
                            <li class="parsley-required">@{{ errors.precio }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" v-model="descripcion">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.descripcion">
                            <li class="parsley-required">@{{ errors.descripcion }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="enlace">Enlace</label>
                        <input type="text" class="form-control" name="enlace" v-model="enlace">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.enlace">
                            <li class="parsley-required">@{{ errors.enlace }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="presentacion">Presentación</label>
                        <input type="text" class="form-control" name="presentacion" v-model="presentacion">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.presentacion">
                            <li class="parsley-required">@{{ errors.presentacion }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen*</label>
                        <template v-if="imagen">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen" required class="filestyle" id="imagen"
                                name="imagen" data-buttonname="btn-primary" data-buttontext="Seleccionar...">
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen">
                            <li class="parsley-required">@{{ errors.imagen }}</li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeProducto()" class="btn btn-success"><i class="fa fa-save"></i>
                        {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                    <a href="#" @click.prevent="storeProducto()" class="btn btn-success"><i class="fa fa-save"></i>
                        {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i>
                    {{ __('messages.botones.cerrar') }} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
