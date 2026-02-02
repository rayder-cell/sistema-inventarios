@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/productos') }}">Compras</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compra nro {{ $compra->id }}</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 1 | Compra creada</b></h3>
                </div>

                <div class="card-body" style="display: block;">


                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="proveedor_id">Proveedores </label>
                                <p>{{ $compra->proveedor->nombre }}</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fecha">Fecha de la compra </label>
                                <p>{{ $compra->fecha_compra }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observaciones">Observaciones </label>
                                <p>{{ $compra->observaciones }}</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="estado">Estado de la compra </label>
                                <p>{{ $compra->estado }}</p>
                            </div>
                        </div>

                        

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 2 | Agregar productos</b></h3>
                </div>

                <div class="card-body" style="display: block;">

                    <livewire:admin.compras.items-compra :compra="$compra"/>

                </div>
            </div>
        </div>
    </div>

    
@stop

@section('css')
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
    </style>
    @livewireStyles
    
@stop

@section('js')
    @livewireStyles
    
@stop
