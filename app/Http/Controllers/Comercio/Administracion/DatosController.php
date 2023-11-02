<?php

namespace App\Http\Controllers\Comercio\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Models\Dashboard\TiposNegocios;
use App\Models\Dashboard\Empresas;
use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\Ciudades;
use App\Models\Dashboard\UsuariosEmpresas;
use App\Models\Dashboard\TipoRegimen;

class DatosController extends Controller
{
    // Vista datos de la empresa
    public function datos(){
        $TiposNegocios = TiposNegocios::get();
        $empresa       = Empresas::find(session()->get('id'));
        $paises        = Paises::get();
        $provincias    = Provincias::get();
        $ciudades      = Ciudades::get();
        $usuarios      = UsuariosEmpresas::where('empresa_id',session()->get('id'))->get();
        $TipoRegimen   = TipoRegimen::get();
 
        return view('Comercio.Administracion.Datos.general', compact('empresa','TiposNegocios','paises','provincias','ciudades','usuarios','TipoRegimen'));

    }

    // - Editar datos empresa
    public function empresa_edit(Request $request)
    {

        // Validaciones
        $this->validate($request, [
            'tipo_negocio' => 'required',
            'empresa' => 'required',
            'razon_social' => 'required',
            'telefono' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'pais' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
            // 'ruc_contador' => 'required',
            'resolucion' => 'required',
            'fecha_vencimiento' => 'required',
            'ambiente' => 'required',
            // 'artesano' => 'required',
            // 'contabilidad' => 'required',
            // 'microempresa' => 'required',
            // 'reteiva' => 'required',
            // 'reterenta' => 'required',

        ],[
            'tipo_negocio.required' => 'El Tipo de negocio es requerido',
            'empresa.required' => 'El nombre de la empresa es requerido',
            'razon_social.required' => 'La razón social es requerido',
            'telefono.required' => 'El Teléfono es requerido',
            'fax.required' => 'El Fax es requerido',
            'email.required' => 'El Email es requerido',
            'direccion.required' => 'La Dirección es requerido',
            'pais.required' => 'El Pais es requerido',
            'provincia.required' => 'La Provincia es requerido',
            'ciudad.required' => 'La Ciudad es requerido',
            // 'ruc_contador.required' => 'El RUC contador es requerido',
            'resolucion.required' => 'La resolución es requerido',
            'fecha_vencimiento.required' => 'LA fecha de vencimiento es requerido',
            'ambiente.required' => 'El ambiente es requerido',
            // 'artesano.required' => 'El  es requerido',
            // 'contabilidad.required' => 'El  es requerido',
            // 'microempresa.required' => 'El  es requerido',
            // 'reteiva.required' => 'El  es requerido',
            // 'reterenta.required' => 'El  es requerido',

        ]);

        try {
            if($request->ajax()){
                DB::beginTransaction();
                // dd($request->all());

                // Guardamos la nueva empresa
                $empresa = Empresas::find(session()->get('id'));
                    $empresa->tipo_negocio      = $request->tipo_negocio;
                    $empresa->empresa           = $request->empresa;
                    $empresa->razon_social      = $request->razon_social;
                    // $empresa->identificacion    = $request->identificacion;
                    // $empresa->representante     = $request->representante;
                    $empresa->telefono          = $request->telefono;
                    $empresa->fax               = $request->fax;
                    $empresa->email             = $request->email;
                    $empresa->direccion         = $request->direccion;
                    $empresa->pais_id           = $request->pais;
                    $empresa->provincia_id      = $request->provincia;
                    $empresa->ciudad_id         = $request->ciudad;
                    $empresa->resolucion        = $request->resolucion;
                    $empresa->fecha_vencimiento = $request->fecha_vencimiento;
                    $empresa->ruc_contador      = $request->ruc_contador;
                    $empresa->ambiente          = $request->ambiente;
                    $empresa->artesano          = $request->has('artesano');
                    $empresa->contabilidad      = $request->has('contabilidad');
                    $empresa->tipo_regimen_id   = $request->TipoRegimen;
                    $empresa->reteiva           = $request->has('reteiva');
                    $empresa->reterenta         = $request->has('reterenta');

                $empresa->save();

                DB::commit();
                return response()->json(['codigo'=>1,"mensaje" => "exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al editar datos. <br> '.$th.'']);

        }
    }
}
