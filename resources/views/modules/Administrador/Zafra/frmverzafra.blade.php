<!-- begin modal dialog -->

<div class="modal fade" id="frmverzafra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Noticia</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <h5>Numero de Recibo</h5>
                        <p class="text-muted">@{{ modelo.num_recibo }}</p>
                        <h5>Placa Vehiculo</h5>
                        <p class="text-muted">@{{ modelo.placa }}</p>
                        <h5>Fecha Ingreso</h5>
                        <p class="text-muted">@{{ modelo.fecha_ingreso }}</p>
                        <h5>Peso Neto</h5>
                        <p class="text-muted">@{{ modelo.peso_neto }}</p>
                        <h5>Observaciones</h5>
                        <p class="text-muted">@{{ modelo.observaciones }}</p>
                        <h5>Personal Zafra</h5>
                        <p class="text-muted">@{{ modelo.personal_zafra }}</p>
                    </div>
                    <div class="col-8">
                        <h5>Archivo</h5>
                        <div><img class=" ml-5 rounded" src="{{ url('') }}/@{{ modelo.archivo }}" width="100%" height="450px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" @click.prevent="personalZafra(modelo.id)" class="btn btn-info"><i
                    class="fa fa-users"></i> {{ __('messages.botones.personal') }}</a>
                <a href="#" @click.prevent="editZafra(modelo.id)" class="btn btn-warning"><i
                        class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                <a href="#" @click.prevent="deleteZafra(modelo.id)" class="btn btn-danger"><i
                        class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->
