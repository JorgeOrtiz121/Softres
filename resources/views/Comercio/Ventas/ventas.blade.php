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
        background-color:#140a4d;
        text-align: left;
        border: #310672 6px solid;
    }
    .table-primary th,
    .table-primary td{
        padding: 25px 15px;
        border: #f2f4f5 4px solid;

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
border: 3px solid #0A274E;
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
th{
    color: yellow;
}
.eliminar-fila{
    border-radius: 15px;
}
#titletotalc{
    font-weight: bolder;
}



.desc-ptos-deuda-container {
    display: flex;
    width: 100%; /* Ajusta este valor según sea necesario */
}

.desc-ptos-deuda-container label {
    width: 30%;
    margin-right: 10px; 
    margin-inline: 5px;/* Ajusta este valor según sea necesario */
}

.desc-ptos-deuda-container input {
    width: 55px; /* Ajusta este valor según sea necesario */
    margin-bottom: 10px;
    margin-top: 15px;
}

td{
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 11px;
}
.input-container {
    display: flex;
}
#autoriza, #autoriza-id {
    /* Agrega cualquier estilo adicional que necesites */
width: 95px;
}
#articuloInput{
    width: 150px;
}
#cantid, #eldescuento{
    width: 50px;
}
hr {
    width: 15px; /* Ancho de la línea */
    border: 2px solid #007bff; /* Borde punteado azul */
    margin: 10px; /* Margen superior e inferior, y centrado horizontalmente */
    opacity: 0.7; /* Opacidad de la línea */
}
.flex-container {
    display: flex;
    justify-content: space-around; /* Distribuye el espacio entre los divs */
    align-items: flex-start; /* Alinea los divs en la parte superior */
    position: relative;
    right: 60px;
  
}
.flex-container #desgloce{
 position: relative;
 right: 40px;
}
.flex-container .cbp-mc-column{
margin: 0 5px; /* Puedes ajustar este valor para cambiar el espacio entre los divs internos */

}
#tipdoc,#numdoc{
    width: 110px;
}
 #valiva, #valice,#subtotal,#descuentodeltotal,#totaldescu,#iva0,#iva12,#totalco{
    width:85px;
}
#totalCobrar{
    width: 95px;
    height: 85px;
    font-size: 25px;
}

#bodeganum{
    position:sticky;
    margin-top: 5px;
    display: flex;
    margin-right: 450px;
}
#bodeganum select{
    width: 42px;
    height: 35px;
}

#bodeganum label {
    margin-left: 5px;
    padding: -25px;
}
#forma:hover,#tipopago:hover, #tipoTarjeta:hover, #corrdife:hover, #ventasop:hover, #bodega:hover, #agente:hover, #tipdoc:hover, #numdoc:hover{
    background: hsl(227, 92%, 14%);
    border-color: yellow;
}
#forma, #tipopago, #tipoTarjeta, #corrdife, #ventasop, #bodega, #agente, #tipdoc, #numdoc{
    display: inline-block;
	width: 100%;
	cursor: pointer;
  	padding: 7px 10px;
  	height: 42px;
  	outline: 0; 
  	border: 0;
	border-radius: 0;
	background: #f0f0f0;
	font-size: 1em;
	color: #10689a;
	font-family: 'Quicksand', sans-serif;
	border:2px solid rgba(0,0,0,0.2);
    border-radius: 12px;
    position: relative;
    transition: all 0.25s ease;
}
input[type="date"]{
    background-color: #0080ff;
    top: 50%;
    left: 50%;
    font-family: "Roboto Mono",monospace;
    color: #ffffff;
    font-size: 18px;
    border: none;
    outline: none;
    border-radius: 5px;
}
::-webkit-calendar-picker-indicator{
    background-color: #ffffff;
    padding: 5px;
    cursor: pointer;
    border-radius: 3px;
}
</style>
<!--Esto es el formulario del cliente-->
<form  id="miFormulario" class="cbp-mc-form"  method="POST" action="{{route('generarpdf.pdf')}}">
    @csrf
    <div class="cbp-mc-column">
    <label for="cedula">Cedula/RUC </label>
    <input type="text" id="cedula" name="cedula" class="autocompletar" placeholder="CI o RUC">
    <label for="nombre">Cliente</label>
    <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" readonly>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="jon@doe.com" readonly>
    <label for="direccion">Dirreccion</label>
    <input type="text" id="direccion" name="direccion" placeholder="Direcion de su domicilio" readonly> 
 <div class="desc-ptos-deuda-container">

  <label for="desc">Desc</label>
  <input type="text" id="desc" name="desc" placeholder="0" readonly>  
  <label for="ptos">Ptos</label>
  <input type="text" id="ptos" name="ptos" placeholder="0" readonly>  
  <label for="deuda">Deud</label>
  <input type="text" id="deuda" name="deuda" placeholder="0" readonly> 
</div> 
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
    
    <div class="cbp-mc-column" id="bodeganum">
       <label for="Ventas">Usar precio de </label>
       <select name="ventasop" id="ventasop">
        <option value=""></option>
       </select>
       <label for="Bodega">Bodega a usar </label>
       <select name="bodega" id="bodega">
        <option value=""></option>
       </select>
    </div>
    
<table class="table-primary" id="miTabla">
    <thead class="tprimaryhead">
        <tr class="col-table-primary">
            <th scope="col"></th>
            <th scope="col">SERIE</th>
            <th scope="col">COD</th>
            <th scope="col" style="padding-left: 52px;">ARTICULO</th>
            <th scope="col">CANT</th>
            <th scope="col">CAJA</th>
            <th scope="col">PRECIO</th>
            <th scope="col">DESC</th>
            <th scope="col">IVA</th>
            <th scope="col">TOTAL</th>
            <th scope="col">STOCK</th>
            <th scope="col">MARCA</th>
            <th scope="col">ACCION</th>
          </tr>
    </thead>
    <tbody>
        <tr class="fila-ejemplo">
            <td id="numeracion"></td>
            <td id="numserie" scope="row"></td>
            <td id="codart" scope="row"></td>
            <td id="nombrecod" scope="row"><input class="articuloInput" id="articuloInput" type="text" name="articuloInput"><div class="product_list" id="product_list"></div></td>
            <td id="cantidad" scope="row"><input id="cantid" type="number" value="0" name="cantidad"></td>
            <td id="caja" scope="row"></td>
            <td id="punit" scope="row"></td>
            <td id="descu" scope="row"><input type="text" class="eldescuento" id="eldescuento" name="eldescuento" min="0" ></td>
            <td id="iva" scope="row"><input type="checkbox" name="iva" id="iva" class="iva" ></td>
            <td id="total" scope="row"></td>
            <td id="stock" scope="row"></td>
            <td id="marca" scope="row"></td>
            <td>
                <button class="eliminar-fila"><i class="fa-solid fa-trash-can fa-bounce fa-lg" style="color: #d6f109;"></i></button>
            </td>

           
          </tr>
    </tbody>

</table>
<div class="cbp-mc-column">
    <label for="subcliente">Subcliente</label>
    <input type="text" class="subcli" id="subcli" name="subcli" placeholder="Ingrese el subcliente" readonly>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Visualizar Subcliente
      </button>
    <label for="comentario">Comentario</label>
    <textarea name="comentario" id="comentario" cols="30" rows="10">Ingrese su Comentario</textarea>
</div>
<div class="cbp-mc-column" id="formulariodoc">
    <label for="tipdoc">Tipo Documento</label>
    <select name="tipdoc" id="tipdoc">
        <option value="factura">Factura</option>
        <option value="proforma">Proforma</option>
    </select>
    <label for="numdoc">Numero de Documento</label>
    <select name="numdoc" id="numdoc">
        @foreach($emision as $emi)
        <option value="{{$emi->emision}}">{{$emi->emision}}</option>
        @endforeach
    </select>
    <label for="autoriza">Autoriza SRI:</label>
    <div class="input-container">
    <input type="text" class="autoriza" id="autoriza" readonly>
    <hr>
    <input type="text" class="autoriza-id" id="autoriza-id">
    </div>
</div>
<div class="flex-container">
<div class="cbp-mc-column"  >
    <label for="valiva">Valor IVA</label>
    <input type="text"  id="valiva" readonly>
    <label for="valice">Valor ICE</label>
    <input type="text" id="valice" readonly >
    <label for="totalcobrar" id="titletotalc">Total a Cobrar</label>
    <input type="text" id="totalCobrar" readonly>
</div>
<div class="cbp-mc-column" id="desgloce">
    <label for="subtotal">Subtotal</label>
   <input type="text" id="subtotal" readonly>
    <label for="descuentodeltotal">Descuento</label>
    <input type="descuentodeltotal" id="descuentodeltotal" class="descuentodeltotal" name="descuentodeltotal" placeholder="0">
    <label for="totaldescu">Total Descuento</label>
    <input type="totaldescu" id="totaldescu" readonly >
    <label for="iva0">Iva 0%</label>
    <input type="iva0" id="iva0" readonly>
    <label for="iva12">Iva 12%</label>
    <input type="iva12" id="iva12" readonly >
    <label for="totalco">Total</label>
    <input type="totalco" id="totalco" readonly >
</div>

</div>
<!--Esto es el Modal-->
  <!-- Modal -->
  @include('Comercio.Ventas.modalclientes')
  <div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" 
    target="_blank" rel="noopener" value="Send your data" /></div>

    </form>
<!--Datos de Tabla-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                            $('#desc').val(response.favor);
                            $('#ptos').val(response.puntos);
                            $('#deuda').val(response.deuda);
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
                    } else if (valorSeleccionado === 'Tarjeta de Debito'){
                        $('#campoTarjetaCredito').hide();
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

                    } else if (valorSeleccionado === 'Deposito Bancario'){
                        $('#campoTarjetaCredito').hide();
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

                    }else {
                        $('#campoTarjetaCredito').hide();
                    }
                });
            });
    </script> 


   <script>
$(document).ready(function() {
    // Evento keydown para el input de artículo
    $('#miTabla').on('keydown', '.articuloInput', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    });

    // Evento keyup para el input de artículo
    $('#miTabla').on('keyup', '.articuloInput', function() {
        var tablainput = $(this).val();
        var product_list = $(this).siblings('.product_list');

        $.ajax({
            url: '/obtenerdatosposibles',
            method: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                tablainput: tablainput
            },
            success: function(data) {
                product_list.html(data);
                actualizarTotales();

            },
            error: function() {
                // Manejar errores si es necesario
            }
        });
    });

    // Evento click para eliminar fila
    $('#miTabla').on('click', '.eliminar-fila', function() {
        $(this).closest('tr').remove();
        actualizarTotales();
    });
    var numeracion=1;
    // Evento click para seleccionar artículo
    $('#miTabla').on('click', 'li', function() {
        var value = $(this).text();
        var input = $(this).closest('tr').find('.articuloInput');
        input.val(value);
        
        var product_list = input.siblings('.product_list');
        product_list.html("");

        $.ajax({
            url: '/obtener-datosde-tabla',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                valorSeleccionado: value
            },
            success: function(response) {
                var filaActual = input.closest('tr');
                
                filaActual.find('#numeracion').text(numeracion);
                filaActual.find('#numserie').text(response.id);
                filaActual.find('#codart').text(response.codigo);
                filaActual.find('#stock').text(response.stock_actual);
                filaActual.find('#marca').text(response.marca);
                // Manejar el evento de clic del checkbox
                filaActual.find('.iva').off('click');
                filaActual.find('.iva').click(function() {
                    actualizarPrecio(filaActual, response);
                });
                actualizarPrecio(filaActual, response);
                 numeracion++;
                // Crear una nueva fila al final de la tabla
                var newRow = filaActual.clone(true);
                newRow.find('#articuloInput').val('');
                newRow.find('#numeracion').text('');
                newRow.find('#numserie').text('');
                newRow.find('#codart').text('');
                newRow.find('#punit').text('');
                newRow.find('#total').text('');
                newRow.find('#stock').text('');
                newRow.find('#marca').text('');
                newRow.find('.iva').prop('checked', false);
                $('#miTabla tbody').append(newRow);

                // Actualizar totales al agregar nueva fila
                actualizarTotales();
            },
            error: function(error) {
                // Manejar errores si es necesario
            }
        });
    });

    // Evento input para el campo de cantidad
    $('#miTabla').on('input', 'input[type="number"]', function() {
        actualizarTotales();
    });

    

    $('#miTabla').on('change', '.iva', function() {
        var fila = $(this).closest('tr');
        actualizarTotales(fila);
    });

 $('#miTabla').on('input', '.eldescuento', function() {
        actualizarTotales();
    });

    $('#descuentodeltotal').on('input', function () {
        manejarDescuentoTotal();
    });

     function manejarDescuentoTotal() {

    // Obtener el valor del descuento
    var descuentoInput = $('#descuentodeltotal').val();
    console.log(descuentoInput);
    var totalCobrarOriginal = parseFloat($('#totalCobrar').val());

    // Restaurar el valor original de totalCobrar
    var totalCobrar = totalCobrarOriginal;
        console.log(totalCobrar);
    // Verificar si el descuento incluye el signo %
    if (descuentoInput.includes('%')) {
        // Descuento en porcentaje
        var porcentaje = parseFloat(descuentoInput.replace('%', '')) || 0;
            var descuentoPorcentaje = (totalCobrarOriginal * porcentaje) / 100;
            // Restar el descuento al totalCobrar original
            var totalCobrar = totalCobrarOriginal - descuentoPorcentaje;
            $('#totalCobrar').val(totalCobrar.toFixed(2));

    } else {
        // Descuento en valor fijo
        var descuento = parseFloat(descuentoInput) || 0;
            // Restar el descuento al totalCobrar original
            var totalCobrar = totalCobrarOriginal - descuento;
            $('#totalCobrar').val(totalCobrar.toFixed(2));
            console.log(totalCobrar);
    }

    if(descuentoInput==''){
        actualizarTotales();
    }
}



    // Función para actualizar dinámicamente la etiqueta de "Total" y el campo "Total a Cobrar"
    function actualizarTotales() {
        var totalSuma = 0;
    var descuentoTotal = 0;

    $('#miTabla tbody tr').each(function () {
        var cantidad = parseFloat($(this).find('#cantidad input').val()) || 0;
        var punit = parseFloat($(this).find('#punit').text()) || 0;
        var descuento = obtenerDescuento($(this)); // Obtener el descuento
        var total = calcularTotalConDescuento(cantidad, punit, descuento);
        var stock = parseFloat($(this).find('#stock').text()) || 0; // Agregar la obtención del stock
        console.log("este es el stock",stock);
        console.log("este es la cantidad",cantidad);
        $(this).find('#total').text(total.toFixed(2));
        totalSuma += total;
        descuentoTotal += (cantidad * punit) - total;
        });

        // Muestra la suma en el input con id 'totalCobrar'
        $('#totalCobrar').val(totalSuma.toFixed(2));

// Mostrar el descuento total en el input con id 'totaldescu'
$('#totaldescu').val(descuentoTotal.toFixed(2));

// Calcular y mostrar el IVA del 12% en el input con id 'iva12'
var iva12 = totalSuma * 0.12;
$('#iva12').val((totalSuma-iva12).toFixed(2));
$('#subtotal').val((totalSuma - iva12).toFixed(2));

// Calcular y mostrar el IVA del 0% en el input con id 'iva0'
var iva0 = totalSuma - iva12;
$('#iva0').val(totalSuma.toFixed(2));
$('#valiva').val(iva12.toFixed(2));
// Mostrar el total en el input con id 'totalco'
$('#totalco').val(totalSuma.toFixed(2));

}
    

    function obtenerDescuento(fila) {
        var descuentoInput = fila.find('.eldescuento');
        var descuentoValor = parseFloat(descuentoInput.val()) || 0;

        // Si el valor tiene '%' al final, conviértelo a porcentaje
        if (descuentoInput.val().includes('%')) {
            descuentoValor = descuentoValor / 100;
        }

        return descuentoValor;
    }
 function calcularTotalConDescuento(cantidad, precioUnitario, descuento) {
    var subtotal = cantidad * precioUnitario;

    // Verificar si el descuento es un porcentaje y aplicarlo
    if (descuento > 0 && descuento < 1) {
        subtotal *= (1 - descuento); // Descuento en porcentaje
    } else if (descuento >= 1) {
        subtotal -= descuento; // Descuento en valor absoluto
    }

    return subtotal;
    }

    // Función para actualizar el precio según la selección del checkbox de IVA
    function actualizarPrecio(fila, response) {
        var isChecked = fila.find('.iva').is(':checked');
        if (isChecked) {
            fila.find('#punit').text(response.precio_compra_con_iva);
            fila.find('#total').text(response.precio_compra_con_iva);
        } else {
            fila.find('#punit').text(response.precio_compra_sin_iva);
            fila.find('#total').text(response.precio_compra_sin_iva);
        }

        // Actualizar totales al cambiar el precio
        actualizarTotales();
    }
});

   </script>

  
   <script>
    // script-global.js
$(document).ready(function() {
    // Manejar el evento de teclado global
    $(document).on('keydown', function(e) {
        // Si se presiona "Enter" en cualquier elemento de formulario, prevenir el comportamiento predeterminado
        if (e.keyCode === 13 && $(e.target).is(':input')) {
            e.preventDefault();
        }
    });
});

   </script>

   <script>
    	$('#search').on('keyup',function(){
				search_value=$(this).val();
				//alert(search_value);
				$.ajax({
					type:'GET',
					url: '/search',
					data: {'search': search_value},
					success:function(data){
						$('#searcli').html(data);
					},
					error: function(err){
						console.log('Error'+err);
					}
				});
			});
            $('#subclienteTableContainer').on('click', '.select-button', function () {
            var selectedName = $(this).closest('tr').find('.subcliente-name').text();

              $('#subcli').val(selectedName);
    });

   </script>
<script>
    $(document).ready(function () {
                $('#numdoc').change(function() {
                    var valorSeleccionadodoc = $(this).val();
                        $.ajax({
                        url: '/obtenerautorizacion', // Reemplaza esto con la URL de tu controlador
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            numdoc: valorSeleccionadodoc
                        },
                        success: function (response) {
                            $('#autoriza').val(response.opciones);
                        },
                        error: function () {
                            // Manejo de errores si es necesario
                        }
                    });
                    
                });
            });
</script>


<script>
 document.getElementById('miFormulario').addEventListener('submit', function (event) {
    // Evitar que el formulario se envíe automáticamente
    event.preventDefault();

    // Recopilar los datos
    var datosTablaDinamica = [];
    var filas = document.querySelectorAll('.fila-ejemplo');

    filas.forEach(function(fila) {
        var nuevaFila = {
            numSerie: fila.querySelector('#numserie').innerText,
            codArt: fila.querySelector('#codart').innerText,
            nombreCod: fila.querySelector('.articuloInput').value,
            cantidad: fila.querySelector('[name="cantidad"]').value,
            caja: fila.querySelector('#caja').innerText,
            precioUnitario: fila.querySelector('#punit').innerText,
            descuento: fila.querySelector('[name="eldescuento"]').value,
            iva: fila.querySelector('[name="iva"]').checked,
            total: fila.querySelector('#total').innerText,
            stock: fila.querySelector('#stock').innerText,
            marca: fila.querySelector('#marca').innerText,

        };

        datosTablaDinamica.push(nuevaFila);
    });


    var datosAdicionales = {
        cedula: document.getElementById('cedula').value,
        nombre: document.getElementById('nombre').value,
        email: document.getElementById('email').value,
        direccion: document.getElementById('direccion').value,
        descuento: document.getElementById('desc').value,
        ptosAcumulados: document.getElementById('ptos').value,
        deuda: document.getElementById('deuda').value
    };


    // Añade los datos como un campo oculto al formulario
    var datosInput = document.createElement('input');
    datosInput.setAttribute('type', 'hidden');
    datosInput.setAttribute('name', 'datos');
    datosInput.setAttribute('value', JSON.stringify(datosTablaDinamica));
    
    // Adjunta el campo oculto al formulario
    document.getElementById('miFormulario').appendChild(datosInput);


    var datosAdicionalesInput = document.createElement('input');
    datosAdicionalesInput.setAttribute('type', 'hidden');
    datosAdicionalesInput.setAttribute('name', 'datosAdicionales');
    datosAdicionalesInput.setAttribute('value', JSON.stringify(datosAdicionales));
    document.getElementById('miFormulario').appendChild(datosAdicionalesInput);
    // Envía el formulario
    this.submit();
});



</script>

<script>
 $(document).ready(function(){

    $('#formulariodoc').on('change', '#tipdoc', function() {
        var tipodoc = $(this).val();
        console.log(tipodoc);
});

$('#miTabla').on('input', 'input[type="number"]', function() {
        validarCantidadSegunTipoDocumento();
    });

    function validarCantidadSegunTipoDocumento() {
        $('#miTabla tbody tr').each(function () {
            var cantidad = parseFloat($(this).find('#cantidad input').val()) || 0;
            var tipoDocumento = $('#tipdoc').val();

            // Realizar la validación de la cantidad en función del tipo de documento
            if (tipoDocumento === 'factura') {
                var stock = parseFloat($(this).find('#stock').text()) || 0;
                if (cantidad > stock) {
                    alert('La cantidad no puede ser mayor al stock para facturas.');
                    // Puedes agregar más lógica aquí, como restablecer la cantidad a un valor permitido.
                }
            }

            // Resto del código...
        });
    }
 });
</script>

@endsection()
