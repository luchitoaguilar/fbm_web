@extends('layouts.template')

@section('title', 'Requisitos')

@section('contenido')
<!-- BEGIN #page-container -->
<div id="page-container" class="fade show" style="
background: rgba(76, 175, 80, 0.1);
background: url(/images/fondo18.jpg);
background-repeat: no-repeat; background-size: cover;" >

      <!-- BEGIN #page-header -->
      <div id="page-header" class="section-container page-header-container bg-dark"  style="background: linear-gradient(#044486, #6A4E3B); opacity:0.9">
          <!-- BEGIN page-header-cover -->
          <div class="page-header-cover">
              {{-- <img src="../assets/img/cover/azucar_cover.jpg" alt="" /> --}}
          </div>
          <!-- END page-header-cover -->
          <!-- BEGIN container -->
          <div class="container">
              <h1 class="page-header"><b>Formularios</b></h1>
          </div>
          <!-- END container -->
      </div>
      <!-- BEGIN #page-header -->
    <!-- BEGIN #promotions -->
    <div id="promotions" class="section-container bg-component">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN section-title -->
            <h4 class="section-title clearfix">
                <div class="alert alert-success alert-dismissible fade show col-lg-12">
                    <strong>Venta exclusiva para personal de las FF.AA. y Policia Boliviana</strong>
                </div>
            </h4>
            <!-- END section-title -->
            <!-- BEGIN row -->
            <div class="row gx-2">
                <!-- BEGIN col-6 -->
                <div class="col-lg-4">
                    <!-- BEGIN promotion -->
                    <div class="promotion promotion-lg bg-dark">
                        <div class="promotion-image text-end" style="position: absolute;top: 80px;right: 10;">
                            <embed src="{{ asset('assets/archivos/form4.pdf') }}" width="200" height="200"
                                type="application/pdf">
                        </div>
                        <div class="promotion-caption promotion-caption-inverse">
                            <h4 class="promotion-title">Formulario # 4</h4>
                            <a href="{{ asset('assets/archivos/form4.pdf') }}"><img
                                    src="{{ asset('assets/img/icon/descargar.png') }}" alt="" height="100px" /></a>
                        </div>
                    </div>
                    <!-- END promotion -->
                </div>
                <!-- END col-6 -->
                <!-- BEGIN col-6 -->
                <div class="col-lg-4">
                    <!-- BEGIN promotion -->
                    <div class="promotion promotion-lg bg-dark">
                        <div class="promotion-image text-end" style="position: absolute;top: 80px;right: 10;">
                            <embed src="{{ asset('assets/archivos/form5.pdf') }}" width="200" height="200"
                                type="application/pdf">
                        </div>
                        <div class="promotion-caption promotion-caption-inverse">
                            <h4 class="promotion-title">Formulario # 5</h4>
                            <a href="{{ asset('assets/archivos/form5.pdf') }}"><img
                                    src="{{ asset('assets/img/icon/descargar.png') }}" alt="" height="100px" /></a>
                        </div>
                    </div>
                    <!-- END promotion -->
                </div>
                <!-- END col-6 -->
                <div class="col-lg-4">
                    <!-- BEGIN promotion -->
                    <div class="promotion promotion-lg bg-dark">
                        <div class="promotion-image text-end" style="position: absolute;top: 80px;right: 10;">
                            <embed src="{{ asset('assets/archivos/form7.pdf') }}" width="200" height="200"
                                type="application/pdf">
                        </div>
                        <div class="promotion-caption promotion-caption-inverse">
                            <h4 class="promotion-title">Formulario # 7</h4>
                            <a href="{{ asset('assets/archivos/form7.pdf') }}"><img
                                    src="{{ asset('assets/img/icon/descargar.png') }}" alt="" height="100px" /></a>
                        </div>
                    </div>
                    <!-- END promotion -->
                </div>
                <!-- END col-6 -->
            </div>
            <!-- END row -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #promotions -->



@endsection

@push('scripts')
    {!! Html::script('assets/js/modules/Contacto/contacto.js') !!}
@endpush
