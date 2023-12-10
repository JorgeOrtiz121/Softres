<?php

namespace App\Http\Controllers\Comercio\Proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard\TiposGenerico;
use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Ciudades;

use App\Models\Empresas\Proveedores;
use App\Models\Empresas\CategoriaProveedor;
use App\Models\Empresas\TipoProveedor;

class ProveedoresController extends Controller
{
    // Index
    public function index(){
        if(request()->ajax()){
            $model = Proveedores::with('categorias','tipos','ciudades')->get();
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
                        <a href="'.asset('comercio/proveedores/editar/'.$data->id).'" data-remote="false" data-toggle="tooltip" title="Editar Proveedor" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                        <a href="" data-toggle="modal" id="'.$data->id.'" data="'.$data->documento.'" data-remote="false" data-toggle="tooltip" title="Eliminar Proveedor" class="btn btn-danger btn-circle ShowDelete"> <i class="fa fa-fw fa-times"></i></a>
                    </ul>
                </div>';
                $button .='</center>';
                return $button;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('Comercio.Proveedores.indexProveedores');
    }

    // View Store-Update
    public function ViewModel(Request $request){
        try {
            $type = ($request->option == 'crear') ? 'Crear' : 'Editar';
            $genericTypes = TiposGenerico::get();
            $CategoriaProveedor = CategoriaProveedor::get();
            $TipoProveedor = TipoProveedor::get();
            $ciudades = Ciudades::get();
            $paises = Paises::get();
            $proveedores = Proveedores::get();
            $provincias = Provincias::get();
            $model = (isset($request->id)) ? Proveedores::find($request->id) : Null;

            if ($request->option == 'crear' || $request->option == 'editar') {
                return view('Comercio.Proveedores.StoreUpdateProveedores',compact('TipoProveedor','CategoriaProveedor','type','genericTypes','ciudades','paises','provincias','proveedores','model'));        
            }else {
                return response()->json(['message' => 'Petición invalida', 'codigo'=>500], 500);
            }
        } catch (\Throwable $th) {
            dd($th);
            // HistoricoFallos::create(['opcion'=>'PROVEDOR CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
            return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
        }
    }

    // Store-Update-Delete Proveedores
    public function AdminModel(Request $request){
        try {
            if ($request->ajax()) {
                $action = strtolower($request->action);
                $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                if ($action == 'crear') { // Crear
                    $model = New Proveedores();
                }elseif ($action == 'editar') { // Editar
                    $model = Proveedores::find($request->id);
                }elseif ($action == 'eliminar') { // Eliminar
                    $model = Proveedores::find($request->id);
                    $model->delete();
                    return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                }else { // No valido
                    return response()->json(['message' => 'Petición invalida', 'codigo'=>500], 500);
                }

                $model->tipo_documento          = $request->tipo_documento;
                $model->documento               = $request->documento;
                $model->nombre                  = $request->nombre;
                $model->razon_social            = $request->razon_social;
                $model->representante           = $request->representante;
                $model->id_categoria            = $request->id_categoria;
                $model->id_tipos                = $request->id_tipos;
                $model->artesano                = $request->has('artesano');
                $model->id_ubicacion            = $request->id_ubicacion;
                $model->direccion               = $request->direccion;
                $model->telefono                = $request->telefono;
                $model->web                     = $request->web;
                $model->email1                  = $request->email1;
                $model->email2                  = $request->email2;
                $model->id_pais                 = $request->id_pais;
                $model->id_provincia            = $request->id_provincia;
                $model->id_ciudad               = $request->id_ciudad;
                $model->cupo_credito            = $request->cupo_credito;
                $model->cxp                     = $request->cxp;
                $model->notas                   = $request->notas;
                $model->observaciones           = $request->observaciones;
                $model->id_subproveedor         = $request->id_subproveedor;
                $model->id_retencion            = $request->id_retencion;
                $model->retencion_iva_bienes    = $request->retencion_iva_bienes;
                $model->retencion_iva_servicios = $request->retencion_iva_servicios;
                // dd($model);

                $model->save();

                return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
            }
        } catch (\Throwable $th) {
            dd($th);
            HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' PROVEDOR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
            return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
        }
    }

    // ####### Gestionar Category #######
        // Index
        public function GetCategory(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = CategoriaProveedor::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = CategoriaProveedor::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = CategoriaProveedor::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditCategory('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteCategory($(this));" class="btn btn-danger btn-circle DeleteCategory"> <i class="fa fa-fw fa-times"></i></a>
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
                // HistoricoFallos::create(['opcion'=>'Category CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete Category
        public function AdminCategory(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New CategoriaProveedor();
                    }elseif ($action == 'editar') { // Editar
                        $model = CategoriaProveedor::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = CategoriaProveedor::find($request->id);
                        $childrenModel = Proveedores::where('id_categoria',$model->id)->get();

                        if (count($childrenModel) > 0 ) {
                            return response()->json(['message' => 'No se puede eliminar la cateogria porque está asociada a otros proveedores', 'codigo'=>0], 200);
                        } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->nombre      = $request->nombre;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' categoria', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar Category #######

    // ####### Gestionar SupplierType #######
        // Index
        public function GetSupplierType(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = TipoProveedor::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = TipoProveedor::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = TipoProveedor::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditSupplierType('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteSupplierType($(this));" class="btn btn-danger btn-circle DeleteSupplierType"> <i class="fa fa-fw fa-times"></i></a>
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
                // HistoricoFallos::create(['opcion'=>'SupplierType CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete SupplierType
        public function AdminSupplierType(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New TipoProveedor();
                    }elseif ($action == 'editar') { // Editar
                        $model = TipoProveedor::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = TipoProveedor::find($request->id);
                        $childrenModel = Proveedores::where('id_tipos',$model->id)->get();

                        if (count($childrenModel) > 0 ) {
                            return response()->json(['message' => 'No se puede eliminar el tipo porque está asociada a otros proveedores', 'codigo'=>0], 200);
                        } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->nombre      = $request->nombre;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' tipo proveedor', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar SupplierType #######

    public function FindProveedores(Request $request)
    {
        $data = Proveedores::with('ciudades','subproveedores')
                            ->where(function ($query) use ($request) {
                            $query->where("nombre", "LIKE", "%$request->q%")
                                  ->orWhere("documento", "LIKE", "%$request->q%");
                            })
                            ->get();

        return response()->json($data);
    }
}
