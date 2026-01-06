@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/sucursales') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Productos</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Productos registradas</b></h3>

                    <div class="card-tools">
                        <a class="btn btn-primary btn-sm" href="{{ url('/admin/productos/create') }}">Crear nuevo</a>
                    </div>
                </div>

                <div class="card-body table-responsive" style="display: block;">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Categoría</th>
                                <th>codigo</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Precio compra</th>
                                <th>Precio venta</th>
                                <th>Stock mínimo</th>
                                <th>Stock máximo</th>
                                <th>Unidad de medida</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $producto->categoria_id }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{!! $producto->descripcion !!}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre}}" class="img-thumbnail" style="width: 50%; height: auto;">
                                
                                    </td>
                                    <td>{{$producto->precio_compra}}</td>
                                    <td>{{$producto->precio_venta}}</td>
                                    <td>{{$producto->stock_minimo}}</td>
                                    <td>{{$producto->stock_maximo}}</td>
                                    <td>{{$producto->unidad_medida}}</td>
                                    <td style="text-aling: center">
                                        @if ($producto->estado == '1')
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/productos/' . $producto->id) }}" class="btn btn-info"><i
                                                    class="fas fa-eye"></i>Ver</a>
                                            <a href="{{ url('/admin/productos/' . $producto->id . '/edit') }}"
                                                class="btn btn-success"><i class="fas fa-pencil-alt"></i>Editar</a>
                                            <form action="{{ url('/admin/productos/' . $producto->id) }}" id="miformulario{{$producto->id}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="preguntar{{ $producto->id}}(event)">
                                                    <i class="fas fa-trash-alt"></i>Eliminar</button>
                                            </form>
                                            <script>
                                                function preguntar{{ $producto->id}}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                    title: "¿desea eliminar este registro?",
                                                    text: "",
                                                    icon: "question",
                                                    showCancelButton: true,
                                                    confirmButtonColor: "#3085d6",
                                                    cancelButtonColor: "#d33",
                                                    confirmButtonText: "Si, eliminar",
                                                    denyButtonText: "No, canselar"
                                                    }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        Swal.fire({
                                                        title: "Eliminado",
                                                        text: "Se elimino el registro correctamente",
                                                        icon: "success"
                                                        });
                                                        document.getElementById('miformulario{{ $producto->id}}').submit();
                                                    }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Fondo transparente y sin borde en el contenedor */
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            /* Centrar los botones */
            gap: 10px;
            /* Espaciado entre botones */
            margin-bottom: 15px;
            /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 5px 15px;
            /* Espaciado interno */
            font-size: 14px;
            /* TamaÃ±o de fuente */
        }

        /* Colores por tipo de botÃ³n */
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #212529;
            border: none;
        }
    </style>
@stop

@section('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 10,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                    "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                    "lengthMenu": "Mostrar _MENU_ Productos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-default'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> EXCEL',
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        text: '<i class="fas fa-print"></i> IMPRIMIR',
                        extend: 'print',
                        className: 'btn btn-warning'
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
