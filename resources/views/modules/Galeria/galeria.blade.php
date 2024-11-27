@extends('layouts.template')

@section('title', 'Requisitos')

@section('contenido')
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade show"
        style="
background: rgba(76, 175, 80, 0.1);
background: url(/images/fondo18.jpg);
background-repeat: no-repeat; background-size: cover;">

        <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-dark"
            style="background: linear-gradient(#044486, #6A4E3B); opacity:0.9">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                {{-- <img src="../assets/img/cover/azucar_cover.jpg" alt="" /> --}}
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header"><b>Fotos</b></h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->
        <!-- BEGIN #promotions -->
        <div id="promotions" class="section-container bg-component">
            <!-- BEGIN container -->
            <div class="container">
                <div id="photosphere"> </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #promotions -->



    @endsection

    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/threejs/r70/three.min.js"></script>
    <script src="https://cdn.rawgit.com/mistic100/Photo-Sphere-Viewer/3.1.0/dist/photo-sphere-viewer.min.js"></script>
    <script>

        // 360 viewer
        var PSV = new PhotoSphereViewer({
          panorama: '{{ asset("assets/img/360/fbm.jpg")}}',
          container: photosphere,
          loading_img: '{{ asset("assets/img/icon/360.gif")}}',
          navbar: 'autorotate zoom download fullscreen',
          caption: 'Fabrica Boliviana de Munición',
          default_fov: 65,
          mousewheel: false,
          size: {
            height: 400
          }
        });
      
      </script>
    @endpush


    @push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/markers-plugin/index.min.css" />
    <link href="https://cdn.rawgit.com/mistic100/Photo-Sphere-Viewer/3.1.0/dist/photo-sphere-viewer.min.css" rel="stylesheet">
    <style>
        #photosphere {
            height: 600px;
            width: 100%;
            margin: 0 auto
        }
    </style>
    @endpush

