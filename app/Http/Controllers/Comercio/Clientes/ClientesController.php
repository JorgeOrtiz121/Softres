<?php

namespace App\Http\Controllers\Comercio\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard\TiposGenerico;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Ciudades;

use App\Models\Empresas\Clientes;
use App\Models\Empresas\Zonas;
use App\Models\Empresas\Lugares;

class ClientesController extends Controller
{
    // Index
    public function index(){
        if(request()->ajax()){
            $model = Clientes::with('categorias','tipos','ciudades')->get();
            return datatables()->of($model) 
            ->addColumn('nombre_razon',function($data){
                $name = ($data->nombre != Null) ? $data->nombre : (($data->razon_social =! Null) ? $data->razon_social : '');
                return $name;
            }) 
            ->addColumn('actions', function($data){
                $button = '<center>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                    <ul class="dropdown-menu">
                        <a href="'.asset('comercio/clientes/editar/'.$data->id).'" data-remote="false" data-toggle="tooltip" title="Editar Cliente" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                        <a href="" data-toggle="modal" id="'.$data->id.'" data="'.$data->documento.'" data-remote="false" data-toggle="tooltip" title="Eliminar Cliente" class="btn btn-danger btn-circle ShowDelete"> <i class="fa fa-fw fa-times"></i></a>
                    </ul>
                </div>';
                $button .='</center>';
                return $button;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('Comercio.Clientes.indexClientes');
    }

    // View Store-Update
    public function ViewModel(Request $request){
        try {
            if ($request->option == 'crear' || $request->option == 'editar') { // Crear, Editar
                $type = ($request->option == 'crear') ? 'Crear' : 'Editar';
                $genericTypes = TiposGenerico::get();
                $ciudades = Ciudades::get();
                $paises = Paises::get();
                $provincias = Provincias::get();
                $zonas = Zonas::get();
                $lugares =  Lugares::get();
                $model = (isset($request->id)) ? Clientes::find($request->id) : Null;
    
                if ($request->option == 'crear' || $request->option == 'editar') {
                    return view('Comercio.Clientes.StoreUpdateClientes',compact('type','genericTypes','ciudades','paises','provincias','ciudades','zonas','lugares','model'));        
                }else {
                    return response()->json(['message' => 'Petición invalida', 'codigo'=>500], 500);
                }
            } elseif ($request->option == 'consultar') { // Consultar
                $searchModel = Clientes::where('tipo_documento',$request->tipo_documento)->where('documento',$request->documento)->first();
                if ($searchModel != Null) {
                    if (!isset($request->id) && $searchModel->id != $request->id) {
                        return ['mensaje'=>'<i class="warning fa fa-close"></i> El cliente ya existe','state'=>'0'];
                    }
                } else {
                    return ['mensaje'=>'<i class="success fa fa-check"></i> El cliente no existe','state'=>'1'];
                }
            } else { // No valido
                return response()->json(['message' => 'Petición invalida', 'codigo'=>500], 500);                
            }
            
        } catch (\Throwable $th) {
            dd($th);
            // HistoricoFallos::create(['opcion'=>'CLIENTES CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
            return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
        }
    }

    // Store-Update-Delete Clientes
    public function AdminModel(Request $request){
        try {

            if ($request->ajax()) {
                $action = strtolower($request->action);
                $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                if ($action == 'crear') { // Crear
                    $model = New Clientes();
                }elseif ($action == 'editar') { // Editar
                    $model = Clientes::find($request->id);
                }elseif ($action == 'eliminar') { // Eliminar
                    $model = Clientes::find($request->id);
                    $model->delete();
                    return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                }else { // No valido
                    return response()->json(['message' => 'Petición invalida', 'codigo'=>500], 500);
                }

                $searchModel = Clientes::where('tipo_documento',$request->tipo_documento)->where('documento',$request->documento)->first();
                if ($searchModel != Null) {
                    if (!isset($request->id) && $searchModel->id != $request->id) {
                        return ['codigo'=>0,'mensaje'=>'El documento ingresado ya existe en los registros.'];
                    }
                }

                $model->tipo_documento    = $request->tipo_documento;
                $model->parte_relacionada = $request->has('parte_relacionada');
                $model->documento         = $request->documento;
                $model->cod_auxiliar      = $request->cod_auxiliar;
                $model->nombre            = $request->nombre;
                $model->razon_social      = $request->razon_social;
                $model->telefono1         = $request->telefono1;
                $model->telefono2         = $request->telefono2;
                $model->id_categoria      = $request->id_categoria;
                $model->id_tipos          = $request->id_tipos;
                $model->direccion         = $request->direccion;
                $model->id_ubicacion      = $request->id_ubicacion;
                $model->id_zona           = $request->id_zona;
                $model->id_lugar          = $request->id_lugar;
                $model->id_pais           = $request->id_pais;
                $model->id_provincia      = $request->id_provincia;
                $model->id_ciudad         = $request->id_ciudad;
                $model->representante     = $request->representante;
                $model->id_cuenta         = $request->id_cuenta;
                $model->puntos            = $request->puntos;
                $model->deuda             = $request->deuda;
                $model->afavor            = $request->afavor;
                $model->email1            = $request->email1;
                $model->email2            = $request->email2;
                $model->credito_max       = $request->credito_max;
                $model->max_plazo         = $request->max_plazo;
                $model->descuento         = $request->descuento;
                $model->intereses_mora    = $request->intereses_mora;
                $model->id_estado         = $request->id_estado;
                $model->id_pvp            = $request->id_pvp;
                $model->observaciones     = $request->observaciones;
                $model->ref_vivienda      = $request->ref_vivienda;
                $model->id_sexo           = $request->id_sexo;
                $model->fecha_nacimiento  = $request->fecha_nacimiento;
                $model->id_estado_civil   = $request->id_estado_civil;
                $model->num_hijos         = $request->num_hijos;
                $model->profesion         = $request->profesion;
                $model->ingreso_mensual   = $request->ingreso_mensual;
                $model->empresa_lab       = $request->empresa_lab;
                $model->referido_por      = $request->referido_por;
                $model->id_vendedor       = $request->id_vendedor;
                // dd($model);

                $model->save();

                return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
            }
        } catch (\Throwable $th) {
            dd($th);
            HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' CLIENTE', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
            return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
        }
    }

    // ####### Gestionar Zonas #######
        // Index
        public function GetZonas(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = Zonas::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = Zonas::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = Zonas::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditZone('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteZone($(this));" class="btn btn-danger btn-circle DeleteZone"> <i class="fa fa-fw fa-times"></i></a>
                                </ul>
                            </div>';
                            $button .='</center>';
                            return $button;
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                // HistoricoFallos::create(['opcion'=>'ZONAS CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete Zonas
        public function AdminZonas(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New Zonas();
                    }elseif ($action == 'editar') { // Editar
                        $model = Zonas::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = Zonas::find($request->id);
                        $childrenModel = Clientes::where('id_zona',$model->id)->get();
                        $childrenModel2 = Lugares::where('id_zona',$model->id)->get();

                        if (count($childrenModel) > 0 || count($childrenModel2) > 0) {
                            return response()->json(['message' => 'No se puede eliminar la zona porque está asociada a otros clientes y/o lugares', 'codigo'=>0], 200);
                        } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->nombre      = $request->nombre;
                    $model->descripcion = $request->descripcion;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' ZONAS', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar Zonas #######

    // ####### Gestionar Lugares #######
        // Index
        public function GetLugares(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = Lugares::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = Lugares::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = Lugares::with('zonas')->get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditPlace('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeletePlace($(this));" class="btn btn-danger btn-circle DeletePlace"> <i class="fa fa-fw fa-times"></i></a>
                                </ul>
                            </div>';
                            $button .='</center>';
                            return $button;
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                // HistoricoFallos::create(['opcion'=>'LUGARES CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete Lugares
        public function AdminLugares(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New Lugares();
                    }elseif ($action == 'editar') { // Editar
                        $model = Lugares::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = Lugares::find($request->id);
                        $childrenModel = Clientes::where('id_lugar',$model->id)->get();

                        if (count($childrenModel) > 0 ) {
                            return response()->json(['message' => 'No se puede eliminar el lugar porque está asociada a otros clientes', 'codigo'=>0], 200);
                        } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->nombre      = $request->nombre;
                    $model->descripcion = $request->descripcion;
                    $model->id_zona     = $request->id_zona;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' LUGARES', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar Lugares #######

}