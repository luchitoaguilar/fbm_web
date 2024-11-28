<!-- begin modal dialog -->

<div class="modal fade" id="frmverfoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Video</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Detalle</h5>
                <p class="text-muted">@{{ modelo.detalle }}</p>
                <h5>Foto</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.foto}}"  width="150px"></div>
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="editFoto(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteFoto(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
