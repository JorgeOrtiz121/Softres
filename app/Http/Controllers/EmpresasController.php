<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\User;

use App\Models\Dashboard\Empresas;
use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Ciudades;
use App\Models\Dashboard\TiposNegocios;
use App\Models\Dashboard\UsuariosEmpresas;
use App\Models\Dashboard\TipoRegimen;
use Illuminate\Database\Eloquent\Collection;

class EmpresasController extends Controller
{
    // Listado empresas
    public function index()
    {
        if (request()->ajax()) {
            $empresas = Empresas::select('empresas.*');
            return datatables()->of($empresas)
            ->addColumn('restantes', function ($data) {
                return '<center>'.$data->vence($data->id).'</center>';
            })
            ->addColumn('state', function ($data) {
                $estado = $data->estado == 0 ? 'Inactiva' : 'Activa';
                return $estado;
            })
            ->addColumn('entorno', function ($data) {
                return $entorno = $data->produccion == 0 ? 'Pruebas' : 'Producción';
            })
            ->addColumn('acciones', function ($data) {
                if ($data->estado == 1) {
                    $activacion_empresa = '<li><a href="javascript:void()" onclick="activarEmpresa('.$data->id.');" data-toggle="modal" data-target="#modal-activacion-'.$data->id.'" data-remote="false"  data-toggle="tooltip" title="Desactivar empresa"><i class="fa fa-fw fa-close"></i>Desactivar empresa</a></li>';
                } else {
                    $activacion_empresa = '<li><a href="javascript:void()" onclick="activarEmpresa('.$data->id.');" data-toggle="modal" data-target="#modal-activacion-'.$data->id.'" data-remote="false"  data-toggle="tooltip" title="Activar empresa"><i class="fa fa-fw fw fa-check"></i>Activar empresa</a></li>';
                }


                $button = '<center>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones </button>

                    <ul class="dropdown-menu">
                        <li>
                            <form name="form_administrar'.$data->id.'" id="form_administrar'.$data->id.'" action="'.asset('panel').'" method="POST" target="_blank">
                            '.csrf_field().'
                            <input type="hidden" name="identificacion" value='.$data->id.'>
                            </form>
                            <a href="javascript:void()" onclick="submitform('.$data->id.');" data-toggle="modal" data-remote="false"  data-toggle="tooltip" title="Ir a empresa"> <i class="fa fa-fw fa-cogs"></i>Ir a empresa</a>
                        </li>
                        <li><a href="javascript:void()" onclick="renovarEmpresa('.$data->id.');"  data-toggle="modal"  data-remote="false"  data-toggle="tooltip" title="Actualizar fecha de vencimiento"><i class="fa fa-fw fa-refresh"></i>Actualizar fecha vencimiento</a></li>
                        '.$activacion_empresa.'
                        <li><a href="'.asset('empresas/editar/'.$data->id).'"title="Editar empresa"><i class="fa fa-fw fa-pencil"></i>Editar empresa</a></li>
                        <li><a href="" data-toggle="modal" data-target="#modal-delete-'.$data->id.'" data-remote="false" id="'.$data->id.'" class="delete"  data-toggle="tooltip" title="Eliminar empresa"><i class="fa fa-fw fa-trash"></i>Eliminar empresa</a></li>

                    </ul>
                </div>';
                $button .='</center>';
                return $button;
            })
            ->rawColumns(['restantes','produccion','acciones'])
            ->make(true);
        }
        return view('Dashboard.Empresas.Listado');
    }

    // Crear empresas
    public function crear($id=null)
    {
        $TiposNegocios = TiposNegocios::get();
        $paises        = Paises::get();
        $provincias    = Provincias::get();
        $ciudades      = Ciudades::get();
        $TipoRegimen   = TipoRegimen::get();
        $empresa       = null; //Colección para función de modificar empresas
        $usuarios      = null; //Colección para función de modificar empresas
        //Buscamos la empresa en caso que sea para modificarla
        if ($id != null) {
            $empresa = Empresas::with('representante')->find($id);
            $usuarios = UsuariosEmpresas::where('empresa_id',$id)->with('users')->get();
            // dd($usuarios);
        }
        // dd($empresa);

        return view('Dashboard.Empresas.Crear', compact('TiposNegocios','paises','provincias','ciudades','TipoRegimen','empresa','usuarios'));
    }

    // - Crear nueva empresa
    public function empresa_create(Request $request)
    {

        // Validaciones
        $this->validate($request, [
            'tipo_negocio' => 'required',
            'empresa' => 'required',
            'razon_social' => 'required',
            'identificacion' => 'required',
            'representante' => 'required',
            'doc_representante' => 'required',
            'telefono' => 'required',
            // 'fax' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'pais' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
            // 'ruc_contador' => 'required',
            // 'resolucion' => 'required',
            'fecha_vencimiento' => 'required',
            'ambiente' => 'required',
            // 'artesano' => 'required',
            // 'contabilidad' => 'required',
            // 'TipoRegimen' => 'required',
            // 'reteiva' => 'required',
            // 'reterenta' => 'required',

        ],[
            'tipo_negocio.required' => 'El Tipo de negocio es requerido',
            'empresa.required' => 'El nombre de la empresa es requerido',
            'razon_social.required' => 'La razón social es requerido',
            'identificacion.required' => 'La identificación es requerido',
            'representante.required' => 'El nombre del representante es requerido',
            'doc_representante.required' => 'El ID del representante es requerido',
            'telefono.required' => 'El Teléfono es requerido',
            // 'fax.required' => 'El Fax es requerido',
            'email.required' => 'El Email es requerido',
            'direccion.required' => 'La Dirección es requerido',
            'pais.required' => 'El Pais es requerido',
            'provincia.required' => 'La Provincia es requerido',
            'ciudad.required' => 'La Ciudad es requerido',
            // 'ruc_contador.required' => 'El RUC contador es requerido',
            // 'resolucion.required' => 'LA resolución es requerido',
            'fecha_vencimiento.required' => 'LA fecha de vencimiento es requerido',
            'ambiente.required' => 'El ambiente es requerido',
            // 'artesano.required' => 'El  es requerido',
            // 'contabilidad.required' => 'El  es requerido',
            // 'TipoRegimen.required' => 'El  es requerido',
            // 'reteiva.required' => 'El  es requerido',
            // 'reterenta.required' => 'El  es requerido',

        ]);
        // dd($request->all());
        if (isset($request->id_empresa) && is_numeric($request->id_empresa)) {
            $this->editar_empresa($request);
            return response()->json(['codigo'=>1,"mensaje" => "¡Modificado exitosamente!"]);
        }
        try {
            if($request->ajax()){
                DB::beginTransaction();

                // Guardamos el nuevo usuario si no existe
                if (User::where('user', $request->doc_representante)->count() == 1) {
                    $usuario = User::where('user', $request->doc_representante)->first();

                }else {
                    $usuario = New User;
                        $usuario->user            = $request->doc_representante;
                        $usuario->name            = $request->representante;
                        $usuario->email           = $request->email;
                        $usuario->usuario_empresa = 1;
                        $usuario->cargo_id        = Null;
                        $usuario->password        = bcrypt($request->doc_representante);
                        $usuario->estado          = 1;
                    $usuario->save();
                }

                // Nombre de la base de datos para almacenar en la tabla empresas y crear el schema
                // $nombre_empresa = str_replace('-', '_',$request->tipo_negocio.'_'.$request->identificacion);
                $nombre_empresa = 'comercio_'.$request->identificacion;

                // Validar que sea unico
                if (Empresas::where('database', $nombre_empresa)->count() == 1) {
                    return response()->json(['codigo'=>0,'mensaje'=>'Fallo al crear empresa. <br> esta empresa ya se encuentra creada en el sistema']);
                }

                // Guardamos la nueva empresa
                $empresa = New Empresas;
                    $empresa->tipo_negocio      = $request->tipo_negocio;
                    $empresa->empresa           = $request->empresa;
                    $empresa->razon_social      = $request->razon_social;
                    $empresa->identificacion    = $request->identificacion;
                    $empresa->representante_id  = $usuario->id;
                    $empresa->telefono          = $request->telefono;
                    $empresa->fax               = $request->fax;
                    $empresa->email             = $request->email;
                    $empresa->direccion         = $request->direccion;
                    $empresa->pais_id           = $request->pais;
                    $empresa->provincia_id      = $request->provincia;
                    $empresa->ciudad_id         = $request->ciudad;
                    $empresa->resolucion        = $request->resolucion;
                    $empresa->fecha_vencimiento = $request->fecha_vencimiento;
                    $empresa->ambiente          = $request->ambiente;
                    $empresa->artesano          = $request->has('artesano');
                    $empresa->contabilidad      = $request->has('contabilidad');
                    $empresa->tipo_regimen_id   = $request->TipoRegimen;
                    $empresa->reteiva           = $request->has('reteiva');
                    $empresa->reterenta         = $request->has('reterenta');
                    $empresa->estado            = 1;
                    $empresa->database          = $nombre_empresa;

                $empresa->save();

                // Creamos la relacion del usuario con la empresa
                $user_empresa = New UsuariosEmpresas;
                    $user_empresa->usuario_id       = $usuario->id;
                    $user_empresa->empresa_id       = $empresa->id;
                    $user_empresa->cargo_usuario_id = Null;
                    $user_empresa->estado           = 1;
                    $user_empresa->user_id          = Auth::user()->id;
                $user_empresa->save();

                $this->createSchema($nombre_empresa);
                DB::commit();

                return response()->json(['codigo'=>1,"mensaje" => "Registrado exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al crear empresa. <br> '.$th.'']);

        }
    }

    public function editar_empresa($request){
        // dd($request);
        try{
            DB::beginTransaction();
            // Consultamos empresa a modificar
            $empresa = Empresas::find($request->id_empresa);
            $empresa->tipo_negocio      = $request->tipo_negocio;
            $empresa->empresa           = $request->empresa;
            $empresa->razon_social      = $request->razon_social;
            $empresa->identificacion    = $request->identificacion;
            // $empresa->representante_id  = $usuario->id;
            $empresa->telefono          = $request->telefono;
            $empresa->fax               = $request->fax;
            $empresa->email             = $request->email;
            $empresa->direccion         = $request->direccion;
            $empresa->pais_id           = $request->pais;
            $empresa->provincia_id      = $request->provincia;
            $empresa->ciudad_id         = $request->ciudad;
            $empresa->resolucion        = $request->resolucion;
            $empresa->fecha_vencimiento = $request->fecha_vencimiento;
            $empresa->ambiente          = $request->ambiente;
            $empresa->artesano          = $request->has('artesano');
            $empresa->contabilidad      = $request->has('contabilidad');
            $empresa->tipo_regimen_id   = $request->TipoRegimen;
            $empresa->reteiva           = $request->has('reteiva');
            $empresa->reterenta         = $request->has('reterenta');
            $empresa->estado            = 1;
            $empresa->save();
            DB::commit();
            return;

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al modificar empresa. <br> '.$th.'']);

        }
    }

    public function lista_ciudades($id){
        return Ciudades::where('provincia_id',$id)->get();
    }

    // Cracion de base de datos
    public function createSchema($schemaName)
    {
        // Crear DB
        DB::statement('CREATE DATABASE IF NOT EXISTS '.$schemaName.' DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci');

        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $schemaName);
        DB::reconnect('tenant');
        Schema::connection('tenant')->getConnection()->reconnect();
        Schema::connection('tenant');

        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('migrate --force --database=tenant --path=database/migrations/comercio');

        $config = \App::make('config');
        $connections = $config->get('database.connections');
        $defaultConnection = $connections[$config->get('database.default')];
        $config = \App::make('config'); // Listamos las conexiones DB
        $connection = $config->get('database.connections.tenant'); // Conectamos a tennat

    }
}
