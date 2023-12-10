<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard\TipoServidorMail;

class DashboardController extends Controller
{
     // ####### Gestionar Tipos Servidor de correos #######
        // Index
        public function GetServidorMail(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = TipoServidorMail::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = TipoServidorMail::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = TipoServidorMail::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditTipo('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteType($(this));" class="btn btn-danger btn-circle DeleteType"> <i class="fa fa-fw fa-times"></i></a>
                                </ul>
                            </div>';
                            $button .='</center>';
                            return $button;
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
                    }
                }else{
                    return view('Dashboard.AdministracionGeneral.tipo_servidor_mails');
                }
            } catch (\Throwable $th) {
                dd($th);
                // HistoricoFallos::create(['opcion'=>'ServidorMail CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete ServidorMail
        public function AdminServidorMail(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New TipoServidorMail();
                    }elseif ($action == 'editar') { // Editar
                        $model = TipoServidorMail::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = TipoServidorMail::find($request->id);
                        // $childrenModel = childrenModel::where('dato',$model->id)->get();

                        // if (count($childrenModel) > 0 ) {
                        //     return response()->json(['message' => 'No se puede eliminar la zona porque está asociada a otras opciones', 'codigo'=>0], 200);
                        // } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        // }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->nombre      = $request->nombre;

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' ServidorMail', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar Tipos Servidor de correos #######

}
