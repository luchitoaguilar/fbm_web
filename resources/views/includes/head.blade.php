<meta charset="utf-8" />
<title>FBM | @yield('title')</title>
<link rel="shortcut icon" href="{{ asset('assets/img/logo/fbm_logo1.png') }}">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
{!! Html::style('assets/css/vendor.min.css') !!}
{{-- Material desing  --- Para cambiar el front end copiar el app de la carpeta Facebook/Material/Defualt... --}}
{!! Html::style('assets/css/app.min.css') !!}

{!! Html::style('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') !!}
{!! Html::style('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') !!}}
{!! Html::style('assets/plugins/simple-calendar/dist/simple-calendar.css') !!}
{!! Html::style('assets/plugins/gritter/css/jquery.gritter.css') !!}
{!! Html::style('assets/plugins/jvectormap-next/jquery-jvectormap.css') !!}
{!! Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') !!}
{!! Html::style('assets/plugins/select2/dist/css/select2.min.css') !!}
{!! Html::style('assets/plugins/nvd3/build/nv.d3.css') !!}

{{--  componente para vue-js  --}}
{{--  {!! Html::style('css/app.css') !!}  --}}


{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- #region datatables files -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
