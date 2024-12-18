@extends('layouts.template')

@section('title', 'Compra')

@section('contenido')
    <div id="compra-app">
        <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-dark">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                <img src="../assets/img/cover/cover-15.jpg" alt="" />
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header"><b>Registro de Compra Anticipada</b></h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->

        <!-- BEGIN #product -->
        <div id="product" class="section-container pt-20px">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb mb-10px fs-12px">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Contactanos</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN row -->
                <div class="row row-space-30">
                    <!-- BEGIN col-8 -->
                    <div class="col-md-8">
                        <h4 class="mt-0">Formulario de Registro de Compra Anticipada</h4>
                        <p class="mb-30px fs-13px">
                            El siguiente formulario es para que ud registre su compra anticipada con la finalidad de prever
                            su munición.<br>

                        </p>
                        <form role="form">
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Nombre Completo<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        v-model="nombre" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.nombre">
                                        <li class="parsley-required text-danger">@{{ errors.nombre }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Grado <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="grado" id="grado" v-model="grado"
                                        required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.grado">
                                        <li class="parsley-required text-danger">@{{ errors.grado }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Celular(WhatsApp) <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" name="celular" id="celular"
                                        v-model="celular" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.celular">
                                        <li class="parsley-required text-danger">@{{ errors.celular }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">No. de Baucher <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="baucher" id="baucher"
                                        v-model="baucher" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.baucher">
                                        <li class="parsley-required text-danger">@{{ errors.baucher }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Email <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" id="email" v-model="email" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.email">
                                        <li class="parsley-required text-danger">@{{ errors.email }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="form-label col-form-label col-md-3 text-lg-end">Ciudad de Residencia</label>
                                <div class="col-md-7">
                                    <select class="form-select" name="id_ciudad" id="id_ciudad" v-model="id_ciudad">
                                        @foreach ($ciudad as $ciudad)
                                        <option value="{{ $ciudad->id }}"
                                            @if ($ciudad->departamento == 'COCHABAMBA') selected="selected" @endif>
                                            {{ $ciudad->departamento }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-7">
                                    <button type="submit" @click.prevent="storeCompra()"
                                        class="btn btn-dark btn-theme">ENVIAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END col-8 -->
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4">
                        <h4 class="mt-0">Nuestros Contactos</h4>
                        <div class="ratio ratio-16x9 mb-15px">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4037.2595727563976!2d-66.26479064962984!3d-17.416238675997327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e30c97747b3bf3%3A0x6c43179e241ffd77!2sFABRICA%20BOLIVIANA%20DE%20MUNICION!5e1!3m2!1ses!2sbo!4v1731256041537!5m2!1ses!2sbo"
                                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div><b>Fabrica Boliviana de Munición</b></div>
                        <p class="mb-15px">
                            Av. Bilbao Rioja, (Cotapachi-Quillacollo-Cochabamba)</br>
                            Telefono: (+591) 71497268</br>
                            Fax: (+591) 6961168</br>
                        </p>
                        <div><b>Email</b></div>
                        <p class="mb-15px">
                            <a href="mailto:fbm@cofadena.gob.bo" class="text-dark">fbm@cofadena.gob.bo</a><br />
                            <a href="mailto:jefe_com_fbm@cofadena.gob.bo"
                                class="text-dark">jefe_com_fbm@cofadena.gob.bo</a><br />
                        </p>
                        {{-- <div class="mb-5px"><b>Redes Sociales</b></div>
                        <p class="mb-15px">
                            <a href="https://www.facebook.com/Unidad-Productiva-Agr%C3%ADcola-Bermejo-Upab-Cofadena-692021277659720/"
                                class="btn btn-icon btn-white btn-circle"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="btn btn-icon btn-white btn-circle"><i class="fab fa-twitter"></i></a>
                        </p> --}}
                    </div>
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END row -->
        </div>

        <!-- begin includes -->
        {{-- @include('modules.Administrador.Producto.frmverproducto')
        @include('modules.Administrador.Producto.frmproducto') --}}
        <!-- end includes -->

    </div>


@endsection

@push('variables')
    {{-- var auth = {!! Auth::user() !!}; --}}
    var guardar_compra= '{{ route('guardar_compra') }}';

    {{-- var getCiudadVenta = '{!! route('lista_ciudadVenta') !!}'; --}}
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Compra/compra.js') !!}
@endpush
