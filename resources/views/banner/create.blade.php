@extends('layouts.main', ['activePage' => 'banner/create', 'titlePage' => __('Crear Banner')])

@section('titulo', 'COFADENA :: Crear Banner')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Crear Banner</h4>
                            <p class="card-category">Complete los datos por favor</p>
                        </div>
                        <div class="card-body">
                            @include('includes.form-error')
                            @include('includes.mensaje')
                            <form action="{{ route('guardar_banner') }}" method="POST" id="form-general"
                                class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Abreviacion</label>
                                            <input type="text" id="abreviacion" name="abreviacion" style="text-transform:uppercase;" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre</label>
                                            <input type="text" id="nombre" name="nombre" style="text-transform:uppercase;" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Lema</label>
                                            <input type="text" id="lema" name="lema" style="text-transform:uppercase;" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group form-file-upload form-file-simple">
                                            <input type="text" class="form-control inputFileVisible" placeholder="Seleccione una Imagen...">
                                            <input type="file" class="inputFileHidden" id="imagen" name="imagen">
                                          </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Guardar</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

