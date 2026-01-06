@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/sucursales') }}">Sucursales</a></li>
            <li class="breadcrumb-item active" aria-current="page">Datos de la sucursal</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card  card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos registrados</b></h3>
                </div>

                <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la sucursal </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" value="{{ $sucursal->nombre}}" class="form-control" id="nombre" name="nombre" 
                                        placeholder="Ingrese el nombre de la sucursal" readonly>
                                        <div data-v-37e428cc=""></div>
                                    </div>
                                    @error('nombre')
                                        <small style="color: red"> {{ $message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map"></i></span>
                                        </div>
                                        <input type="text" value="{{ $sucursal->direccion}}" class="form-control" id="dirrecion" name="direccion" 
                                        placeholder="Ingrese la dirreción de la sucursal" readonly>
                                        <div data-v-37e428cc=""></div>
                                    </div>
                                    @error('direccion')
                                        <small style="color: red"> {{ $message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="telefono">Teléfono </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map"></i></span>
                                        </div>
                                        <input type="text" value="{{ $sucursal->direccion}}" class="form-control" id="telefono" name="telefono" 
                                        placeholder="Ingrese el mumero de teléfono" readonly>
                                        <div data-v-37e428cc=""></div>
                                    </div>
                                    @error('telefono')
                                        <small style="color: red"> {{ $message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="activo">Estado </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select class="form-control" name="activo" id="activo" disabled>
                                            <option value="" disabled selected>Seleccione una opción</option>
                                            <option value="1" {{ $sucursal->activo == '1' ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $sucursal->activo == '0' ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                        <div data-v-37e428cc=""></div>
                                    </div>
                                    @error('activo')
                                        <small style="color: red"> {{ $message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/sucursales') }}" class="btn btn-secondary">Volver</a>
                                    
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
