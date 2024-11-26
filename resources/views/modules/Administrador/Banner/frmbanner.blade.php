<!-- begin modal dialog -->

<div class="modal fade" id="frmbanner" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.banner') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.banner') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form" class="form" >
                    @csrf
                    <div class="form-group">
                        <label for="nombre">nombre</label>
                        <input type="text" class="form-control" name="nombre" v-model="nombre">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.nombre"><li class="parsley-required">@{{ errors.nombre }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="datos">Datos</label>
                        <input type="text" class="form-control" name="datos" v-model="datos">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.datos"><li class="parsley-required">@{{ errors.datos }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio (opcional)</label>
                        <input type="number" class="form-control" name="precio" v-model="precio">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.precio"><li class="parsley-required">@{{ errors.precio }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="enlace">Enlace (opcional)</label>
                        <input type="text" class="form-control" name="enlace" v-model="enlace">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.enlace"><li class="parsley-required">@{{ errors.enlace }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_fondo">Imagen de fondo*</label>
                        <template v-if="imagen_fondo">
                            <div><img class=" ml-5 rounded" :src="modelo.imagen_fondo" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_fondo" class="filestyle" id="imagen_fondo" name="imagen_fondo" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_fondo"><li class="parsley-required">@{{ errors.imagen_fondo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_precio">Imagen frontal (opcional)</label>
                        <template v-if="imagen_frente">
                            <div><img class=" ml-5 rounded" :src="modelo.imagen_frente" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_frente" class="filestyle" id="imagen_frente" name="imagen_frente" data-buttonname="btn-primary" data-buttontext="Seleccionar (opcional)...">
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_frente"><li class="parsley-required">@{{ errors.imagen_frente }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeBanner()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeBanner()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
