<?php

namespace App\Http\Controllers\Comercio\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DOMDocument;

use App\Models\Dashboard\TiposGenerico;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Ciudades;
use App\Models\Dashboard\Paises;

use App\Models\Empresas\DocumentoAutorizado;
use App\Models\Empresas\TiposComprasVarias;
use App\Models\Empresas\SustentoTributario;
use App\Models\Empresas\Proveedores;
use App\Models\Empresas\Articulos;
use App\Models\Empresas\Compras;

class ComprasController extends Controller
{

    public function panel_compras(){
        return view('Comercio.Compras.panel_compras');
    }

    public function registrar_compra(Request $request){
        $TiposComprasVarias = TiposComprasVarias::get();
        $SustentoTributario = SustentoTributario::get();
        $DocumentoAutorizado = DocumentoAutorizado::get();

        return view('Comercio.Compras.registrar_compra', compact('TiposComprasVarias','SustentoTributario','DocumentoAutorizado'));
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

                $model->tipo_compra             = $request->tipo_compra;
                $model->id_tipo_compras_varias  = $request->id_tipo_compras_varias;
                $model->sustento_tributario     = $request->sustento_tributario;
                $model->id_documento_autorizado = $request->id_documento_autorizado;
                $model->tipo_gasto              = $request->tipo_gasto;
                // id_proveedor
                // num1
                // num2
                // num3
                // uni_paq
                // autorizacion_sri
                // f_emision
                // f_registro
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

    // ####### Gestionar TiposComprasVarias #######
        // Index
        public function GetTiposComprasVarias(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = TiposComprasVarias::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = TiposComprasVarias::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = TiposComprasVarias::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditTiposComprasVarias('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->detalle.'" onclick="DeleteTiposComprasVarias($(this));" class="btn btn-danger btn-circle DeleteTiposComprasVarias"> <i class="fa fa-fw fa-times"></i></a>
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
                // HistoricoFallos::create(['opcion'=>'TiposComprasVarias CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete TiposComprasVarias
        public function AdminTiposComprasVarias(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New TiposComprasVarias();
                    }elseif ($action == 'editar') { // Editar
                        $model = TiposComprasVarias::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = TiposComprasVarias::find($request->id);
                        $model->delete();
                        return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);

                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    if ( $request->detalle == Null) {
                        return response()->json(['message' => 'Debe asignar un nombre al Tipo de compra', 'codigo'=>0], 200);
                    }

                    $model->detalle             = $request->detalle;
                    $model->cuenta_contable     = $request->cuenta_contable;
                    $model->cuenta_contable_iva = $request->cuenta_contable_iva;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' TiposComprasVarias', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar TiposComprasVarias #######

    // ####### Gestionar SustentoTributario #######
        // Index
        public function GetSustentoTributario(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = SustentoTributario::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = SustentoTributario::get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = SustentoTributario::get();
                        return datatables()->of($model) 
                        ->addColumn('asociados', function($data){
                            $array = [];
                            foreach ($data->DocumentoAutorizado as $key => $value) {
                                $array[] = [$value->codigo.':'.$value->nombre];
                            }
                            return $array;
                        })  
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditSustentoTributario('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteSustentoTributario($(this));" class="btn btn-danger btn-circle DeleteSustentoTributario"> <i class="fa fa-fw fa-times"></i></a>
                                </ul>
                            </div>';
                            $button .='</center>';
                            return $button;
                        })
                        ->rawColumns(['asociados','actions'])
                        ->make(true);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                // HistoricoFallos::create(['opcion'=>'SustentoTributario CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete SustentoTributario
        public function AdminSustentoTributario(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New SustentoTributario();
                    }elseif ($action == 'editar') { // Editar
                        $model = SustentoTributario::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = SustentoTributario::find($request->id);
                        // OJO Validar hijos
                        $model->delete();
                        return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);

                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    if ( $request->codigo == Null) {
                        return response()->json(['message' => 'Debe asignar un código ', 'codigo'=>0], 200);
                    }

                    $model->codigo = $request->codigo;
                    $model->nombre = $request->nombre;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' SustentoTributario', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar SustentoTributario #######

    // ####### Gestionar DocumentoAutorizado #######
        // Index
        public function GetDocumentoAutorizado(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = DocumentoAutorizado::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    } elseif ($request->option == 'select' && isset($request->id)) { // Cargar datos para el select
                        $model = DocumentoAutorizado::where('id_sustento_tributario',$request->id)->get();
                        return $model;
                    }  else { // Llenar la tabla
                        $model = DocumentoAutorizado::get();
                        return datatables()->of($model) 
                        ->addColumn('asociados', function($data){
                            return $data->SustentoTributario->nombre ?? '';
                        })  
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditDocumentoAutorizado('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteDocumentoAutorizado($(this));" class="btn btn-danger btn-circle DeleteDocumentoAutorizado"> <i class="fa fa-fw fa-times"></i></a>
                                </ul>
                            </div>';
                            $button .='</center>';
                            return $button;
                        })
                        ->rawColumns(['asociados','actions'])
                        ->make(true);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                // HistoricoFallos::create(['opcion'=>'DocumentoAutorizado CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete DocumentoAutorizado
        public function AdminDocumentoAutorizado(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New DocumentoAutorizado();
                    }elseif ($action == 'editar') { // Editar
                        $model = DocumentoAutorizado::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = DocumentoAutorizado::find($request->id);
                        $model->delete();
                        return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);

                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    if ( $request->codigo == Null) {
                        return response()->json(['message' => 'Debe asignar un código ', 'codigo'=>0], 200);
                    }

                    if ( $request->id_sustento_tributario == Null) {
                        return response()->json(['message' => 'Debe asignar un sustento tributario ', 'codigo'=>0], 200);
                    }

                    $model->codigo                 = $request->codigo;
                    $model->nombre                 = $request->nombre;
                    $model->id_sustento_tributario = $request->id_sustento_tributario;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);          
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' DocumentoAutorizado', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar DocumentoAutorizado #######

    // ####### ImportarXML #######
        public function ImportXML(Request $request){
            try {
                if (!file_exists($request->archivo)) {
                    return response()->json(['message' => 'Debe adjuntar un xml', 'codigo'=>0], 200);
                }
    
                $xmlFile = file_get_contents($request->archivo);
                $xmlFile = str_replace('<![CDATA[<?xml version="1.0" encoding="UTF-8"?>','',$xmlFile);
                $xmlFile = str_replace(']]>','',$xmlFile);
        
                $xml = new DOMDocument();
                $xml->loadXML($xmlFile);
                $xml = $this->xmlToObject($xml);

                // Cabeza
                $findRUC = Proveedores::where('documento',$xml->autorizacion->comprobante->factura->infoTributaria->ruc)->first();
                    $date = new \DateTime($xml->autorizacion->comprobante->factura->infoFactura->fechaEmision);
                    $dateFormat = $date->format('Y-d-m');
                $data = [
                    "cabeza" => [
                        "id_proveedor"    => (isset($findRUC)) ? $findRUC->id : '',
                        "proveedor"       => $xml->autorizacion->comprobante->factura->infoTributaria->razonSocial ?? '',
                        "rcu"             => $xml->autorizacion->comprobante->factura->infoTributaria->ruc ?? '',
                        "fecha"           => $dateFormat ?? '',
                        "NumComprobante1" => $xml->autorizacion->comprobante->factura->infoTributaria->estab ?? '',
                        "NumComprobante2" => $xml->autorizacion->comprobante->factura->infoTributaria->codDoc ?? '',
                        "NumComprobante3" => $xml->autorizacion->comprobante->factura->infoTributaria->secuencial ?? '',
                        "autorizacion"    => $xml->autorizacion->comprobante->factura->infoTributaria->claveAcceso ?? '',
                    ],
                    "detalles" => [],
                ];

                // Detalles
                $detailsXml = $xml->autorizacion->comprobante->factura->detalles->detalle ?? null;
                foreach ($detailsXml as $key => $detalle) {
                    $findProduc = Articulos::where('codigo',$detalle->codigoPrincipal)->first();
                    $data["detalles"][] = [
                        "codigo"         => $detalle->codigoPrincipal ?? '',
                        "nombre"         => $detalle->descripcion ?? '',
                        "cantidad"       => $detalle->cantidad ?? '',
                        "precio"         => $detalle->precioUnitario ?? '',
                        "iva"            => $detalle->impuestos->impuesto->tarifa ?? '',
                        "asocidao"       => (isset($findProduc)) ? 1 : 0,
                        "cod_local"      => $findProduc->nombre_factura ?? '',
                        "nombre_interno" => $findProduc->nombre ?? '',
                    ];
                }

                return response()->json(['message' => $data, 'codigo'=>200], 200);

            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>'IMPORTAR XML', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        protected function xmlToObject($root)
        {
            $regex = '/.:/';
            $dataXML = [];
    
            if ($root->hasAttributes()) {
                $attrs = $root->attributes;
    
                foreach ($attrs as $attr) {
                    $dataXML['_attributes'][$attr->name] = $attr->value;
                }
            }
    
            if ($root->hasChildNodes()) {
                $children = $root->childNodes;
    
                if (1 == $children->length) {
                    $child = $children->item(0);
    
                    if (XML_TEXT_NODE == $child->nodeType) {
                        $dataXML['_value'] = $child->nodeValue;
    
                        return 1 == count($dataXML) ? $dataXML['_value'] : $dataXML;
                    }
                }
    
                $groups = [];
    
                foreach ($children as $child) {
                    if (!isset($dataXML[preg_replace($regex, '', $child->nodeName)])) {
                        $dataXML[preg_replace($regex, '', $child->nodeName)] = $this->xmlToObject($child);
                    } else {
                        if (!isset($groups[preg_replace($regex, '', $child->nodeName)])) {
                            $dataXML[preg_replace($regex, '', $child->nodeName)] = array($dataXML[preg_replace($regex, '', $child->nodeName)]);
                            $groups[preg_replace($regex, '', $child->nodeName)] = 1;
                        }
    
                        $dataXML[preg_replace($regex, '', $child->nodeName)][] = $this->xmlToObject($child);
                    }
                }
            }
    
            return (object) $dataXML;
        }

    // ####### ImportarXML #######
}