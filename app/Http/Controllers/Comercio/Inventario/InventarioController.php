<?php

namespace App\Http\Controllers\Comercio\Inventario;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\DeducibleIR;
use App\Models\Dashboard\Empresas;
use App\Models\Dashboard\PorcentajesIVA;
use App\Models\Empresas\Articulos;
use App\Models\Empresas\CategoriaArticulo;
use App\Models\Dashboard\FabricacionArticulo;
use App\Models\Empresas\CaducidadArticulo;
use App\Models\Empresas\MarcaArticulo;
use App\Models\Empresas\PreciosVentaArticulo;
use App\Models\Empresas\PresentacionArticulo;
use App\Models\Empresas\TipoArticulo;
use App\Models\Empresas\UbicacionArticulo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Empresas\TipoIva;

class InventarioController extends Controller
{
    // Consulta de artículos
    public function articulos(){
        if( request()->ajax() ){
            $articulos = Articulos::get();
            // $articulos = Articulos::whit('presentacion')->get();
            return datatables()->of($articulos)
            ->addIndexColumn()
            ->addColumn('actions', function($data){
                $button = '<center>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                    <ul class="dropdown-menu">
                        <a href="'.asset('comercio/inventario/articulos/modificar/'.$data->id).'" title="Modificar Artículo" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                        <a onclick="modalEliminar('.$data->id.')" data-remote="false" title="Eliminar Artículo" class="btn btn-danger btn-circle "> <i class="fa fa-fw fa-times"></i></a>
                    </ul>
                </div>';
                $button .='</center>';
                return $button;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('Comercio.Inventario.articulos');
    }

    //Fomulario Crear Nuevo Artículo.
    public function nuevo_articulo(){
        // $porcentajes_iva = PorcentajesIVA::get();
        $TipoIva = TipoIva::get();
        $categorias      = CategoriaArticulo::get();
        $tipos           = TipoArticulo::get();
        $marcas          = MarcaArticulo::get();
        $fabricacion     = FabricacionArticulo::get();
        $presentaciones  = PresentacionArticulo::get();
        $deducible_ir    = DeducibleIR::get();

        return view('Comercio.Inventario.nuevo_articulo', compact('TipoIva','categorias','tipos','marcas','fabricacion','presentaciones','deducible_ir'));

    }

    public function guardar_articulo(Request $request){

        $database = Empresas::find(session()->get('id'))->database; //Buscamos el nombre de la BD para validar el código del producto.
        $this->validate($request, [
            'codigo' => 'required|unique:tenant.'.$database.'.articulos,codigo',
            'nombre' => 'required',
            'nombre_factura' => 'required'

        ], [
            'codigo.required' => 'Especifique el código del artículo.',
            'codigo.unique' => 'El Código ingresado se encuentra en uso',
            'nombre.required' => 'Especifique el nombre del artículo',
            'nombre_factura.required' => 'Especifique el nombre del artículo en la factura',
        ]);

        try {
            // dd($request->tabla_caducidad);
            if ($request->ajax()) {
                //En caso que sea modificación realizamos eliminaciones para volver a crearlas con la nueva información.
                if (isset($request->modificacion)) {
                    $articulo = Articulos::find($request->modificacion);
                    PreciosVentaArticulo::where('id_articulo',$articulo->id)->delete();
                    CaducidadArticulo::where('id_articulo',$articulo->id)->delete();
                    if ($articulo->id_ubicacion != null) {
                        $ubicacion = UbicacionArticulo::find($articulo->id_ubicacion);
                        $articulo->id_ubicacion = null;
                        $articulo->save();
                        $ubicacion->delete();
                    }

                }else{
                    $articulo = New Articulos();
                }
                $articulo->fill($request->all());
                $articulo->precio_compra_sin_iva = str_replace(",","",$articulo->precio_compra_sin_iva);
                $articulo->precio_compra_con_iva = str_replace(",","",$articulo->precio_compra_con_iva);
                $articulo->venta_restringida     = isset($request->venta_restringida) ? 1 : 0;
                $articulo->vehiculo              = isset($request->vehiculo) ? 1 : 0;
                $articulo->save();

                //Creamos los precios del artículo
                if(isset($request->tabla_precios) && $request->tabla_precios != null){
                    $precios = json_decode($request->tabla_precios);
                    foreach ($precios as $precio){
                        $precios_articulo = New PreciosVentaArticulo();
                        $precios_articulo->id_articulo    = $articulo->id;
                        $precios_articulo->precio_con_iva = str_replace(",","",$precio->precio_venta_con_iva);
                        $precios_articulo->utilidad       = str_replace(",","",$precio->utilidad);
                        $precios_articulo->ganancia       = str_replace(",","",$precio->ganancia);
                        $precios_articulo->save();
                    }
                }

                // Creacmos la ubicación del artículo
                $ubicacion = new Collection();
                if ($request->estante != null || $request->lado != null || $request->fila != null || $request->columna != null || $request->adicional != null) {
                    $ubicacion = UbicacionArticulo::create(['estante'=>$request->estante,
                                                            'lado'=>$request->lado,
                                                            'fila'=>$request->fila,
                                                            'columna'=>$request->columna,
                                                            'adicional'=>$request->adicional]);
                    //Asignamos la ubicación al artículo
                    $articulo->id_ubicacion = $ubicacion->id;
                    $articulo->save();
                }

                // Crear caducidad del artículo
                if($request->tabla_caducidad != "null"){
                    $caducidades = json_decode($request->tabla_caducidad);
                    foreach($caducidades as $caducidad){
                        $caducidad_articulo = CaducidadArticulo::create(['id_articulo'=>$articulo->id,
                                                                        'dias_notificacion'=>$request->dias_notificacion,
                                                                        'cantidad'=>$caducidad->cantidad,
                                                                        'fecha_caducidad'=>$caducidad->fecha_caducidad,
                                                                        'lote'=>$caducidad->lote]);
                    }
                }

                if(isset($request->modificacion)){
                    return ["respuesta"=>1,"mensaje"=>'¡Artículo editado de forma correcta!'];
                }else {
                    return ["respuesta"=>1,"mensaje"=>'Artículo creado de forma correcta'];
                }
            }
        } catch (\Throwable $th) {
            // dd($th);
            if(isset($request->modificacion)){
                return ["respuesta"=>0,"mensaje"=>'Se produjo un fallo interno al editar el Artículo '.$th.''];
            } else {
                return ["respuesta"=>0,"mensaje"=>'Se produjo un fallo interno al crear el Artículo '.$th.''];
            }
        }
    }

    public function modificar_articulo($id){
        $articulo = Articulos::with('categorias','tipos','marcas','porcentajes_iva','presentacion','ubicacion','deducible_ir')->find($id);
        // $articulo = Articulos::where('id',$id)->with('categorias','tipos','marcas','porcentajes_iva','presentacion','ubicacion','deducible_ir')->first();
        $precios_venta   = PreciosVentaArticulo::where('id_articulo',$id)->get();
        $caducidades     = CaducidadArticulo::where('id_articulo',$id)->get();
        $porcentajes_iva = PorcentajesIVA::get();
        $categorias      = CategoriaArticulo::get();
        $tipos           = TipoArticulo::get();
        $marcas          = MarcaArticulo::get();
        $fabricacion     = FabricacionArticulo::get();
        $presentaciones  = PresentacionArticulo::get();
        $deducible_ir    = DeducibleIR::get();
        $modificacion    = $id;
        $TipoIva = TipoIva::get();
        // dd(($caducidades->count()));

        return view('Comercio.Inventario.nuevo_articulo', compact('TipoIva','modificacion','articulo','porcentajes_iva','categorias','caducidades','precios_venta','tipos','marcas','fabricacion','presentaciones','deducible_ir'));
    }

    public function eliminar_articulo(Request $request){
        // dd($request->all());
        try {
            $articulo = Articulos::find($request->id_articulo);
            // $ubicacion = UbicacionArticulo::find($articulo->id_ubicacion);
            // dd($ubicacion);
            PreciosVentaArticulo::where('id_articulo',$articulo->id)->delete();
            CaducidadArticulo::where('id_articulo',$articulo->id)->delete();
            if ($articulo->id_ubicacion != null) {
                $ubicacion = UbicacionArticulo::find($articulo->id_ubicacion);
                $articulo->id_ubicacion = null;
                $articulo->save();
                $ubicacion->delete();
            }
            $articulo->delete();
            return ["respuesta"=>1,
                    "mensaje"=>'¡Artículo eliminado con éxito!'];

        } catch (\Throwable $th) {
            return ["respuesta"=>0,
                    "errors"=>'¡Error al eliminar el Artículo!'];
        }


    }

    //Validar si ya existe el código del articulo
    public function validar_codigo($cod)
    {
        $codigo = Articulos::where('codigo', $cod)->first();
        if ($codigo) {
            return ['mensaje'=>'<i class="warning fa fa-close"></i> El código ya existe','state'=>'0','datos'=>$codigo];
        } else {
            return ['mensaje'=>'<i class="success fa fa-check"></i> El código no existe','state'=>'1'];
        }
    }

    // Vista Clasificadores.
    public function clasificadores(){
        return view('Comercio.Inventario.clasificadores');
    }

    ################ CATEGORIAS ##################
    // Vista de lista de las categorías creadas e inputs para crear nueva categoría.
    public function categorias_articulos(){
        if( request()->ajax() ){
            $categorias = CategoriaArticulo::get();
            return datatables()->of($categorias)
            ->addIndexColumn()
            ->addColumn('acciones', function($data){
                $button ='<center>';
                    $button .= '
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Menú
                        <ul class="dropdown-menu" style="font-size: 12pt; color:grey">
                            <li><a onclick="modalEditar('.$data->id.','.'\''.$data->nombre.'\''.')" title="Editar categoría" class="fa fa-fw fa-edit" >Editar categoría</a></li>
                            <li><a onclick="modalEliminar('.$data->id.')" data-remote="false" title="Eliminar categoría" class="fa fa-trash-o"> Eliminar categoría</a></li>
                        </ul></button>
                    </div>';
                    $button .='</center>';
                return $button;
            })
            ->rawColumns(['acciones'])
            ->make(true);
        }
        return view('Comercio.Inventario.categorias');

    }

    // CREAR LAS CATEGORÍAS
    public function crear_categoria(Request $request){
        try {
            $categoria = New CategoriaArticulo();
            $categoria->nombre = $request->nombre_categoria;
            $categoria->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Categoría creada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al crear la categoría!'];
        }
    }

    // MODIFICAR LAS CATEGORÍAS
    public function modificar_categoria(Request $request){
        try {
            $categoria = CategoriaArticulo::find($request->id_categoria);
            $categoria->nombre = $request->nombre_categoria;
            $categoria->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Categoría modificada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al modificar la categoría!'];
        }
    }

    // ELIMINAR LAS CATEGORÍAS
    public function eliminar_categoria(Request $request){
        try {
            $categoria = CategoriaArticulo::find($request->id_categoria);
            $categoria->delete();

            return ["respuesta"=>1,
            "mensaje"=>'¡Categoría eliminada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al eliminar la categoría!'];
        }
    }

    ################ TIPOS ##################
    // Vista de lista de los tipos creados e inputs para crear nuevos tipos.
    public function tipos_articulos(){
        if( request()->ajax() ){
            $tipos = TipoArticulo::get();
            // dd($tipos);
            return datatables()->of($tipos)
            ->addIndexColumn()
            ->addColumn('acciones', function($data){
                $button ='<center>';
                    $button .= '
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Menú
                        <ul class="dropdown-menu" style="font-size: 12pt; color:grey">
                            <li><a onclick="modalEditar('.$data->id.','.'\''.$data->nombre.'\''.')" title="Editar tipo" class="fa fa-fw fa-edit" >Editar tipo</a></li>
                            <li><a onclick="modalEliminar('.$data->id.')" data-remote="false" title="Eliminar tipo" class="fa fa-trash-o"> Eliminar tipo</a></li>
                        </ul></button>
                    </div>';
                    $button .='</center>';
                return $button;
            })
            ->rawColumns(['acciones'])
            ->make(true);
        }
        // dd('hola');
        return view('Comercio.Inventario.tipos');
    }

    // CREAR LOS TIPOS
    public function crear_tipo(Request $request){
        try {
            $tipo = New TipoArticulo();
            $tipo->nombre = $request->nombre_tipo;
            $tipo->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Tipo creado con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al crear el tipo!'];
        }
    }

    // MODIFICAR LOS TIPOS
    public function modificar_tipo(Request $request){
        try {
            // dd($request->all());
            $tipo = TipoArticulo::find($request->id_tipo);
            $tipo->nombre = $request->nombre_tipo;
            $tipo->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Tipo modificado con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al modificar el tipo!'];
        }
    }

    // ELIMINAR LOS TIPOS
    public function eliminar_tipo(Request $request){
        try {
            $tipo = TipoArticulo::find($request->id_tipo);
            $tipo->delete();

            return ["respuesta"=>1,
            "mensaje"=>'¡Tipo eliminado con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al eliminar el tipo!'];
        }
    }


    ################ MARCAS ##################
    // Vista de lista de las marcas creadas e inputs para crear nuevas marcas.
    public function marcas_articulos(){
        if( request()->ajax() ){
            $marcas = MarcaArticulo::get();
            // dd($marcas);
            return datatables()->of($marcas)
            ->addIndexColumn()
            ->addColumn('acciones', function($data){
                $button ='<center>';
                    $button .= '
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Menú
                        <ul class="dropdown-menu" style="font-size: 12pt; color:grey">
                            <li><a onclick="modalEditar('.$data->id.','.'\''.$data->nombre.'\''.')" title="Editar Marca" class="fa fa-fw fa-edit" >Editar Marca</a></li>
                            <li><a onclick="modalEliminar('.$data->id.')" data-remote="false" title="Eliminar Marca" class="fa fa-trash-o"> Eliminar Marca</a></li>
                        </ul></button>
                    </div>';
                    $button .='</center>';
                return $button;
            })
            ->rawColumns(['acciones'])
            ->make(true);
        }
        // dd('hola');
        return view('Comercio.Inventario.marcas');
    }

    // CREAR LAS MARCAS
    public function crear_marca(Request $request){
        try {
            $marca = New MarcaArticulo();
            $marca->nombre = $request->nombre_marca;
            $marca->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Marca creada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al crear la marca!'];
        }
    }

    // MODIFICAR LAS MARCAS
    public function modificar_marca(Request $request){
        try {
            $marca = MarcaArticulo::find($request->id_marca);
            $marca->nombre = $request->nombre_marca;
            $marca->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Marca modificada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al modificar la marca!'];
        }
    }

    // ELIMINAR LAS MARCAS
    public function eliminar_marca(Request $request){
        try {
            $marca = MarcaArticulo::find($request->id_marca);
            $marca->delete();

            return ["respuesta"=>1,
            "mensaje"=>'¡Marca eliminada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al eliminar la marca!'];
        }
    }

     ################ PRESENTACIONES ##################
    // Vista de lista de las presentaciones creadas e inputs para crear nuevas presentacion.
    public function presentaciones_articulos(){
        if( request()->ajax() ){
            $presentacion = PresentacionArticulo::get();
            // dd($presentacion);
            return datatables()->of($presentacion)
            ->addIndexColumn()
            ->addColumn('acciones', function($data){
                $button ='<center>';
                    $button .= '
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Menú
                        <ul class="dropdown-menu" style="font-size: 12pt; color:grey">
                            <li><a onclick="modalEditar('.$data->id.','.'\''.$data->nombre.'\''.','.'\''.$data->abreviatura.'\''.')" title="Editar Presentación" class="fa fa-fw fa-edit" >Editar Presentación</a></li>
                            <li><a onclick="modalEliminar('.$data->id.')" data-remote="false" title="Eliminar Presentación" class="fa fa-trash-o"> Eliminar Presentación</a></li>
                        </ul></button>
                    </div>';
                    $button .='</center>';
                return $button;
            })
            ->rawColumns(['acciones'])
            ->make(true);
        }
        // dd('hola');
        return view('Comercio.Inventario.presentaciones');
    }

    // CREAR LAS PRESENTACIONES
    public function crear_presentacion(Request $request){
        try {
            $presentacion = New PresentacionArticulo();
            $presentacion->nombre = $request->nombre_presentacion;
            $presentacion->abreviatura = $request->abreviatura_presentacion;
            $presentacion->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Presentación creada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al crear la presentación!'];
        }
    }

    // MODIFICAR LAS PRESENTACIONES
    public function modificar_presentacion(Request $request){
        try {
            // dd($request->all());
            $presentacion = PresentacionArticulo::find($request->id_presentacion);
            $presentacion->abreviatura = $request->abreviatura_presentacion;
            $presentacion->nombre = $request->nombre_presentacion;
            $presentacion->save();

            return ["respuesta"=>1,
            "mensaje"=>'¡Presentación modificada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al modificar la Presentación!'];
        }
    }

    // ELIMINAR LAS PRESENTACIONES
    public function eliminar_presentacion(Request $request){
        try {
            $presentacion = PresentacionArticulo::find($request->id_presentacion);
            $presentacion->delete();

            return ["respuesta"=>1,
            "mensaje"=>'¡Presentacion eliminada con éxito!'];

        } catch (\Throwable $th) {
            // dd($th);
            return ["respuesta"=>0,
                    "errors"=>'¡Error al eliminar la Presentacion!'];
        }
    }

    // ####### Gestionar Iva #######
        // Index
        public function GetIva(Request $request){
            try {
                if(request()->ajax()){
                    if ($request->option == 'unico' &&  isset($request->id) ) { // Consulta un unico registro
                        $model = TipoIva::find($request->id);
                        return response()->json(['data' => $model, 'codigo'=>200], 200);
                    }  elseif ($request->option == 'select' && !isset($request->id)) { // Cargar datos para el select
                        $model = TipoIva::get();
                        return $model;
                    } else { // Llenar la tabla
                        $model = TipoIva::get();
                        return datatables()->of($model) 
                        ->addColumn('actions', function($data){
                            $button = '<center>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>
                                <ul class="dropdown-menu">
                                    <a href="#" data-toggle="tooltip" title="Editar" onclick="EditIva('.$data->id.');" class="btn btn-warning btn-circle"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Eliminar" id="'.$data->id.'" data="'.$data->nombre.'" onclick="DeleteIva($(this));" class="btn btn-danger btn-circle DeleteIva"> <i class="fa fa-fw fa-times"></i></a>
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
                // HistoricoFallos::create(['opcion'=>'IVA CARGAR', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }

        // Store-Update-Delete Iva
        public function AdminIva(Request $request){
            try {

                if ($request->ajax()) {
                    $action = strtolower($request->action);
                    $type = ($action == 'crear') ? 'Creó' : (($action == 'editar') ? 'Editó' :  (($action == 'eliminar') ? 'eliminó': '' ));

                    if ($action == 'crear') { // Crear
                        $model = New TipoIva();
                    }elseif ($action == 'editar') { // Editar
                        $model = TipoIva::find($request->id);
                    }elseif ($action == 'eliminar') { // Eliminar
                        $model = TipoIva::find($request->id);
                        $childrenModel = Articulos::where('id_iva',$model->id)->get();

                        if (count($childrenModel) > 0) {
                            return response()->json(['message' => 'No se puede eliminar el IVA porque está asociada a otros articulos', 'codigo'=>0], 200);
                        } else {
                            $model->delete();
                            return response()->json(['message' => 'Se '.$type.' el registro de forma correcta', 'codigo'=>200], 200);
                        }
                    }else { // No valido
                        return response()->json(['message' => 'Petición invalida', 'codigo'=>0], 500);
                    }

                    $model->porcentaje      = $request->porcentaje;
                    // dd($model);

                    $model->save();

                    return response()->json(['message' => 'Se '. $type .' el registro de forma correcta', 'codigo'=>200], 200);           
                }
            } catch (\Throwable $th) {
                dd($th);
                HistoricoFallos::create(['opcion'=>' '.strtoupper($request->action).' IVA', 'error'=>$th->getMessage(), 'descripcion'=>$th, 'usuario_id'=>Auth::user()->id ?? Null ]);
                return ['codigo'=>0,'mensaje'=>'No se pudo ejecutar la acción por un fallo interno.'];
            }
        }
    // ####### Gestionar Iva #######
}
