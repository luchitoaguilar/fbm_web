<!-- begin modal dialog -->

<div class="modal fade" id="frmvercontacto" data-bs-focus='false' tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Contacto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Fecha</h5>
                <p class="text-muted">@{{ modelo.fecha_creado }}</p>
                <h5>Nombre</h5>
                <p class="text-muted">@{{ modelo.nombre }}</p>
                <h5>Email</h5>
                <p class="text-muted">@{{ modelo.email }}</p>
                <h5>Telefono</h5>
                <p class="text-muted">@{{ modelo.telefono }}</p>
                <h5>Asunto</h5>
                <p class="text-muted">@{{ modelo.asunto }}</p>
                <h5>Mensaje</h5>
                <p class="text-muted">@{{ modelo.mensaje }}</p>
            </div>
            <template v-if= "modelo.estado == 1">
                <div class="modal-footer">
                    <a href="#" @click.prevent="replyContacto(modelo.id)" class="btn btn-success"><i
                            class="fa fa-paper-plane"></i> {{ __('messages.botones.responder') }}</a>
                </div>
            </template>
            <template v-else>
                <div class="card text-white border-0 bg-teal text-center mb-2">
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p>YA SE RESPONDIO A LA CONSULTA DE ESTA PERSONA</p>
                        </blockquote>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>


<!-- end modal dialog -->
