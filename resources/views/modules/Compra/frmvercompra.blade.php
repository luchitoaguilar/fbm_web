<!-- begin modal dialog -->

<div class="modal fade" id="frmvercompra" data-bs-focus='false' tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0" id="custom-width-modalLabel">Compra</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Fecha</h5>
                <p class="text-muted">@{{ modelo.fecha_creado }}</p>
                <h5>Grado</h5>
                <p class="text-muted">@{{ modelo.grado }}</p>
                <h5>Nombre</h5>
                <p class="text-muted">@{{ modelo.nombre }}</p>
                <h5>Email</h5>
                <p class="text-muted">@{{ modelo.email }}</p>
                <h5>Celular</h5>
                <p class="text-muted">@{{ modelo.celular }}</p>
                <h5>No. Baucher</h5>
                <p class="text-muted">@{{ modelo.baucher }}</p>
                <h5>Monto Deposito</h5>
                <p class="text-muted">@{{ modelo.monto }}</p>
                <h5>Ciudad</h5>
                <p class="text-muted">@{{ modelo.ciudad }}</p>
            </div>
            <template v-if= "modelo.estado_correo == 1 && modelo.estado_whatsapp == 1">
                <div class="modal-footer">
                    <a href="#" @click.prevent="replyCompra(modelo.id)" class="btn btn-success"><i
                            class="fa fa-envelope"></i> {{ __('messages.botones.responder_mail') }}</a>
                    <a href="#" @click.prevent="replyWhatsappCompra(modelo.id)" class="btn btn-warning"><i
                            class="fas fa-paper-plane"></i> {{ __('messages.botones.responder_whatsapp') }}</a>
                </div>
            </template>
            <template v-if= "modelo.estado_correo == 2 && modelo.estado_whatsapp == 1">
                <div class="modal-footer">
                    <a href="#" class="btn btn-success disabled"><i class="fas fa-paper-plane"></i> YA SE ENVIO
                        CORREO ELECTRONICO</a>
                    <a href="#" @click.prevent="replyWhatsappCompra(modelo.id)" class="btn btn-warning"><i
                            class="fas fa-paper-plane"></i> {{ __('messages.botones.responder_whatsapp') }}</a>
                </div>
            </template>
            <template v-if= "modelo.estado_whatsapp == 2 && modelo.estado_correo == 1">
                <div class="modal-footer">
                <a href="#" @click.prevent="replyCompra(modelo.id)" class="btn btn-success"><i
                        class="fa fa-envelope"></i> {{ __('messages.botones.responder_mail') }}</a>
                <a href="#" class="btn btn-success disabled"><i class="fas fa-paper-plane"></i> YA SE ENVIO
                    MENSAJE DE WHATSAPP</a>
                </div>
            </template>
            <template v-if= "modelo.estado_correo == 2 && modelo.estado_whatsapp == 2">
                <div class="alert alert-muted">
                    YA SE CONTACTO CON EL CLIENTE</div>
            </template>
        </div>
    </div>
</div>


<!-- end modal dialog -->
