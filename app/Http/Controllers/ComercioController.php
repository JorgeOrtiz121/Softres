<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

use App\Models\Dashboard\Empresas;
use App\Models\Dashboard\UsuariosEmpresas;

class ComercioController extends Controller
{
    // Función para buscar todas la empresas relacionadas al usuario autenticado
    public function login(){

        $EmpresasComercio = UsuariosEmpresas::where('usuario_id', Auth::user()->id)->where('estado', 1)->get();

        return view('Comercio.Preview', compact('EmpresasComercio'));

    }

    // Llenado tabla empresas comercio
    public function getPreview(){

        if(request()->ajax()){

            $empresas = UsuariosEmpresas::where('usuario_id', Auth::user()->id)->select('users_empresas.*');
            // dd($empresas);
            return datatables()->of($empresas)
            ->addColumn('restantes', function($data){
                return '<center>'.$data->empresas->vence($data->empresas->id).'</center>';

            })

            ->addColumn('identificacion', function($data){
                $identificacion = $data->empresas->identificacion;
                return $identificacion;
            })

            ->addColumn('nombre', function($data){
                $nombre = $data->empresas->razon_social;
                return $nombre;
            })

            ->addColumn('action', function($data){
                $button = '<center>
                <form name="empresa'.$data->id.'" id="empresa'.$data->empresas->id.'" action="'.asset('/panel').'" method="POST" >
                '.csrf_field().'
                    <input type="hidden" name="identificacion" value='.$data->empresas->id.'>
                    <input type="hidden" name="estado" value='.$data->empresas->estado.'>
                    <button type="submit"  class="btn btn-link" class="btn btn-link"><span title="Ingresar a la empresa" class="fa fa-fw fa-cog"></span></button>
                </form>
                ';
                $button .='</center>';
                return $button;
            })
            ->rawColumns(['identificacion','nombre','restantes','action'])
            ->make(true);
        }

    }

    // Validaciones previas a ingresar a la empresa
    public function preview(Request $request){

        if(request()->ajax()){

            // Buscar el id de la empresa
            $empresa = Empresas::find($request->identificacion);

            // Validamos si la empresa esta activa para ingresar
            if ($empresa->estado == 0) {
                return response()->json(['respuesta'=>1,'mensaje'=>'¡La empresa a la que intenta acceder no esta activa!']);

            }

            // Validamos si la empresa ya se vencio
            if ($empresa->vence($empresa->id) < 0) {
                return response()->json(['respuesta'=>2,'mensaje'=>$empresa->identificacion]);

            }else {
                // Sin problemas
                return response()->json(['respuesta'=>0,'mensaje'=>$empresa->id]);
            }
        }

    }

    // Función para cargar el panel dependiendo de la empresa seleccionada en la vista Preview
    public function panel(Request $request){

        $identificacion = $request->identificacion;

        // Retorno por el metodo POST
        if($identificacion != Null){

            // Buscar el id de la empresa
            $empresa = Empresas::find($identificacion);

            // Variable de sesion para cargar los datos de la empresa
            session($empresa->toArray());

            // // Buscar si el usuario autenticado esta relacionado a la empresa en la tabla UsuariosEmpresas
            // $id_emp = UsuariosEmpresas::where('usuario_id', Auth::user()->id)->where('empresa_id', session()->get('id'))->value('id');

            // // Busqueda del id del usuario en la tabla UsuariosEmpresas
            // $cargo = UsuariosEmpresas::find($id_emp);

            // if ($id_emp == Null) {
            //     // Si no lo encuentra en la tabla UsuariosEmpresas se busca en la tabla User
            //     $cargo2 = User::find( Auth::user()->id);
            // }

            // // Anadir nueva columna con el nombre del tipo de usuario a la variable de sesion segun el tipo de usuario logeado
            // if ($cargo != Null) {
            //     $nombre_cargo = $cargo->cargos->cargo;
            //     $cargo_id = $cargo->cargo_usuario_id;

            //     session(['nombre_cargo' => $nombre_cargo]);
            //     session(['tipo_usuario_id' => $cargo_id]);

            //     // return view('Comercio.Panel');

            // } else if($cargo2->cargo_id != Null) {
            //     $nombre_cargo = $cargo2->usercargos->cargo;
            //     $cargo_id = $cargo2->cargo_id;

            //     session(['nombre_cargo' => $nombre_cargo]);
            //     session(['tipo_usuario_id' => $cargo_id]);

            //     // return view('Comercio.Panel');
            // }

            // // Permisos de usuarios comercio
            // $permisos = CargosPermisosUsuariosComercio::where('cargo_id',session()->get('tipo_usuario_id'))
            // ->where('empresa_id', session()->get('id'))->get();

            // $n = 1;

            // foreach ($permisos as $key => $value) {
            //     session(['p'.$n++ => $value->permiso_id]);
            // }
            // return $request->session()->all();

            return view('Comercio.Panel');

        }else{
            // Retornar si se intenta acceder desde el metodo get
            return view('Comercio.Panel');
        }
    }

    // Vista Administracion
    public function comercio_administracion(){
        return view('Comercio.Administracion.administracion');
    }

    // Vista Inventario
    public function comercio_inventario(){
        return view('Comercio.Inventario.inventario');
    }
}
