@extends('Comercio.Panel')

@section('title', 'VentasGeneradas')

@section('content')
<style>
    table {
        text-align: left;
        line-height: 40px;
        border-collapse: separate;
        border-spacing: 0;
        border: 2px solid #ed1c40;
        width: 100%; /* Cambiado a 100% para que la tabla sea sensible al ancho del contenedor */
        margin: 50px auto;
        border-radius: .25rem;
    }

    thead tr:first-child {
        background: #ed1c40;
        color: #fff;
        border: none;
    }

    th:first-child,
    td:first-child {
        padding: 10px 15px; /* Ajustado el padding para alinear mejor el contenido */
    }

    th {
        font-weight: 500;
    }

    thead tr:last-child th {
        border-bottom: 3px solid #ddd;
    }

    tbody tr:hover {
        background-color: #f2f2f2;
        cursor: default;
    }

    tbody tr:last-child td {
        border: none;
    }

    tbody td {
        border-bottom: 1px solid #ddd;
        padding: 10px 15px; /* Ajustado el padding para alinear mejor el contenido */
    }

    td:last-child {
        text-align: right;
    }

    .button {
        color: #aaa;
        cursor: pointer;
        vertical-align: middle;
        margin-top: -4px;
    }

    .edit:hover {
        color: #0a79df;
    }

    .delete:hover {
        color: #dc2a2a;
    }
</style>
<div>
    <h3>TABLAS DE VENTAS REALIZADAS SOFTRES PUYO </h3>
</div>
<div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CLIENTE</th>
                <th>TIPO DOC</th>
                <th>SUBTOTAL</th>
                <th>IVA</th>
                <th>TOTAL</th>
                <th>ESTADO</th>
                <th>ACCIONES</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            <tr>
                @forelse($ventasgeneradas as $vent)
                <td>{{$vent->id}}</td>
                <td>{{$vent->cliente}}</td>
                <td>{{$vent->tipodoc}}</td>
                <td>{{$vent->subtotal}}</td>
                <td>{{$vent->iva}}</td>
                <td>{{$vent->total}}</td>
                <td>{{$vent->estado}}</td>
                <td>
                    <i class="material-icons button edit">edit</i>
                    <i class="material-icons button delete">delete</i>
                </td>
                @empty
                <p>No hay ventas generadas.</p>
                @endforelse
            </tr>
           
        </tbody>
    </table>
</div>
@endsection
