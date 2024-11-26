<!-- begin modal dialog -->

<div class="modal fade" id="frmvernoticia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Noticia</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Nombre</h5>
                <p class="text-muted">@{{ modelo.titulo }}</p>
                <h5>Descripcion</h5>
                <p class="text-muted">@{{ modelo.descripcion }}</p>
                <h5>Enlace</h5>
                <p class="text-muted">@{{ modelo.enlace }}</p>
                <h5>Imagen 1</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_0}}"  width="150px"></div>
                <h5>Imagen 2</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_1}}"  width="150px"></div>
                <h5>Imagen 3</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_2}}"  width="150px"></div>
                <h5>Imagen 4</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_3}}"  width="150px"></div>
                <h5>Imagen 5</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen_4}}"  width="150px"></div>
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="editNoticia(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteNoticia(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
