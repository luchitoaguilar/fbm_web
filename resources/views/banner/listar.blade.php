@extends('layouts.default')

@section('title', 'Banner')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title pull-left">Listado Banner</h4>
                            <a href="{{ route('crear_banner') }}" class="btn btn-secondary pull-right btn-round"><i
                                    class="material-icons">add</i> Nuevo</a>
                        </div>
                        <div class="card-body">

                            @include('includes.form-error')
                            @include('includes.mensaje')
                            <!-- Listado de usuarios -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered" id="banner_table"
                                    style="border:1px solid #000;border-collapse:collae;font-size:120%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="text-align:center">Imagen</th>
                                            <th>Abreviacion</th>
                                            <th>Nombre</th>
                                            <th>Lema</th>
                                            <th style="text-align:center">Estado</th>
                                            <th style="justify-content: center">Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('pages/banner/index.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/funciones.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('#banner_table').DataTable({
                paging: true,
                responsive: true,
                autoWidth: true,
                searching: true,
                scrollX: false,
                processing: true,
                ajax: "{{ route('listar_banner') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen'
                    },
                    {
                        data: 'abreviacion',
                        name: 'abreviacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'lema',
                        name: 'lema'
                    },
                    {
                        data: 'estado',
                        name: 'estado'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });

        });

    </script>

@endpush
