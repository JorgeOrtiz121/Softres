<?php

namespace App\Http\Controllers\Comercio\Ventas;

use App\FormasPago;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Empresas as DashboardEmpresas;
use App\Models\Dashboard\UsuariosEmpresas;
use App\Models\Empresas\Articulos;
use App\Models\Empresas\Clientes;
use App\OpcionPago;
use App\TarjetaPago;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PDO;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $usuario = Auth::user();

        // // Ahora puedes usar $usuario para interactuar con el modelo UserEmpresa
        // $userEmpresa = UsuariosEmpresas::with('empresas')->where('user_id', $usuario->id)
        // ->get();
        // $empresasDelUsuario = $userEmpresa->first()->empresas;
        // //dd($empresasDelUsuario->database);
        // $empresa = DashboardEmpresas::where('database', $empresasDelUsuario->database)->first();

        //  if ($empresa) {
        //      // Configura la conexión para la empresa actual
        //      Config::set('database.connections.tenant.database', $empresa->database);
        //      //Config::set('database.default', 'tenant'); // Cambia la conexión por defecto a 'tenant' si es necesario
        //  }

        //  // Reconecta a la base de datos de la empresa
        //  DB::reconnect('tenant');
        //  //$databaseName = DB::connection('tenant')->getPdo()->query('SELECT DATABASE()')->fetchColumn();
        //  //$tables = DB::connection('tenant')->getPdo()->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        //  $tables = DB::connection('tenant')->select('SELECT * FROM clientes' );
        return view('Comercio.Ventas.ventas');
    }



    public function obtenerDatosCliente(Request $request)
    {
        $cedula = $request->cedula;

        // Consulta la base de datos para obtener los datos del cliente
        $cliente = Clientes::where('documento', $cedula)->first();

        if ($cliente) {
            return response()->json([
                'nombre' => $cliente->nombre,
                'email' => $cliente->email1,
                'direccion' => $cliente->direccion
            ]);
        } else {
            return response()->json(['error' => 'Cliente no encontrado']);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenertabla(Request $request)
    {
        $dato=$request->articulo;
        $tabladato= Articulos::with('marcas','tipo_iva')->where ('nombre',$dato)->first();
        Log::info('Valor seleccionado: ' .$tabladato);
        if($tabladato){
            return response()->json([
                'id' => $tabladato->id,
                'codigo' => $tabladato->codigo,
                'precio_compra_sin_iva' => $tabladato->precio_compra_sin_iva,
                'id_iva'=> $tabladato->id_iva,
                'precio_compra_sin_iva'=>$tabladato->precio_compra_sin_iva,
                'stock_actual'=>$tabladato->stock_actual,
            
            ]);
        }else{
            return response()->json(['error' => 'Articulo no registrado']);
        }

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tipotarjeta(Request $request)
    {
        $formaSeleccionada = $request->input('forma');
        $formaSeleccionada1='Tarjeta de Credito';
        $pago = FormasPago::with('opcionpagos')->where('formapago', $formaSeleccionada1)->first();
        
        if ($pago) {
            $opcionespago=TarjetaPago::all();
            $opciones=[];
            foreach($opcionespago as $item){
                $opciones[$item->id] = $item->tipotarjeta;

            }
            return response()->json(['opciones' => $opciones]);
        } else {
            return response()->json(['opciones' => []]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $model = FormasPago::all();
        return view('Comercio.Ventas.ventas', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function obtenerValorSeleccionado(Request $request)
    {
        $formaSeleccionada = $request->input('forma');
        $pago = FormasPago::with('opcionpagos')->where('formapago', $formaSeleccionada)->first();
        
        if ($pago) {
            $opcionPagos = $pago->opcionpagos;
            $opciones = [];
        
            foreach ($opcionPagos as $tipopago) {
                $opciones[$tipopago->id] = $tipopago->nombrepago;
            }
        
            return response()->json(['opciones' => $opciones]);
        } else {
            return response()->json(['opciones' => []]);
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
