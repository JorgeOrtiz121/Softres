<?php

namespace App\Http\Controllers\Comercio\Ventas;

use App\Autorizacion;
use App\FormasPago;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Empresas as DashboardEmpresas;
use App\Models\Dashboard\UsuariosEmpresas;
use App\Models\Empresas\Articulos;
use App\Models\Empresas\Clientes;
use App\OpcionPago;
use App\PuntosE;
use App\TarjetaPago;
use Barryvdh\DomPDF\Facade\Pdf;
use Facade\FlareClient\Http\Response;
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
                'direccion' => $cliente->direccion,
                'puntos'=> $cliente->puntos,
                'deuda'=> $cliente->deuda,
                'favor'=> $cliente->afavor
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
        $dato=$request->valorSeleccionado;
        $tabladato= Articulos::with('marcas','tipo_iva')->where ('nombre',$dato)->first();
        Log::info('Valor seleccionado del input de la tabla: ' .$tabladato);
        if($tabladato){
            return response()->json([
                'id' => $tabladato->id,
                'codigo' => $tabladato->codigo,
                'precio_compra_sin_iva' => $tabladato->precio_compra_sin_iva,
                'id_iva'=> $tabladato->tipo_iva->pluck('porcentaje'),
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
    public function show(Request $request)
    {
        $model = FormasPago::all();
        $emision=PuntosE::all();
        return view('Comercio.Ventas.ventas', compact('model','emision'));

    }


  

    

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


    public function datosposibles(Request $request){
        if ($request->ajax() ){
            $data=Articulos::where('nombre','LIKE',$request->tablainput.'%')->get();
             $salida='';
             if(count($data)>0){
                $salida='<ul class="list-group" style="display:block; position:relative; z-index: index 1;" >';
                foreach($data as $row){
                    $salida.='<li class="list-group-item" >'.$row->nombre.'</li>';
                }
             }else{
                $salida.='<li class="list-group-item">No existe resultados</li>';
             }
             return $salida;
        }
    }

   public function store(){
    // dd($_POST['articulo']);
      /*  $datos=$_POST['articulo'];*/
   }

   public function search(Request $request)
	{
		if($request->ajax())
		{

			$res="";
            $texto=$request->search;
            $modelosub=Clientes::where('nombre','LIKE','%'.$texto.'%')->paginate(5);
			if($modelosub)
			{
				foreach($modelosub as $subcli)
				{
					 $res .= '<tr>'.
                     '<td class="subcliente-name">'.$subcli->nombre.'</td>'.
                     '<td>'.$subcli->documento.'</td>'.
                     '<td>'.$subcli->telefono1.'</td>'.
                     '<td><button type="button" class="select-button" style="border-radius: 25px"><i class="fa-solid fa-check" style="color: #b0da16;"></i></button></td>'.
                     '</tr>';

				}
				
				return $res;
			}
		}
	}

     public function autoridadSRI(Request $request){
        $formaSeleccionada = $request->numdoc;
        Log::info('Pase por ahi111: ' .$formaSeleccionada);
        $emision = PuntosE::with('opcionemisions')->where('emision', $formaSeleccionada)->first();
        Log::info('Pase por ahi: ' .$emision);
        
        if ($emision) {
            $opcionEmisions = $emision->opcionemisions; // Obtener la relación
            $autorizaciones = $opcionEmisions->pluck('autorizacion');
            Log::info('Pase por ahi: ' .$autorizaciones);
            return response()->json(['opciones' => $autorizaciones]);
        } else {
            return response()->json(['opciones' => []]);
        }

     }


     public function generarPDF(Request $request){
        $datosTablaDinamica = json_decode($request->input('datos'), true);
        $datosTablaDinamica2 = json_decode($request->input('datosAdicionales'), true);
        Log::info('Pase por ahi: form ' .json_encode($datosTablaDinamica));
        Log::info('Pase por ahi: form1 ' .json_encode($datosTablaDinamica2));
        $data=Clientes::all();
        $numeroAcc='25515111111561515116511111';
        $pdf = Pdf::loadView('Comercio.Ventas.subcliente_table', compact('data','numeroAcc'));
        return $pdf->stream();
        //  return $pdf->download('invoice.pdf');
     }
    
}
