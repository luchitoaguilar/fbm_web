<!-- begin modal dialog -->

<div class="modal fade" id="frmverproducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Nombre</h5>
                <p class="text-muted">@{{ modelo.nombre }}</p>
                <h5>Enlace</h5>
                <p class="text-muted">@{{ modelo.enlace }}</p>
                <h5>Precio</h5>
                <p class="text-muted">@{{ modelo.precio }}</p>
                <h5>Descripción</h5>
                <p class="text-muted">@{{ modelo.descripcion }}</p>
                <h5>Presentacion</h5>
                <p class="text-muted">@{{ modelo.presentacion }}</p>
                <h5>Imagen del Producto</h5>
                <div><img class=" ml-5 rounded" src="{{url('')}}/@{{modelo.imagen}}"  width="150px"></div>
                {{-- <h5>SOA</h5>
                <p class="text-muted">@{{ reparticion.idSoa }}</p> --}}
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="editProducto(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteProducto(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
