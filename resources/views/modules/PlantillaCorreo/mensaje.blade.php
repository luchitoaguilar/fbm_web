<div class="container mail-body">
    <div class="card border-primary">
        <div class="card-header text-center" style="background-color:#003F8A;">
            <img src="{{asset('assets/img/logo/fbm_logo1.png')}}" alt="FBM" class="img-thumbnail">
            <h3 style="color: #FFCC00;">{{ config('app.name') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <span class="card-text">
                        <p>Sr(a). <b><i>{{ $usuario }}</i></b>,</p>
                        <p>A continuacion encontraras el TOKEN generado para validar su envio de correspondencia
                            en el SiCoEm - COFADENA</p>
                        <hr>
                        <h3><b>TOKEN: </b>{{ $Token }}</h3>
                        <p>Tome en cuenta que con este codigo esta aprobando este documento en base a Reglamento XXXXX</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
