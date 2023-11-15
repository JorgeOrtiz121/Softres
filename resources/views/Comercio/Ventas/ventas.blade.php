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
  <label for="desc">Descuento</label>
  <input type="text" id="desc" name="desc" placeholder="0" readonly>  
  <label for="ptos">Ptos Acumulados</label>
  <input type="text" id="ptos" name="ptos" placeholder="0" readonly>  
  <label for="deuda">Deuda</label>
  <input type="text" id="deuda" name="deuda" placeholder="0" readonly>  
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
            <th scope="col">Accion</th>
          </tr>
    </thead>
    <tbody>
        <tr class="fila-ejemplo">
            <td id="numserie" scope="row"></td>
            <td id="codart" scope="row"></td>
            <td id="nombrecod" scope="row"><input class="articuloInput" id="articuloInput" type="text" name="articuloInput"><div class="product_list" id="product_list"></div></td>
            <td id="cantidad" scope="row"><input type="number" value="1" name="cantidad"></td>
            <td id="caja" scope="row"></td>
            <td id="punit" scope="row"></td>
            <td id="descu" scope="row"><input type="text" class="eldescuento" id="eldescuento" name="eldescuento" ></td>
            <td id="iva" scope="row"><input type="checkbox" name="iva" id="iva" ></td>
            <td id="total" scope="row"></td>
            <td id="stock" scope="row"></td>
            <td>
                <button class="eliminar-fila">Eliminar</button>
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
<div class="cbp-mc-column">
    <label for="tipdoc">Tipo Documento</label>
    <select name="tipdoc" id="tipdoc">
        <option value="factura-pro">Factura</option>
        <option value="factura-pro">Proforma</option>
    </select>
    <label for="numdoc">Numero de Documento</label>
    <select name="numdoc" id="numdoc">
        @foreach($emision as $emi)
        <option value="{{$emi->emision}}">{{$emi->emision}}</option>
        @endforeach
    </select>
    <label for="autoriza">Autoriza SRI:</label>
    <input type="text" class="autoriza" id="autoriza">
</div>
<div class="cbp-mc-column">
    <label for="totalcobrar">Total a Cobrar</label>
   <input type="text" id="totalCobrar" readonly>
    <label for="valiva">Valor IVA</label>
    <input type="text" readonly>
    <label for="valice">Valor ICE</label>
    <input type="text" readonly >
</div>
<!--Esto es el Modal-->
  <!-- Modal -->
  @include('Comercio.Ventas.modalclientes')
  <div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" 
    value="Send your data" /></div>

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
                    } else {
                        $('#campoTarjetaCredito').hide();
                    }
                });
            });
    </script> 


   <script>
$(document).ready(function() {

    $('#miTabla').on('keydown', '.articuloInput', function(e) {
        // Si se presiona "Enter", prevenir el comportamiento predeterminado
        if (e.keyCode === 13) {
            e.preventDefault();

            // Puedes agregar aquí la lógica que deseas realizar al presionar "Enter" en el input
            // Por ejemplo, puedes enfocar el siguiente input, hacer una acción específica, etc.
        }
    });


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
            },
            error: function() {
                // Manejar errores si es necesario
            }
        });
    });


    $('#miTabla').on('click', '.eliminar-fila', function() {
        // Elimina la fila actual cuando se hace clic en el botón "Eliminar"
        $(this).closest('tr').remove();
    });


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
                filaActual.find('#numserie').text(response.id);
                filaActual.find('#codart').text(response.codigo);
                filaActual.find('#punit').text(response.precio_compra_sin_iva);
                filaActual.find('#total').text(response.precio_compra_sin_iva);//antes estaba con id_iva
                filaActual.find('#stock').text(response.stock_actual);

                // Crear una nueva fila al final de la tabla
                var newRow = filaActual.clone(true); // Clonar la fila actual y sus eventos
                newRow.find('#articuloInput').val(''); // Limpiar el input del nuevo artículo
                newRow.find('#numserie').text(''); // Limpiar los datos de la nueva fila
                newRow.find('#codart').text('');
                newRow.find('#punit').text('');
                newRow.find('#total').text('');
                newRow.find('#stock').text('');
                $('#miTabla tbody').append(newRow); // Agregar la nueva fila a la tabla
            },
            error: function(error) {
                // Manejar errores si es necesario
            }
        });
    });
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
    $(document).ready(function() {
        // Escucha el evento 'input' en los inputs de cantidad
        $('#miTabla').on('input', 'input[type="number"]', function() {
            // Actualiza dinámicamente la etiqueta de "Total" y el campo "Total a Cobrar"
            actualizarTotales();
        });

        // Función para actualizar dinámicamente la etiqueta de "Total" y el campo "Total a Cobrar"
        function actualizarTotales() {
            var totalSuma = 0;
            $('#miTabla tbody tr').each(function() {
                var cantidad = parseFloat($(this).find('#cantidad input').val()) || 0;
                var punit = parseFloat($(this).find('#punit').text()) || 0;
                var total = cantidad * punit;
                $(this).find('#total').text(total.toFixed(2));
                totalSuma += total;
            });

            // Muestra la suma en el input con id 'totalCobrar'
            $('#totalCobrar').val(totalSuma.toFixed(2));
        }
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
    $(document).ready(function () {
        // Manejar el evento de cambio en el campo de descuento
        $('.eldescuento').on('input', function () {
            calcularDescuento($(this));
            actualizarTotalCobrar();
        });

        // Manejar el evento de cambio en el campo de cantidad
        $('input[name="cantidad"]').on('input', function () {
            calcularDescuento($(this).closest('tr').find('.eldescuento'));
            actualizarTotalCobrar();
        });

        // Función para calcular el descuento y actualizar el total
        function calcularDescuento(descuentoInput) {
            // Obtener el valor del descuento desde el campo de entrada
            var descuentoValor = descuentoInput.val();

            // Obtener la cantidad desde el campo correspondiente a la misma fila
            var cantidad = parseFloat(descuentoInput.closest('tr').find('input[name="cantidad"]').val());

            // Obtener el precio unitario desde el campo correspondiente a la misma fila
            var precioUnitario = parseFloat(descuentoInput.closest('tr').find('#punit').text());

            // Calcular el precio total antes del descuento
            var precioTotal = cantidad * precioUnitario;

            // Verificar si el descuento tiene un signo de porcentaje
            if (descuentoValor.includes('%')) {
                // Descuento con porcentaje
                var porcentajeDescuento = parseFloat(descuentoValor) / 100;
                var descuentoCalculado = precioTotal * porcentajeDescuento;
            } else {
                // Descuento sin porcentaje
                var descuentoCalculado = parseFloat(descuentoValor);
            }

            // Calcular el nuevo precio total después del descuento
            var nuevoPrecioTotal = precioTotal - descuentoCalculado;

            // Actualizar el campo de total con el nuevo valor
            descuentoInput.closest('tr').find('#total').text('$ ' + nuevoPrecioTotal.toFixed(2));
        }

        // Función para actualizar el valor total en el input totalCobrar
        function actualizarTotalCobrar() {
            var totalCobrar = 0;

            // Sumar todos los valores totales en la tabla
            $('.eldescuento').each(function () {
                totalCobrar += parseFloat($(this).closest('tr').find('#total').text().replace('$ ', ''));
            });

            // Actualizar el valor en el input totalCobrar
            $('#totalCobrar').val('$ ' + totalCobrar.toFixed(2));
        }
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
            stock: fila.querySelector('#stock').innerText
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
@endsection()
