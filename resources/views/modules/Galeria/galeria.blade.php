@extends('layouts.template')

@section('title', 'Fotos')

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
            {{-- <div id="photosphere"> </div> --}}
            <iframe width="100%" height="500px" allowFullScreen="true" allow="accelerometer; magnetometer; gyroscope"
                style="display:block; margin:20px auto; border:0 none; max-width:880px;border-radius:8px; box-shadow: 0 1px 1px rgba(0,0,0,0.11),0 2px 2px rgba(0,0,0,0.11),0 4px 4px rgba(0,0,0,0.11),0 6px 8px rgba(0,0,0,0.11),0 8px 16px rgba(0,0,0,0.11);"
                src="https://panoraven.com/es/embed/Y82YtowNmK"></iframe>
        </div>

        <div id="trending-items" class="section-container"
            style="background-image: url({{asset('images/image.png')}}); background-repeat: no-repeat; background-size: cover;">
            <h2 class="text-center">Galeria de Fotos</h2>
            <div class="lightbox-gallery">
                <div><img src="https://picsum.photos/id/343/300/300" data-image-hd="https://picsum.photos/id/343/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, quae, quam. Ut dolorum quia, unde dicta at harum porro officia obcaecati ipsam deserunt fugit dolore delectus quam, maxime nisi quo."></div>
                <div><img src="https://picsum.photos/id/112/300/300" data-image-hd="https://picsum.photos/id/112/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime accusamus officiis dignissimos doloribus consectetur harum eos sapiente optio aut minima."></div>
                <div><img src="https://picsum.photos/id/155/300/300" data-image-hd="https://picsum.photos/id/155/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates veritatis similique, amet, maiores soluta recusandae cupiditate, sed perspiciatis fugit minima, sunt dolores cum earum deserunt illo ipsum!"></div>
                <div><img src="https://picsum.photos/id/11/300/300" data-image-hd="https://picsum.photos/id/11/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque laudantium dignissimos tenetur eos unde quidem repellat officiis nemo laboriosam necessitatibus deleniti commodi quis aliquid est atque tempora aut, nihil!"></div>
                <div><img src="https://picsum.photos/id/434/300/300" data-image-hd="https://picsum.photos/id/434/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto minus consequatur soluta quaerat itaque, laboriosam quis a facilis, cumque, deleniti quas aperiam voluptate dolore. Enim nostrum sit eaque, porro eligendi illo placeat?"></div>
                <div><img src="https://picsum.photos/id/101/300/300" data-image-hd="https://picsum.photos/id/101/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi suscipit quam, id aliquam totam aperiam quas rem debitis voluptatem pariatur, illo accusamus facilis eius ipsa! Reprehenderit libero, quas iste repudiandae distinctio, quos dignissimos."></div>
                <div><img src="https://picsum.photos/id/343/300/300" data-image-hd="https://picsum.photos/id/343/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, quae, quam. Ut dolorum quia, unde dicta at harum porro officia obcaecati ipsam deserunt fugit dolore delectus quam, maxime nisi quo."></div>
                <div><img src="https://picsum.photos/id/112/300/300" data-image-hd="https://picsum.photos/id/112/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime accusamus officiis dignissimos doloribus consectetur harum eos sapiente optio aut minima."></div>
                <div><img src="https://picsum.photos/id/155/300/300" data-image-hd="https://picsum.photos/id/155/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates veritatis similique, amet, maiores soluta recusandae cupiditate, sed perspiciatis fugit minima, sunt dolores cum earum deserunt illo ipsum!"></div>
                <div><img src="https://picsum.photos/id/11/300/300" data-image-hd="https://picsum.photos/id/11/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque laudantium dignissimos tenetur eos unde quidem repellat officiis nemo laboriosam necessitatibus deleniti commodi quis aliquid est atque tempora aut, nihil!"></div>
                <div><img src="https://picsum.photos/id/434/300/300" data-image-hd="https://picsum.photos/id/434/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto minus consequatur soluta quaerat itaque, laboriosam quis a facilis, cumque, deleniti quas aperiam voluptate dolore. Enim nostrum sit eaque, porro eligendi illo placeat?"></div>
                <div><img src="https://picsum.photos/id/101/300/300" data-image-hd="https://picsum.photos/id/101/600/600" alt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi suscipit quam, id aliquam totam aperiam quas rem debitis voluptatem pariatur, illo accusamus facilis eius ipsa! Reprehenderit libero, quas iste repudiandae distinctio, quos dignissimos."></div>
            </div>
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
            panorama: 'https://panoraven.com/es/embed/Y82YtowNmK',
            //   panorama: '{{ asset('assets/img/360/fbm.jpg') }}',
            container: photosphere,
            loading_img: '{{ asset('assets/img/icon/360.gif') }}',
            navbar: 'autorotate zoom download fullscreen',
            caption: 'Fabrica Boliviana de Munición',
            default_fov: 65,
            mousewheel: false,
            size: {
                height: 400
            }
        });

        //galeria de fotos
        </script>
<script>
        // Create a lightbox
(function() {
  var $lightbox = $("<div class='lightbox'></div>");
  var $img = $("<img>");
  var $caption = $("<p class='caption'></p>");

  // Add image and caption to lightbox

  $lightbox
    .append($img)
    .append($caption);

  // Add lighbox to document

  $('body').append($lightbox);

  $('.lightbox-gallery img').click(function(e) {
    e.preventDefault();

    // Get image link and description
    var src = $(this).attr("data-image-hd");
    var cap = $(this).attr("alt");

    // Add data to lighbox

    $img.attr('src', src);
    $caption.text(cap);

    // Show lightbox

    $lightbox.fadeIn('fast');

    $lightbox.click(function() {
      $lightbox.fadeOut('fast');
    });
  });

}());
    </script>
@endpush


@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/markers-plugin/index.min.css" />
    <link href="https://cdn.rawgit.com/mistic100/Photo-Sphere-Viewer/3.1.0/dist/photo-sphere-viewer.min.css"
        rel="stylesheet">
    <style>
        #photosphere {
            height: 600px;
            width: 100%;
            margin: 0 auto
        }

        /* galeria de fotos */

.containers {
  max-width: 800px;
  margin: 5% auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-sizing: border-box;
  box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
}

.text-center {
  text-align: center;
  margin-bottom: 1em;
}

.lightbox-gallery {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
}

.lightbox-gallery div > img {
  max-width: 100%;
  display: block;
}

.lightbox-gallery div {
  margin: 10px;
  flex-basis: 180px;
}

@media only screen and (max-width: 480px) {
  .lightbox-gallery {
    flex-direction: column;
    align-items: center;
  }

  .lightbox > div {
    margin-bottom: 10px;
  }
}

/*Lighbox CSS*/

.lightbox {
  display: none;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 20;
  padding-top: 30px;
  box-sizing: border-box;
}

.lightbox img {
  display: block;
  margin: auto;
}

.lightbox .caption {
  margin: 15px auto;
  width: 50%;
  text-align: center;
  font-size: 1em;
  line-height: 1.5;
  font-weight: 700;
  color: #eee;
}

    </style>
@endpush
