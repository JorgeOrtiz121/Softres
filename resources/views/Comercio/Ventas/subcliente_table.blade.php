<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        /* Puedes agregar estilos personalizados aquí */
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10">
            <h1>SOFTRES SISTEMAS</h1>
            <h1>ROMULO ESTRADA IVAN ROMERO</h1>
            <h2>DIRECCION MATRIZ</h2>
            <p>9 DE OCTUBRE Y LUIS ARIAS GUERRA</p>
            <h2>DIRECCION ESTABLECIMIENTO</h1>
            <p>9 DE OCTUBRE Y LUIS ARIAS GUERRA</p>
        </div>
        <div class="col-xs-2">
            <img class="img img-responsive" src="data:image/jpeg;base64,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" alt="Logotipo">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-10">
            <h1 class="h6">RUC</h1>
            <p class="h6">18501536002542424224</p>
        </div>
        <div class="col-xs-2 text-center">
            <strong>Fecha</strong><br>
            <p>18 de Diciembre del 2023 15:05</p>
            <!-- Inserta la fecha aquí -->
            <br>
            <strong>Factura No.</strong><br>
            <h2>Ambiente</h2>
            <p>Produccion</p>
            <h2>Emision</h2>
            <p>Normal</p>
            <!-- Inserta el número de factura aquí -->
            <h4>Numero de Acceso</h4>
            <div>{!! DNS1D::getBarcodeHTML($numeroAcc,"C128")!!}</div>
            <p>{{$numeroAcc}}</p>
            <p>Contribuyente Regimen RIMPE</p>
        </div>
    </div>
    <hr>
    <div class="row text-center" style="margin-bottom: 2rem;">
        <table>
            <tr>
                <tbody>
                    <tr >   
                        <td scope= "row" >
                            <p>RAZON SOCIAL: {{$nombre}}</p>
                        </td>
                   </tr>
                   <tr >
                    <td scope= "row">
                        <p> IDENTIFICACION: {{$cedula}}</p>
                    </td>
                    <td>
                        <p>FECHA DE EMISION: 2023-05-12</p>
                    </td>
                   </tr>
                   <tr >
                    <td scope= "row">
                        <p>CORREO: {{$email}}</p>
                    </td> 
                   </tr>
                   <tr>
                    <td>
                      <p>DIRECCION: {{$provinciaDelCliente}}</p>
                    </td>
                    <td>
                    <p>CIUDAD: {{$ciudad}}</p>
                    </td>
                    <td>
                     <p>TELEFONO: {{}}</p>
                    </td>
                   </tr>
                </tbody>
            </tr>
            
        </table>
      
    </div>
    <div class="row">
        <div class="col-xs-6">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Inserta las filas de la tabla aquí -->
                    <tr>
                        <td>Producto 1</td>
                        <td>2</td>
                        <td>$10.00</td>
                        <td>$20.00</td>
                    </tr>
                    <tr>
                        <td>Producto 2</td>
                        <td>1</td>
                        <td>$15.00</td>
                        <td>$15.00</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
        <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Detalle</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Inserta las filas de la tabla de precios aquí -->
                        <tr>
                            <td>Subtotal 12%</td>
                            <td>$ <!-- Inserta el subtotal aquí --></td>
                        </tr>
                        <tr>
                            <td>Subtotal 0%</td>
                            <td>$ <!-- Inserta el descuento aquí --></td>
                        </tr>
                        <!-- Inserta más filas de subtotaless según sea necesario -->
                        <tr>
                            <td>Total Descuento</td>
                            <td>$ <!-- Inserta los impuestos aquí --></td>
                        </tr>
                        <tr>
                            <td>Valor ICE</td>
                            <td>$ <!-- Inserta los impuestos aquí --></td>
                        </tr>
                        <!-- Inserta más filas de impuestos según sea necesario -->
                        <tr>
                            <td>Valor a Pagar Total</td>
                            <td>$ <!-- Inserta el total aquí --></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="h5"><!-- Inserta el mensaje de pie aquí --></p>
        </div>
    </div>
</div>
</body>
</html>
