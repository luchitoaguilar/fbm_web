<div class="container mail-body">
    <div class="card border-primary">
        <div class="card-header text-center" style="background-color:#003F8A;">
            {{-- <img src="{{ (public_path() . '/assets/img/logo/fbm_logo1.png') }}" alt="COFADENA" class="img-thumbnail"> --}}
            <h3 style="color: #FFCC00;">{{ config('app.name') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <!-- BEGIN checkout-body -->
						<div class="checkout-body">
							<!-- BEGIN checkout-message -->
							<div class="checkout-message">
								<h1>Sr(a). Encargado de Ventas de las FBM <small>Se ha solicitado informacion, por favor tome nota y contactese lo antes posible</small></h1>
								<div class="table-responsive">
									<table class="table table-payment-summary">
										<tbody>
											<tr>
												<td class="field">Remitente:</td>
												<td class="value">{{ $nombre }}</td>
											</tr>
											<tr>
												<td class="field">Correo Electronico:</td>
												<td class="value">{{ $email }}</td>
											</tr>
											<tr>
												<td class="field">Telefono:</td>
												<td class="value">{{ $telefono }}</td>
											</tr>
											<tr>
												<td class="field">Asunto:</td>
												<td class="value">{{ $asunto }}</td>
											</tr>
											<tr>
												<td class="field">Mensaje: </td>
												<td class="value">{{ $mensaje }}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<p class="text-silver-darker text-center mb-0">Por favor tome contacto con la persona para brindar la informacion necesaria</p>
							</div>
							<!-- END checkout-message -->
						</div>
						<!-- END checkout-body -->
                </div>
            </div>
        </div>
    </div>
</div>
