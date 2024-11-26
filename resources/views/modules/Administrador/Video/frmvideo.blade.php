<!-- begin modal dialog -->

<div class="modal fade" id="frmvideo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.noticia') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.noticia') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="form-control" name="titulo" v-model="titulo">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.titulo"><li class="parsley-required">@{{ errors.titulo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="video">Video</label>
                        <template v-if="video">
                            <div><img class=" ml-5 rounded" :src="modelo.video" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_video" class="filestyle" id="video" name="video" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.video"><li class="parsley-required">@{{ errors.video }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeVideo()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeVideo()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
