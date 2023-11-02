@extends('Comercio.Panel')
@section('title','Ventas')
@section('content')
<style>
 /*Estilo de la tabla*/   
    .table-primary{
      border-collapse: collapse;
      margin: 20px 5px;
      min-width: 400px;
    }
    .table-primary thead th {
        background-color:#17a2b8;
        text-align: left;
    }
    .table-primary th,
    .table-primary td{
        padding: 25px 15px;
    }
/* estilo del formulario*/
.cbp-mc-form {
position: relative;
}

/* Clearfix hack by Nicolas Gallagher: 
http://nicolasgallagher.com/micro-clearfix-hack/ */
.cbp-mc-form:before,
.cbp-mc-form:after {
content: " "; display: table;
}

.cbp-mc-form:after {
clear: both;
}

.cbp-mc-column {
width: 33%;
padding: 10px 30px;
float: left;
}

.cbp-mc-form label {
display: block;
padding: 10px 5px 5px 2px;
font-size: 1.1em;
text-transform: uppercase;
letter-spacing: 1px;
cursor: pointer;
}

.cbp-mc-form input,
.cbp-mc-form textarea,
.cbp-mc-form select {
font-family: 'Lato', Calibri, Arial, sans-serif;
line-height: 1.5;
font-size: 1.4em;
padding: 5px 10px;
color: #291e1e;
display: block;
width: 100%;
background: transparent;
}


#campoTarjetaCredito{
    width: 100px;
}

.cbp-mc-form input,
.cbp-mc-form textarea {
border: 3px solid #fff;
}

.cbp-mc-form textarea {
min-height: 200px;
}

.cbp-mc-form input:focus,
.cbp-mc-form textarea:focus,
.cbp-mc-form label:active + input,
.cbp-mc-form label:active + textarea {
outline: none;
border: 3px solid #10689a;
}

.cbp-mc-form select:focus {
outline: none;
}

::-webkit-input-placeholder { /* WebKit browsers */
color: #10689a;
font-style: italic;
}

:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
color: #10689a;
font-style: italic;
}

::-moz-placeholder { /* Mozilla Firefox 19+ */
color: #10689a;
font-style: italic;
}

:-ms-input-placeholder { /* Internet Explorer 10+ */
color: #10689a;
font-style: italic;
}

.cbp-mc-submit-wrap {
text-align: center;
padding-top: 40px;
clear: both;
}

.cbp-mc-form input.cbp-mc-submit {
background: #10689a;
border: none;
color: #973333;
width: auto;
cursor: pointer;
text-transform: uppercase;
display: inline-block;
padding: 15px 30px;
font-size: 1.1em;
border-radius: 2px;
letter-spacing: 1px;
}

.cbp-mc-form input.cbp-mc-submit:hover {
background: #1478b1;
}

@media screen and (max-width: 70em) {
.cbp-mc-column {
width: 50%;
}
.cbp-mc-column:nth-child(3) {
width: 100%;
}
}

@media screen and (max-width: 48em) {
.cbp-mc-column {
width: 100%;
padding: 10px;
}
}

</style>
<!--Esto es el formulario del cliente-->
<form  class="cbp-mc-form" method="POST" action={{route('store.ventas')}}>
    @csrf
    <div class="cbp-mc-column">
    <label for="cedula">Cedula/RUC </label>
    <input type="text" id="cedula" name="cedula" class="autocompletar" placeholder="CI o RUC" >
    <label for="nombre">Cliente</label>
    <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" >
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="jon@doe.com">
    <label for="direccion">Dirreccion</label>
    <input type="text" id="direccion" name="direccion" placeholder="Direcion de su domicilio">  
  <label for="desc">Descuento</label>
  <input type="text" id="desc" name="desc" placeholder="0">  
  <label for="ptos">Ptos Acumulados</label>
  <input type="text" id="ptos" name="ptos" placeholder="0">  
  <label for="deuda">Deuda</label>
  <input type="text" id="deuda" name="deuda" placeholder="0">  
    </div>
    <!--Este sera el formulario de pago-->
<div class="cbp-mc-column">
    <label for="forma">Forma</label>
    <select id="forma" name="forma">
        @foreach ($model as $mod)
        <option id="formapago" name="formapago" value="{{$mod->formapago}}" >{{$mod->formapago}}</option>
       @endforeach
    </select>
    <label for="tipopago">Documento</label>
    <select id="tipopago" name="tipopago">
        <option>Choose an occupation</option>
        <option>Web Designer</option>
        <option>Web Developer</option>
        <option>Hybrid</option>
     </select>
    <label for="numero">Numero</label>
    <input type="text" id="numero" name="numero" placeholder="Descuento">
    <div id="campoTarjetaCredito" style="display: none">
        <!-- Aquí coloca tus campos adicionales -->
        <label for="tipoTarjeta">Tipo Tarjeta:</label>
        <select type="text" id="tipoTarjeta" name="tipoTarjeta">
            <option>Visa</option>
        </select>
        <label for="corrdife">Corrinte/Diferido:</label>
        <select type="text" id="corrdife" name="corrdife">
            <option value="Corriente">Corriente</option>
            <option value="Diferido">Diferido</option>
        </select>
        <label for="corrdife">al</label>
        <input type="text" name="descuentotarjeta" id="descuentotarjeta">

    </div>
</div>
    
    <!--Este sera el formulario de informacion general-->
    <div class="cbp-mc-column">
    <label>Fecha</label>
    <input type="date" name="fecha" id="fecha">
    <label for="drink">Numero de Caja</label>
    <input type="text" id="drink" name="drink" placeholder="Green Tea">
    <label for="power">Vendedor</label>
    <input type="text" id="power" name="power" placeholder="Anti-gravity">
    <label for="agente">Agente</label>
    <select id="agente" name="agente">
        <option>No aplicable</option>
        <option>Web Designer</option>
        <option>Web Developer</option>
        <option>Hybrid</option>
     </select>
    </div>
    {{-- <div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" 
    value="Send your data" /></div> --}}

<table class="table-primary" id="miTabla">
    <thead class="tprimaryhead">
        <tr class="col-table-primary">
            <th scope="col">Numero de Serie</th>
            <th scope="col">Cod Art</th>
            <th scope="col">Nombre/Codigo Barras</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Caja</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Descuento</th>
            <th scope="col">IVA</th>
            <th scope="col">Total</th>
            <th scope="col">Stock</th>
          </tr>
    </thead>
    <tbody>
        <tr class="fila-ejemplo">
            <td id="numserie" scope="row"></td>
            <td id="codart" scope="row"></td>
            <td id="nombrecod" scope="row"><input class="articuloInput" id="articuloInput" type="text"></td>
            <td id="cantidad" scope="row"><input type="text"></td>
            <td id="caja" scope="row"></td>
            <td id="punit" scope="row"></td>
            <td id="descu" scope="row"></td>
            <td id="iva" scope="row"></td>
            <td id="total" scope="row"></td>
            <td id="stock" scope="row"></td>

           
          </tr>
    </tbody>

</table>

    </form>

<!--Esto es la tabla de los artculos de ventas-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.autocompletar').on('input', function () {
            var cedula = $(this).val();
    
            if (cedula.length >= 10) {
                // Realizar una solicitud AJAX al servidor para obtener los datos del cliente
                $.ajax({
                    url: '/obtener-datos-cliente', // Reemplaza esto con la URL de tu controlador
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cedula: cedula
                    },
                    success: function (response) {
                        if (response && response.nombre) {
                            // Rellenar los campos con los datos del cliente
                            $('#nombre').val(response.nombre);
                            $('#email').val(response.email);
                            $('#direccion').val(response.direccion);
                        } else {
                            var confirmar = confirm('No se encontraron datos para esta cédula. ¿Desea redirigir a la seccion de clientes para su registro?');
                            if (confirmar) {
                                window.location.href = '/comercio/clientes/crear'; // Reemplaza con la URL de tu página de destino
                            } else {
                                $('#nombre').val("");
                                $('#email').val("");
                                $('#direccion').val("");
                            }                  
                        }
                    },
                    error: function () {
                        // Manejo de errores si es necesario
                    }
                });
            }
        });
    });
    </script>
    <script>
        $(document).ready(function () {
            $('#forma').change(function() {
                var valorSeleccionado = $(this).val();
        
                if (valorSeleccionado) {
                    $.ajax({
                        url: '/obtener-valor-seleccionado', // Reemplaza esto con la URL de tu controlador
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            forma: valorSeleccionado
                        },
                        success: function (response) {
                            var $select = $('#tipopago'); // Obtén el elemento <select>
    
                          $select.empty(); // Limpia las opciones actuales
    
                         $.each(response.opciones, function (key, value) {
                        $select.append($('<option>', {
                          value: key,
                          text: value
                         }));
                         });
                        },
                        error: function () {
                            // Manejo de errores si es necesario
                        }
                    });
                }
            });
        });
        </script>
        <script>
            $(document).ready(function () {
                $('#forma').change(function() {
                    var valorSeleccionado = $(this).val();
            
                    // Mostrar u ocultar el campo adicional según la selección
                    if (valorSeleccionado === 'Tarjeta de Credito') {
                        $('#campoTarjetaCredito').show();
                        $.ajax({
                        url: '/obtener-tipo-tarjeta', // Reemplaza esto con la URL de tu controlador
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            forma: valorSeleccionado
                        },
                        success: function (response) {
                            var $select = $('#tipoTarjeta'); // Obtén el elemento <select>
    
                          $select.empty(); // Limpia las opciones actuales
    
                         $.each(response.opciones, function (key, value) {
                        $select.append($('<option>', {
                          value: key,
                          text: value
                         }));
                         });
                        },
                        error: function () {
                            // Manejo de errores si es necesario
                        }
                    });
                    } else {
                        $('#campoTarjetaCredito').hide();
                    }
                });
            });
            </script> 
<script > 
    
    $(document).ready(function () {
                // Manejar el evento de entrada en los inputs de artículo
                $(document).on('input', '.articuloInput', function () {
                    var articulo = $(this).val();
                    var filaActual = $(this).closest('tr');
                    var proximaFila = filaActual.next();
    
                    // Realizar una solicitud AJAX al servidor para obtener los datos del artículo
                    $.ajax({
                        url: '/obtener-datosde-tabla', // Reemplaza esto con la URL de tu controlador
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            articulo: articulo
                        },
                        success: function (response) {
                            if (response && response.codigo) {
                                // Rellenar los campos de la fila actual con los datos del artículo
                                filaActual.find('#numserie').text(response.id);
                                filaActual.find('#codart').text(response.codigo);
                                filaActual.find('#punit').text(response.precio_compra_sin_iva);
                                filaActual.find('#total').text(response.id_iva);
                                filaActual.find('#stock').text(response.stock_actual);
                            } else {
                                // Limpia los campos de la fila actual si no se encontraron datos
                                filaActual.find('#numserie').text('');
                                filaActual.find('#codart').text('');
                                filaActual.find('#punit').text('');
                                filaActual.find('#total').text('');
                                filaActual.find('#stock').text('');
                            }
    
                          // Verificar si ya existe una fila vacía al final de la tabla
                    var filas = $('#miTabla tbody tr');
                    var ultimaFila = filas[filas.length - 1];
                    var inputUltimaFila = $(ultimaFila).find('.articuloInput');
    
                    // Crear una nueva fila solo si la última fila no está vacía
                    if (articulo.trim() !== '' && inputUltimaFila.val() !== '') {
                        var newRow = filaActual.clone(true); // Clonar la fila actual y sus eventos
                        newRow.find('.articuloInput').val(''); // Limpiar el input del nuevo artículo
                        $('#miTabla tbody').append(newRow); // Agregar la nueva fila a la tabla
                    }
                        },
                        error: function () {
                            // Manejo de errores si es necesario
                        }
                    });
                });
            });

    </script>

   
@endsection()
