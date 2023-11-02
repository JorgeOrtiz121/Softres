<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Validacion para la redireccion luego de iniciar sesión

use App\Http\Controllers\Comercio\Ventas\VentasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/index', function () {
    if (Auth::user()) {
        if (Auth::user()->cargo_id != Null) {//se valida el tipo de usuario
            return redirect('/dashboard');
        } else {
            return redirect('/preview');
        }
    } else {
        return redirect('/');
    }
});

Route::get('/dashboard', function () {
    return view('Dashboard.dashboard');
});

Route::post('panel', 'ComercioController@panel');
Route::get('panel', 'ComercioController@panel');
Route::get('preview', 'ComercioController@login');
Route::post('preview', 'ComercioController@preview');
Route::get('getPreview', 'ComercioController@getPreview')->name('getPreview');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// DASHBOARD
// - Empresas
Route::get('empresas', 'EmpresasController@index')->name('empresas');
Route::get('empresas/listado', 'EmpresasController@index')->name('GetEmpresas');
Route::get('empresas/crear', 'EmpresasController@crear')->name('empresas_crear');
Route::post('empresa_create', 'EmpresasController@empresa_create');
Route::get('empresas/ciudades/{id}', 'EmpresasController@lista_ciudades');
Route::get('empresas/editar/{id}', 'EmpresasController@crear');

// - Administrar Tipos Servidor de correos
Route::get('dashboard/GetServidorMail/{option?}/{id?}', 'DashboardController@GetServidorMail')->name('GetServidorMail');
Route::post('dashboard/tipos/', 'DashboardController@AdminServidorMail');

// COMERCIO
// ###### INICIO ADMINISTRACION ######
    Route::get('comercio/administracion', 'ComercioController@comercio_administracion')->name('comercio_administracion');

    // - Datos
    Route::get('comercio/datos', 'Comercio\Administracion\DatosController@datos')->name('comercio_datos');
    Route::post('comercio_empresa_editar', 'Comercio\Administracion\DatosController@empresa_edit')->name('comercio_empresa_editar');

    // - Parametros Generales
    Route::get('comercio/parametros', 'Comercio\Administracion\ParametrosGeneralesController@parametros')->name('comercio_parametros');
    Route::get('parametros/listado', 'Comercio\Administracion\ParametrosGeneralesController@GetDocumentos')->name('GetDocumentos');
    Route::post('parametros_generales_guardar', 'Comercio\Administracion\ParametrosGeneralesController@parametros_generales_guardar');


        // Configuracion de documentos
        Route::get('comercio/consultar_series/{id}', 'Comercio\Administracion\ParametrosGeneralesController@consultarSeries')->name('getSeries');
        Route::post('comercio/parametros/config_docs/crear', 'Comercio\Administracion\ParametrosGeneralesController@config_docs_create');
        Route::get('comercio/paramteros/config_docs/editar/{id}', 'Comercio\Administracion\ParametrosGeneralesController@config_docs_editar');
        Route::post('paramteros/config_docs/editar', 'Comercio\Administracion\ParametrosGeneralesController@config_docs_edit');

        // Impresiones
        Route::get('comercio/parametros/GetImpresiones', 'Comercio\Administracion\ParametrosGeneralesController@GetImpresiones')->name('GetImpresiones');
        Route::post('comercio/parametros/impresiones/crear', 'Comercio\Administracion\ParametrosGeneralesController@config_impresoras_create');
        Route::get('comercio/paramteros/impresiones/editar/{id}', 'Comercio\Administracion\ParametrosGeneralesController@config_impresoras_editar');
        Route::post('paramteros/impresiones/editar', 'Comercio\Administracion\ParametrosGeneralesController@config_impresoras_edit');

// ###### FIN ADMINISTRACION ######
 
// ###### INVENTARIO ######
    Route::get('comercio/inventario', 'ComercioController@comercio_inventario')->name('comercio_inventario');

    // Articulos
    Route::get('comercio/inventario/articulos', 'Comercio\Inventario\InventarioController@articulos')->name('articulos');
    Route::get('comercio/inventario/articulos/nuevo', 'Comercio\Inventario\InventarioController@nuevo_articulo')->name('nuevo_articulo');
    Route::post('comercio/inventario/articulos/guardar', 'Comercio\Inventario\InventarioController@guardar_articulo')->name('guardar_articulo');
    Route::get('comercio/inventario/articulos/modificar/{id}', 'Comercio\Inventario\InventarioController@modificar_articulo')->name('modificar_articulo');
    Route::post('comercio/inventario/articulos/eliminar', 'Comercio\Inventario\InventarioController@eliminar_articulo')->name('eliminar_articulo');
    Route::get('comercio/inventario/articulos/validar_codigo/{id}', 'Comercio\Inventario\InventarioController@validar_codigo');

        // Iva
        Route::get('comercio/GetIva/{option?}/{id?}', 'Comercio\Inventario\InventarioController@GetIva')->name('GetIva');
        Route::post('comercio/iva/', 'Comercio\Inventario\InventarioController@AdminIva');
    
    // Clasificadores
    Route::get('comercio/inventario/clasificadores', 'Comercio\Inventario\InventarioController@clasificadores')->name('clasificadores');
        // Categorías
        Route::get('comercio/inventario/clasificadores/categorias', 'Comercio\Inventario\InventarioController@categorias_articulos')->name('categorias_articulos');
        Route::post('comercio/inventario/clasificadores/categorias/crear', 'Comercio\Inventario\InventarioController@crear_categoria');
        Route::post('comercio/inventario/clasificadores/categorias/modificar', 'Comercio\Inventario\InventarioController@modificar_categoria');
        Route::post('comercio/inventario/clasificadores/categorias/eliminar', 'Comercio\Inventario\InventarioController@eliminar_categoria');
        // Tipos
        Route::get('comercio/inventario/clasificadores/tipos', 'Comercio\Inventario\InventarioController@tipos_articulos')->name('tipos_articulos');
        Route::post('comercio/inventario/clasificadores/tipos/crear', 'Comercio\Inventario\InventarioController@crear_tipo');
        Route::post('comercio/inventario/clasificadores/tipos/modificar', 'Comercio\Inventario\InventarioController@modificar_tipo');
        Route::post('comercio/inventario/clasificadores/tipos/eliminar', 'Comercio\Inventario\InventarioController@eliminar_tipo');
        // Marcas
        Route::get('comercio/inventario/clasificadores/marcas', 'Comercio\Inventario\InventarioController@marcas_articulos')->name('marcas_articulos');
        Route::post('comercio/inventario/clasificadores/marcas/crear', 'Comercio\Inventario\InventarioController@crear_marca');
        Route::post('comercio/inventario/clasificadores/marcas/modificar', 'Comercio\Inventario\InventarioController@modificar_marca');
        Route::post('comercio/inventario/clasificadores/marcas/eliminar', 'Comercio\Inventario\InventarioController@eliminar_marca');

        // Presentaciones
        Route::get('comercio/inventario/clasificadores/presentaciones', 'Comercio\Inventario\InventarioController@presentaciones_articulos')->name('presentaciones_articulos');
        Route::post('comercio/inventario/clasificadores/presentaciones/crear', 'Comercio\Inventario\InventarioController@crear_presentacion');
        Route::post('comercio/inventario/clasificadores/presentaciones/modificar', 'Comercio\Inventario\InventarioController@modificar_presentacion');
        Route::post('comercio/inventario/clasificadores/presentaciones/eliminar', 'Comercio\Inventario\InventarioController@eliminar_presentacion');
// ###### Fin Iventarios ######
//--------Ventas----------------//
       
Route::get('comercio/ventas/visualizacion/panelprincipal',[VentasController::class,'index'] )->name('presentacion_ventas');
Route::get('comercio/ventas/crear/panelprincipal',[VentasController::class,'store'] )->name('store.ventas');
Route::post('/obtener-datos-cliente', [VentasController::class,'obtenerDatosCliente']);
Route::get('comercio/ventas/visualizacion/panelprincipal', [VentasController::class,'show'])->name('show.pagos');
Route::post('/obtener-valor-seleccionado', [VentasController::class,'obtenerValorSeleccionado'])->name('obtener.pagos');
Route::post('/obtener-tipo-tarjeta', [VentasController::class,'tipotarjeta'])->name('obtener.tarjetas');
Route::post('/obtener-datosde-tabla', [VentasController::class,'obtenertabla'])->name('autocomplete');






// ###### Inicio Proveedores ######
    Route::get('comercio/proveedores', 'Comercio\Proveedores\ProveedoresController@index')->name('GetProveedores');
    Route::get('comercio/proveedores/{option?}/{id?}', 'Comercio\Proveedores\ProveedoresController@ViewModel');
    Route::post('comercio/proveedores/', 'Comercio\Proveedores\ProveedoresController@AdminModel');
// ###### Fin Proveedores ######

// ###### Inicio Clientes ######
    Route::get('comercio/clientes', 'Comercio\Clientes\ClientesController@index')->name('GetClientes');
    Route::get('comercio/clientes/{option?}/{id?}', 'Comercio\Clientes\ClientesController@ViewModel');
    Route::post('comercio/clientes/', 'Comercio\Clientes\ClientesController@AdminModel');

        // Zonas
        Route::get('comercio/GetZonas/{option?}/{id?}', 'Comercio\Clientes\ClientesController@GetZonas')->name('GetZonas');
        Route::post('comercio/zonas/', 'Comercio\Clientes\ClientesController@AdminZonas');

        // Lugares
        Route::get('comercio/GetLugares/{option?}/{id?}', 'Comercio\Clientes\ClientesController@GetLugares')->name('GetLugares');
        Route::post('comercio/lugares/', 'Comercio\Clientes\ClientesController@AdminLugares');
// ###### Fin Clientes ######

