<!-- begin modal dialog -->

<div class="modal fade" id="frmfoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.foto') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.foto') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" name="detalle" v-model="detalle">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.detalle"><li class="parsley-required">@{{ errors.detalle }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <template v-if="foto">
                            <div><img class=" ml-5 rounded" :src="modelo.foto" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_foto" class="filestyle" id="foto" name="foto" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.foto"><li class="parsley-required">@{{ errors.foto }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeFoto()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeFoto()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
