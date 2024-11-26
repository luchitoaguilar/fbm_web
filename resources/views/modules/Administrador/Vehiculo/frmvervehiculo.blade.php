<!-- begin modal dialog -->

<div class="modal fade" id="frmvervehiculo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Noticia</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h5>Placa Vehiculo</h5>
                        <p class="text-muted">@{{ modelo.placa }}</p>
                        <h5>Vehiculo</h5>
                        <p class="text-muted">@{{ modelo.vehiculo }}</p>
                        <h5>Codigo Vehiculo</h5>
                        <p class="text-muted">@{{ modelo.cod_vehiculo }}</p>
                        <h5>Tara</h5>
                        <p class="text-muted">@{{ modelo.tara }}</p>
                        <h5>Gestion</h5>
                        <p class="text-muted">@{{ modelo.gestion }}</p>
                        <h5>Observaciones</h5>
                        <p class="text-muted">@{{ modelo.observaciones }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="editVehiculo(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteVehiculo(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
