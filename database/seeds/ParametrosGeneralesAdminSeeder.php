<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\ParametrosGeneralesAdmin;

class ParametrosGeneralesAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Seleccionar empresa al iniciar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Controlar instancias','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Históricos','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Verificar apartura de caja al iniciar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Ejecutar vigilante de comprobantes electrónicos en este equipo','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'Crear nuevos formularios en nuevas compras y ventas','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'generales','nombre'=>'N° decimales en peso de balanza electrónica','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Precio de venta predeterminado','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Columna base para facturar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Facturar desde bodega','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Confimación de emisión','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Guardar temporalmente items de facturas','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Poner los articulos repetidos en filas diferentes al facturar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Calcular utilidades al registrar la venta','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'PC en ventas temporales y por facturar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Activar otros impuestos para servicios','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Activar lista de facturas con Ctrl + F','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Limitar número de items según diseño de impresión','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Bloquear casilla de verificación de IVA en ventas','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Números decimales en PVP (incluido IVA)','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Colocar cantidad manual con código de barras','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Exigir asignación de agente vendedor','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Usar como referencia para descuento al','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Usar el PV3 solo con 2 decimales sin IVA','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'ventas','nombre'=>'Activar preventa en este equipo','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Establecer crédito como forma de pago predeterminado','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Usar bloqueo automatico de créditos','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Recapitalizar intereses con pago parcial','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Enviar recibo de cobro al correo del cliente','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Intereses anuales por mora','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'clientes y cuentas por cobrar','nombre'=>'Imprimir plan de pagos en','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Números de precios de venta*','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Mantener fijos los precios de venta en cada compra','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Calcular PVP en base a la utilidad y costo al crear el producto','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Usar el ultimo precio de compra como costo','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Bloquear modificación de precio de compra','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Usar fecha de emisión de compra como fecha de retención','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Número de decimales en precio de compra (incluido IVA)','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'(%)Procentaje extra sobre el FBO','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'inventarios y compras','nombre'=>'Exigir ingreso de lote en productos expirables','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Verificar existencias minimas al iniciar el sistema','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Verificar articulos por expirar al iniciar el sistema','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Verificar retenciones pendientes de registrar','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Notificar ajustes realizados al inventario','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Notificar cambios en el costo de inventario','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'alertas','nombre'=>'Notificar cuentas por cobrar vencidas','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        // FE
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Ruta RIDE','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>1,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Ruta firma','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>1,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Ruta logo RIDE','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>1,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Certificado','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Password firma','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>1]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Fecha caducidad firma','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>1,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Ocultar el código de los productos facturados','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_cbte','nombre'=>'Firmar y enviar manualmente','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Servidor de correo','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Puerto del servidor','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Tiempo de espera','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Nombre del remitente','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>1,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Dirección del remitente','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>1,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Nombre de usuario','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>1,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Contraseña','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>1]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_info_acount_email','nombre'=>'Usar SSL','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>0,'select'=>1,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_emitir_cbte','nombre'=>'Facturas o comprobantes de venta','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_emitir_cbte','nombre'=>'Retención sobre compras','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_emitir_cbte','nombre'=>'Guias de remisión','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_emitir_cbte','nombre'=>'Notas de crédito','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>1,'number'=>0,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);
        $data = ParametrosGeneralesAdmin::create(['modulo'=>'fe_emitir_cbte','nombre'=>'No. decimales factura','estado'=>0,'valor'=>Null,'dato'=>Null,'checkbox'=>0,'number'=>1,'select'=>0,'file'=>0,'text'=>0,'date'=>0,'password'=>0]);

    }
}
