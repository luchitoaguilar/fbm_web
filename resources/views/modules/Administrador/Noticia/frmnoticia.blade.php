<!-- begin modal dialog -->

<div class="modal fade" id="frmnoticia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.noticia') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.noticia') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="titulo">titulo</label>
                        <input type="text" class="form-control" name="titulo" v-model="titulo">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.titulo"><li class="parsley-required">@{{ errors.titulo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea type="text" class="form-control" name="descripcion" v-model="descripcion" rows="6"></textarea>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.descripcion"><li class="parsley-required">@{{ errors.descripcion }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="enlace">Enlace (opcional)</label>
                        <input type="text" class="form-control" name="enlace" v-model="enlace">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.enlace"><li class="parsley-required">@{{ errors.enlace }}</li></ul>
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
                    <div class="form-group">
                        <label for="imagen_0">Imagen 1 *</label>
                        <template v-if="imagen_0">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_0}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_0" class="filestyle" id="imagen_0" name="imagen_0" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_0"><li class="parsley-required">@{{ errors.imagen_0 }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_1">Imagen 2 (opcional)</label>
                        <template v-if="imagen_1">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_1}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_1" class="filestyle" id="imagen_1" name="imagen_1" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_1"><li class="parsley-required">@{{ errors.imagen_1 }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_2">Imagen 3 (opcional)</label>
                        <template v-if="imagen_2">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_2}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_2" class="filestyle" id="imagen_2" name="imagen_2" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_2"><li class="parsley-required">@{{ errors.imagen_2 }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_3">Imagen 4 (opcional)</label>
                        <template v-if="imagen_3">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_3}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_3" class="filestyle" id="imagen_3" name="imagen_3" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_3"><li class="parsley-required">@{{ errors.imagen_3 }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="imagen_4">Imagen 5 (opcional)</label>
                        <template v-if="imagen_4">
                            <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_4}}" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_imagen_4" class="filestyle" id="imagen_4" name="imagen_4" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.imagen_4"><li class="parsley-required">@{{ errors.imagen_4 }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeNoticia()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeNoticia()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
