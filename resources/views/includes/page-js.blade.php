<!-- ================== BEGIN core-js ================== -->
{!! Html::script('assets/js/vendor.min.js') !!}
{!! Html::script('assets/js/app.min.js') !!}
{!! Html::script('assets/plugins/datatables.net/js/jquery.dataTables.min.js') !!}
{!! Html::script('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') !!}
{!! Html::script('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') !!}
{!! Html::script('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') !!}
{!! Html::script('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') !!}
{!! Html::script('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') !!}
{!! Html::script('assets/plugins/simple-calendar/dist/jquery.simple-calendar.min.js') !!}
{!! Html::script('assets/plugins/gritter/js/jquery.gritter.js') !!}
{!! Html::script('assets/plugins/moment/min/moment.min.js') !!}
{!! Html::script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
{!! Html::script('assets/plugins/select2/dist/js/select2.min.js') !!}

{!! Html::script('assets/plugins/d3/d3.min.js') !!}
	{!! Html::script('assets/plugins/nvd3/build/nv.d3.js') !!}
	{!! Html::script('assets/plugins/jvectormap-next/jquery-jvectormap.min.js') !!}
	{!! Html::script('assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js') !!}


{{--Para descargar los PDF--}}
{{--  {!! Html::script('/assets/js/download.js') !!}  --}}
{{--{!! Html::style('assets/plugins/sweetalert2/dist/sweetalert2.min.js') !!}--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

{{--  componente para vue-js  --}}
{!! Html::style('js/app.js') !!}
<!-- ================== END core-js ================== -->

<!-- ================== BEGIN MY SCRIPTS JS ================== -->

<script type="text/javascript">

    {{--  para cambiar el idioma a los datatables y otros  --}}
    var ruta_tabla_traduccion = '{{ route('api.getTraduccionTabla') }}';

    @stack('variables')

</script>

<!-- ================== END MY SCRIPTS JS ================== -->

@stack('scripts')
