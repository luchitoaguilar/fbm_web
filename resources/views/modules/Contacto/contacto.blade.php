@extends('layouts.template')

@section('title', 'Contacto')

@section('contenido')
    <div id="contacto-app">
        <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-dark">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                <img src="../assets/img/cover/cover-15.jpg" alt="" />
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header"><b>Contactanos</b></h1>
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
                        <h4 class="mt-0">Formulario de Contacto</h4>
                        <p class="mb-30px fs-13px">
                            El siguiente formulario de contacto nos permitira poder resolver tus dudas de una manera
                            rapida y eficiente.<br>
                            Por favor llena los datos y un agente de ventas se comunicara contigo a la brevedad
                        </p>
                        <form role="form">
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Nombre <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nombre" id="nombre" v-model="nombre" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.nombre">
                                        <li class="parsley-required text-danger">@{{ errors.nombre }}</li>
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
                                <label class="col-form-label col-md-3 text-lg-end">Telefono <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" name="telefono" id="telefono" v-model="telefono" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.telefono">
                                        <li class="parsley-required text-danger">@{{ errors.telefono }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Asunto <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="asunto" id="asunto" v-model="asunto" required />
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.asunto">
                                        <li class="parsley-required text-danger">@{{ errors.asunto }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3 text-lg-end">Mensaje <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="10" name="mensaje" id="mensaje" v-model="mensaje" required></textarea>
                                    <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.mensaje">
                                        <li class="parsley-required text-danger">@{{ errors.mensaje }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-7">
                                    <button type="submit" @click.prevent="storeContacto()"
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
                            <a href="mailto:jefe_plan_upab@cofadena.gob.bo"
                                class="text-dark">jefe_plan_upab@cofadena.gob.bo</a><br />
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
        @include('modules.Administrador.Producto.frmverproducto')
        @include('modules.Administrador.Producto.frmproducto')
        <!-- end includes -->

    </div>


@endsection

@push('variables')

    var auth = {!! Auth::user() !!};
    var listar_producto = '{{ route('listar_producto') }}';
    var guardar_contacto = '{{ route('guardar_contacto') }}';
    var eliminar_producto = '{{ route('eliminar_producto', '') }}';

    {{--  var getContacto = '{!! route('getContacto') !!}';  --}}
@endpush

@push('scripts')
    {!! Html::script('assets/js/modules/Contacto/contacto.js') !!}
@endpush
