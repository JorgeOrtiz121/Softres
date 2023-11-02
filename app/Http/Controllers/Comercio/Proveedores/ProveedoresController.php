<?php

namespace App\Http\Controllers\Comercio\Proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard\TiposGenerico;
use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Ciudades;

use App\Models\Empresas\Proveedores;


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
            $ciudades = Ciudades::get();
            $paises = Paises::get();
            $proveedores = Proveedores::get();
            $provincias = Provincias::get();
            $model = (isset($request->id)) ? Proveedores::find($request->id) : Null;

            if ($request->option == 'crear' || $request->option == 'editar') {
                return view('Comercio.Proveedores.StoreUpdateProveedores',compact('type','genericTypes','ciudades','paises','provincias','proveedores','model'));        
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
}
