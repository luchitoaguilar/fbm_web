<!-- begin modal dialog -->

<div class="modal fade" id="frmvervideo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Video</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="{{ url('') }}/@{{ modelo.video }}"
                                id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <template v-if="editar">
                        <a href="#" @click.prevent="storeVideo()" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('messages.botones.actualizar') }}</a>
                    </template>
                    <template v-else>
                        <a href="#" @click.prevent="storeVideo()" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('messages.botones.guardar') }}</a>
                    </template>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i
                            class="fa fa-window-close"></i> {{ __('messages.botones.cerrar') }} </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- end modal dialog -->
