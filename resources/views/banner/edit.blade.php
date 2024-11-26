@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Editar Banner')])

@section('titulo', 'COFADENA :: Editar Banner')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Editar Banner</h4>
                    </div>
                    <div class="card-body">
                        @include('includes.form-error')
                        @include('includes.mensaje')
                        <form action="{{ route('actualizar_banner', ['id' => $banner->id]) }}" id="form-general"
                            method="POST" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @csrf @method("put")
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Abreviacion</label>
                                        <input value="{{ old('abreviacion', $banner->abreviacion ?? '') }}" type="text"
                                            id="abreviacion" name="abreviacion" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre</label>
                                        <input value="{{ old('nombre', $banner->nombre ?? '') }}" type="text"
                                            id="nombre" name="nombre" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Lema</label>
                                        <input value="{{ old('lema', $banner->lema ?? '') }}" type="text"
                                            id="lema" name="lema" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <img class="img" src="/{{ $banner->imagen }}" width="50px" height="50px" />
                                    <p>Imagen actual</p>
                                    <div class="form-group form-file-upload form-file-simple">
                                        <input type="text" class="form-control inputFileVisible"
                                            placeholder="Seleccione una Imagen...">
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

