@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Admindddddd</p>
    <hr>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/sucursales') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/edificio.gif') }}" alt="">
                </a>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        <font dir="auto" style="vertical-align: inherit;">
                            <font dir="auto" style="vertical-align: inherit;"><b>Sucursales</b></font>
                        </font>
                    </span>
                    <span class="info-box-number">
                        <font dir="auto" style="vertical-align: inherit;">
                            <font dir="auto" style="vertical-align: inherit;">{{ $total_sucursales }} sucursales</font>
                        </font>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/categorias') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/carpetas.gif') }}" alt="">
                </a>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        <font dir="auto" style="vertical-align: inherit;">
                            <font dir="auto" style="vertical-align: inherit;"><b>Categorías</b></font>
                        </font>
                    </span>
                    <span class="info-box-number">
                        <font dir="auto" style="vertical-align: inherit;">
                            <font dir="auto" style="vertical-align: inherit;">{{ $total_categorias }} Categorías</font>
                        </font>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
