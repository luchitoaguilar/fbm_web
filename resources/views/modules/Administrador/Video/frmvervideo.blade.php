<!-- begin modal dialog -->

<div class="modal fade" id="frmvervideo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Video</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Titulo</h5>
                <p class="text-muted">@{{ modelo.titulo }}</p>
                <h5>Video</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.video}}"  width="150px"></div>
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="editVideo(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteVideo(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
