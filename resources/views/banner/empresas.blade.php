@extends('layouts.template')

@section('titulo', 'COFADENA | Empresas')

@section('class_navbar', 'rd-navbar rd-navbar-default')

@section('data_navbar', '')

@section('breadcrumb')
    <li>
        <i class="fa fa-shield"></i> Usuarios
    </li>
    <li class="active">
        Usuarios
    </li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style_team.css') }}">
    <!-- Vendor CSS Files -->
    <!-- <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet"> -->
@endsection

@section('contenido')
    <section class="team section-bg">
        <div class="bg-decor d-flex align-items-center" data-parallax-scroll="{&quot;y&quot;: 50,  &quot;smoothness&quot;: 50}">
            <img src="{{ asset('assets/imagenes_background/bg-decor-3.png') }}" alt="" />
        </div>

        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><strong>Gerentes Empresas y UU.PP.</strong></h2>
                {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p> --}}
            </div>

            <div class="row justify-content-center">

                <!-- GERENTE ENAUTO -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_enauto.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Cnl. DAEN. Carlos Rodolfo Uriona Arce</h4>
                            <span><strong>GERENTE ENAUTO</strong></span>
                        </div>
                    </div>
                </div>

                <!-- GERENTE UPAB -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_upab.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Cnl. DAEN. Roberto Carlos Ruiz Hassan</h4>
                            <span><strong>GERENTE UPAB</strong></span>
                        </div>
                    </div>
                </div>

                <!-- GERENTE CAMPO 23 -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_campo23.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>My. DIM. Cristhian Zubieta Ocsa</h4>
                            <span><strong>GERENTE CAMPO 23 DE MARZO</strong></span>
                        </div>
                    </div>
                </div>

                <!-- GERENTE FBM -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_fbm.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Tcnl. DIM. Daniel Arturo Castro Revollo</h4>
                            <span><strong>GERENTE FBM</strong></span>
                        </div>
                    </div>
                </div>

                <!-- GERENTE UERH -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_uerh.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Cnl. DAEN. Juan Jose Garcia Paz</h4>
                            <span><strong>GERENTE UERH</strong></span>
                        </div>
                    </div>
                </div>

                <!-- GERENTE UEPII -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{ asset('assets/autoridades/empresas/gerente_uepii.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Cnl. DAEN. Roberto Vargas Chavez</h4>
                            <span><strong>GERENTE UEPII</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <!-- Vendor JS Files -->
    {{-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script> --}}
@endsection
