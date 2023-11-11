<!-- subcliente_table.blade.php -->
<thead class="tprimaryhead">
    <tr class="col-table-primary">
        <th scope="col">Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Direccion</th>
        <th scope="col">Ciudad</th>
        <th>Accion</th>
    </tr>
</thead>
<tbody>
    @forelse($modelosub as $subcliente)
    <tr class="fila-ejemplo">
        <td>{{$subcliente->nombre}}</td>
        <td>{{$subcliente->telefono1}}</td>
    </tr>
    @empty
    <p>No hay subclientes registrados</p>
    @endforelse
</tbody>
