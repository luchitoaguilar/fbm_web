<!-- begin modal dialog -->

<div class="modal fade" id="frmverpersona" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Persona</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <h5>Nombre Completo</h5>
                        <p class="text-muted">@{{ modelo.nombres }} @{{ modelo.paterno }} @{{ modelo.materno }}</p>
                        <h5>C.I.</h5>
                        <p class="text-muted">@{{ modelo.ci }} @{{ modelo.expedido.expedido }} </p>
                        <h5>Telefono</h5>
                        <p class="text-muted">@{{ modelo.telefono }}</p>
                        <h5>Fecha Nacimiento</h5>
                        <p class="text-muted">@{{ modelo.fecha_nacimiento }}</p>
                        <h5>Lugar Nacimiento</h5>
                        <p class="text-muted">@{{ modelo.departamento }}</p>
                    </div>
                    <div class="col-6">
                        <h5>Foto</h5>
                        <div><img class=" ml-5 rounded" src="{{ url('') }}/@{{ modelo.foto }}" width="100%"
                                height="250px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" @click.prevent="editPersona(modelo.id)" class="btn btn-warning"><i
                            class="fa fa-edit"></i> {{ __('messages.botones.editar') }}</a>
                            <template v-if="modelo.activo == true">
                    <a href="#" @click.prevent="deletePersona(modelo.id)" class="btn btn-danger"><i
                            class="fa fa-trash"></i> {{ __('messages.botones.eliminar') }}</a>
                            </template>
                            <template v-else>
                                <a href="#" @click.prevent="activatePersona(modelo.id)" class="btn btn-green"><i
                                    class="fa fa-check"></i> {{ __('messages.botones.activar') }}</a>
                            </template>
                </div>
            </div>
        </div>
    </div>


    <!-- end modal dialog -->
