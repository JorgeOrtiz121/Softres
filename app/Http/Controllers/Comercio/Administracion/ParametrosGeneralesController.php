<?php

namespace App\Http\Controllers\Comercio\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;

use App\Models\Dashboard\Paises;
use App\Models\Dashboard\Empresas;
use App\Models\Dashboard\Ciudades;
use App\Models\Dashboard\Provincias;
use App\Models\Dashboard\TiposNegocios;
use App\Models\Dashboard\UsuariosEmpresas;
use App\Models\Dashboard\TipoServidorMail;
use App\Models\Dashboard\TiposComprobantes;
use App\Models\Dashboard\ParametrosGeneralesAdmin;

use App\Models\Empresas\Articulos;
use App\Models\Empresas\Comprobantes;
use App\Models\Empresas\Predeterminados;
use App\Models\Empresas\ParametrosGenerales;
use App\Models\Empresas\ParametrosImpresiones;
use App\Models\Empresas\GeneralesFacturacionElectronica;
use Illuminate\Support\Facades\Config;

class ParametrosGeneralesController extends Controller
{

    // Vista
    public function parametros(){
        $TiposComprobantes = TiposComprobantes::get();
        $comprobantes = Comprobantes::get();
        $generalesAdmin = ParametrosGeneralesAdmin::get();
        foreach ($generalesAdmin as $key => $value) {
            $generalesEmpresa = ParametrosGenerales::where('nombre_id',$value->id)->value('id');
            if($generalesEmpresa == Null){
                $generalesEmpresaC = New ParametrosGenerales;
                $generalesEmpresaC->nombre_id = $value->id;
                $generalesEmpresaC->save();
            }
        }
        $generalesEmpresa = ParametrosGenerales::get();
        $ConfigDocPredeterminados = Predeterminados::find(1);
        if ($ConfigDocPredeterminados == Null) {
            Predeterminados::create(['facturas_id'=>Null,'retenciones_id'=>Null,'nota_credito_id'=>Null,'guias_id'=>Null,'liq_compra_id'=>Null]);
            $ConfigDocPredeterminados = Predeterminados::find(1);
        }
        $FacturacionElectronica3 = GeneralesFacturacionElectronica::find(1);
        if ($FacturacionElectronica3 == Null) {
            GeneralesFacturacionElectronica::create(['facturas_cbte_venta'=>0,'retencion_compras'=>0,'guias_remision'=>0,'notas_credito'=>0,'decimales_factura'=>0]);
            $FacturacionElectronica3 = Predeterminados::find(1);
        }
        $TipoServidorMail = TipoServidorMail::get();

        $dataArticulos = Articulos::select('articulos.id',DB::raw('COUNT(precios_venta_articulo.id_articulo) AS total'))
                                    ->join('precios_venta_articulo', 'articulos.id', '=', 'precios_venta_articulo.id_articulo')
                                    ->groupBy('articulos.id')
                                    ->orderBy('total', 'asc')
                                    ->get()->last();
        $preciosVenta = ($dataArticulos) ? $dataArticulos->total: 0;

        return view('Comercio.Administracion.ParametrosGenerales.general', compact('preciosVenta','TipoServidorMail','ConfigDocPredeterminados','TiposComprobantes','comprobantes','generalesEmpresa','FacturacionElectronica3'));
    }

    // Consultar Series
    public function consultarSeries($id){
        $comprobantes = Comprobantes::where('comprobante_id', $id)->get();
        return $comprobantes;
    }

    // Pestaña Configuracion de impresoras
    // Llenado tabla configuracion de impresoras
    public function GetImpresiones(){
        if (request()->ajax()) {
            $generalesImpresoras = ParametrosImpresiones::with('comprobantes.comprobantes')->get();
            return datatables()->of($generalesImpresoras)
            ->addColumn('tipocbte', function($data){
                $tipocbte = ($data->comprobante_id != Null) ? $data->comprobantes->comprobantes->nombre:'';
                return $tipocbte;
            })
            ->addColumn('serie', function($data){
                $serie = ($data->comprobante_id != Null) ? $data->comprobantes->num_serie1.' - '.$data->comprobantes->num_serie2:'';
                return $serie;
            })
            ->addColumn('diseñoUsar', function($data){
                $diseñoUsar = 'Select';
                return $diseñoUsar;
            })
            ->addColumn('impresoraUsar', function($data){
                $impresoraUsar = 'Select';
                return $impresoraUsar;
            })
            ->addColumn('copiasEn1', function($data){
                $copiasEn1 = ($data->copias_hoja != Null) ? 'SI':'NO';
                return $copiasEn1;
            })
            ->addColumn('FeRide', function($data){
                $FeRide = ($data->fe_ride != Null) ? 'SI':'NO';
                return $FeRide;
            })
            ->addColumn('rideCompleto', function($data){
                $rideCompleto = ($data->nombre_completo != Null) ? 'SI':'NO';
                return $rideCompleto;
            })
            ->addColumn('acciones', function($data){
                $button = '<center>
                    <a href="" data-toggle="modal" data-target="#myModalEditarImpresiones" data-remote="false" id="'.$data->id.'"  onclick = "add2(this);" class="btn btn-warning btn-circle editarImpresiones" data-toggle="tooltip" title="Editar registro">
                        <i class="fa fa-fw fa-pencil"></i>
                    </a>';
                $button .= ' </center>';

                return $button;
            })
            ->rawColumns(['tipocbte','serie','diseñoUsar','impresoraUsar','margen_sup','margen_izq','n_copias','copiasEn1','FeRide','rideCompleto','acciones'])
            ->make(true);
        }
    }

    // Crear
    public function config_impresoras_create(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            'comprobanteImpresion' => 'required',
            'series' => 'required',
            // 'diseño' => 'required',
        ],[
            'comprobanteImpresion.required' => 'El Tipo de comprobante es requerido',
            'series.required' => 'La serie es requerido',
            // 'diseño.required' => 'El Diseño de serie es requerido',
        ]);

        try {
            if($request->ajax()){
                DB::beginTransaction();
                $impresora = New ParametrosImpresiones;
                    $impresora->comprobante_id =  $request->series;
                    $impresora->diseño =          $request->diseño;
                    $impresora->impresora =       $request->impresora;
                    $impresora->margen_sup =      $request->margen_sup;
                    $impresora->margen_izq =      $request->margen_izq;
                    $impresora->n_copias =        $request->n_copias;
                    $impresora->copias_hoja =     $request->has('copias_hoja');
                    $impresora->fe_ride =         $request->has('fe_ride');
                    $impresora->nombre_completo = $request->has('nombre_completo');
                $impresora->save();

                DB::commit();
                return response()->json(['codigo'=>1,"mensaje" => "Registrado exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al crear Configuración de impresoras. <br> '.$th.'']);
        }
    }

    // ModalEditar
    public function config_impresoras_editar($id){
        $data = ParametrosImpresiones::find($id);
        $TiposComprobantes = TiposComprobantes::get();
        $series = Comprobantes::where('comprobante_id', $data->comprobantes->comprobantes->id)->get();

        return response()->json([
            'TiposComprobantes' => $TiposComprobantes,
            'seriesCbte'        => $series,
            'impresora_id'      => $data->impresora_id,
            'comprobante'       => $data->comprobantes->comprobantes->id,
            'series'            => $data->comprobantes->id,
            'diseño'            => $data->diseño,
            'impresora'         => $data->impresora,
            'margen_sup'        => $data->margen_sup,
            'margen_izq'        => $data->margen_izq,
            'n_copias'          => $data->n_copias,
            'copias_hoja'       => $data->copias_hoja,
            'fe_ride'           => $data->fe_ride,
            'nombre_completo'   => $data->nombre_completo,
            'id'                => $data->id,
        ]);
    }

    // Editar
    public function config_impresoras_edit(Request $request)
    {
       // Validaciones
       $this->validate($request, [
        'comprobanteImpresion2' => 'required',
        'series2' => 'required',
        // 'diseño2' => 'required',
        ],[
            'comprobanteImpresion2.required' => 'El Tipo de comprobante es requerido',
            'series2.required' => 'La serie es requerido',
            // 'diseño2.required' => 'El Diseño de serie es requerido',
        ]);

        try {
            if($request->ajax()){
                DB::beginTransaction();
                $impresora = ParametrosImpresiones::find($request->impresionesId);
                    $impresora->comprobante_id =  $request->series2;
                    $impresora->diseño =          $request->diseño2;
                    $impresora->impresora =       $request->impresora2;
                    $impresora->margen_sup =      $request->margen_sup2;
                    $impresora->margen_izq =      $request->margen_izq2;
                    $impresora->n_copias =        $request->n_copias2;
                    $impresora->copias_hoja =     $request->has('copias_hoja2');
                    $impresora->fe_ride =         $request->has('fe_ride2');
                    $impresora->nombre_completo = $request->has('nombre_completo2');
                $impresora->save();

                DB::commit();
                return response()->json(['codigo'=>1,"mensaje" => "exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al editar Configuración de impresora. <br> '.$th.'']);
        }
    }
    // Fin pestaña Configuracion de impresora

    // Pestaña Configuracion de documentos
    // Llenado tabla configuracion de documentos
    public function GetDocumentos(){
        if (request()->ajax()) {
            $comprobantes = Comprobantes::with('comprobantes')->get();

            return datatables()->of($comprobantes)
            ->addColumn('acciones', function($data){
                $button = '<center>
                    <a href="" data-toggle="modal" data-target="#myModalEditar1" data-remote="false" id="'.$data->id.'"  onclick = "add(this);" class="btn btn-warning btn-circle editar1" data-toggle="tooltip" title="Editar registro">
                        <i class="fa fa-fw fa-pencil"></i>
                    </a>';
                $button .= ' </center>';

                return $button;
            })
            ->rawColumns(['acciones'])
            ->make(true);
        }
    }

    // Crear
    public function config_docs_create(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            'comprobante' => 'required',
            'numSerie1' => 'required',
            'numSerie2' => 'required',
            'tipo_comprobante' => 'required',
        ],[
            'comprobante.required' => 'El Comprobante es requerido',
            'numSerie1.required' => 'El Número de serie es requerido',
            'numSerie2.required' => 'El Número de serie es requerido',
            'tipo_comprobante.required' => 'El Tipo de comprobante es requerido',
        ]);

        try {
            if($request->ajax()){
                DB::beginTransaction();
                $comprobante = New Comprobantes;
                    $comprobante->comprobante_id = $request->comprobante;
                    $comprobante->num_serie1 = $request->numSerie1;
                    $comprobante->num_serie2 = $request->numSerie2;
                    $comprobante->tipo_comprobante = $request->tipo_comprobante;
                    if ($request->tipo_comprobante == 1) {
                        $comprobante->autorizacion_sri = $request->autorizacionSRI;
                        $comprobante->ultimo_num = $request->ultimoNum;
                        $comprobante->fecha_caducidad = $request->fechaCaducidad;
                    }
                $comprobante->save();

                DB::commit();
                return response()->json(['codigo'=>1,"mensaje" => "Registrado exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al crear Configuración de documentos. <br> '.$th.'']);

        }
    }

    // ModalEditar
    public function config_docs_editar($id){
        $doc = Comprobantes::find($id);
        $TiposComprobantes = TiposComprobantes::get();

        return response()->json([
            'comprobantes'     => $TiposComprobantes,
            'comprobante'      => $doc->comprobante_id,
            'numSerie1'        => $doc->num_serie1,
            'numSerie2'        => $doc->num_serie2,
            'tipo_comprobante' => $doc->tipo_comprobante,
            'autorizacion_sri' => $doc->autorizacion_sri,
            'ultimo_num'       => $doc->ultimo_num,
            'fecha_caducidad'  => $doc->fecha_caducidad,
            'id'               => $doc->id,
        ]);
    }

    // Editar
    public function config_docs_edit(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            'comprobante2' => 'required',
            'numSerie12' => 'required',
            'numSerie22' => 'required',
            'tipo_comprobante2' => 'required',
        ],[
            'comprobante2.required' => 'El Comprobante es requerido',
            'numSerie12.required' => 'El Número de serie es requerido',
            'numSerie22.required' => 'El Número de serie es requerido',
            'tipo_comprobante2.required' => 'El Tipo de comprobante es requerido',
        ]);

        try {
            if($request->ajax()){
                DB::beginTransaction();
                $comprobante = Comprobantes::find($request->id2);
                    $comprobante->comprobante_id = $request->comprobante2;
                    $comprobante->num_serie1 = $request->numSerie12;
                    $comprobante->num_serie2 = $request->numSerie22;
                    $comprobante->tipo_comprobante = $request->tipo_comprobante2;
                    if ($request->tipo_comprobante2 == 1) {
                        $comprobante->autorizacion_sri = $request->autorizacionSRI2;
                        $comprobante->ultimo_num = $request->ultimoNum2;
                        $comprobante->fecha_caducidad = $request->fechaCaducidad2;
                    }
                $comprobante->save();

                DB::commit();
                return response()->json(['codigo'=>1,"mensaje" => "exitosamente!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al editar Configuración de documentos. <br> '.$th.'']);

        }
    }
    // Fin pestaña Configuracion de documentos

    // Guardado general todas las Pestañasa
    public function parametros_generales_guardar(Request $request)
    {
        try {
            // dd($request->all());

            // Guardado tabla TableConfigDocs Predeterminados
            $ConfigDocs = json_decode($request->ConfigDocs);
            foreach ($ConfigDocs as $key => $ConfigDoc) {
                $ConfigDocPredeterminados = Predeterminados::find(1);
                if ($ConfigDocPredeterminados == Null) {
                    $ConfigDocPredeterminados = New Predeterminados;
                }
                if ($ConfigDoc->tipo == 'facturasLocales') {
                    ($ConfigDoc->select == '') ? $ConfigDocPredeterminados->facturas_id = Null : $ConfigDocPredeterminados->facturas_id = $ConfigDoc->select;
                }
                if ($ConfigDoc->tipo == 'retencionesLocales') {
                    ($ConfigDoc->select == '') ? $ConfigDocPredeterminados->retenciones_id = Null : $ConfigDocPredeterminados->retenciones_id = $ConfigDoc->select;
                }
                if ($ConfigDoc->tipo == 'notaCreditoLocales') {
                    ($ConfigDoc->select == '') ? $ConfigDocPredeterminados->nota_credito_id = Null : $ConfigDocPredeterminados->nota_credito_id = $ConfigDoc->select;
                }
                if ($ConfigDoc->tipo == 'guiasLocales') {
                    ($ConfigDoc->select == '') ? $ConfigDocPredeterminados->guias_id = Null : $ConfigDocPredeterminados->guias_id = $ConfigDoc->select;
                }
                if ($ConfigDoc->tipo == 'liquidacionLocales') {
                    ($ConfigDoc->select == '') ? $ConfigDocPredeterminados->liq_compra_id = Null : $ConfigDocPredeterminados->liq_compra_id = $ConfigDoc->select;
                }
                $ConfigDocPredeterminados->save();
            }

            // Guardado tabla GeneralesGenerales
            $generales1 = json_decode($request->GeneralesGenerales);
            foreach ($generales1 as $key => $general) {
                $generalesEmpresa1         = ParametrosGenerales::where('nombre_id', $general->id)->first();
                $generalesEmpresa1->estado = $general->check ?? 0;
                if (isset($general->number)) {
                    ($general->number == '') ? $generalesEmpresa1->valor = Null : $generalesEmpresa1->valor = $general->number;
                }
                if (isset($general->select)) {
                    ($general->select == '') ? $generalesEmpresa1->dato = Null : $generalesEmpresa1->dato = $general->select;
                }
                $generalesEmpresa1->save();
            }

            // Guardado tabla GeneralesVentas
            $ventas = json_decode($request->GeneralesVentas);
            foreach ($ventas as $key => $venta) {
                $generalesEmpresa2         = ParametrosGenerales::where('nombre_id', $venta->id)->first();
                $generalesEmpresa2->estado = $venta->check ?? 0;
                if (isset($venta->number)) {
                    ($venta->number == '') ? $generalesEmpresa2->valor = Null : $generalesEmpresa2->valor = $venta->number;
                }
                if (isset($venta->select)) {
                    ($venta->select == '') ? $generalesEmpresa2->dato = Null : $generalesEmpresa2->dato = $venta->select;
                }
                $generalesEmpresa2->save();
            }

            // Guardado tabla GeneralesClientesCXC
            $clientesCXC = json_decode($request->GeneralesClientesCXC);
            foreach ($clientesCXC as $key => $clienteCXC) {
                $generalesEmpresa3         = ParametrosGenerales::where('nombre_id', $clienteCXC->id)->first();
                $generalesEmpresa3->estado = $clienteCXC->check ?? 0;
                if (isset($clienteCXC->number)) {
                    ($clienteCXC->number == '') ? $generalesEmpresa3->valor = Null : $generalesEmpresa3->valor = $clienteCXC->number;
                }
                if (isset($clienteCXC->select)) {
                    ($clienteCXC->select == '') ? $generalesEmpresa3->dato = Null : $generalesEmpresa3->dato = $clienteCXC->select;
                }
                $generalesEmpresa3->save();
            }

            // Guardado tabla GeneralesInventariosCompras
            $inventariosCompras = json_decode($request->GeneralesInventariosCompras);
            foreach ($inventariosCompras as $key => $inventarioCompra) {
                $generalesEmpresa4         = ParametrosGenerales::where('nombre_id', $inventarioCompra->id)->first();
                $generalesEmpresa4->estado = $inventarioCompra->check ?? 0;
                if (isset($inventarioCompra->number)) {
                    ($inventarioCompra->number == '') ? $generalesEmpresa4->valor = Null : $generalesEmpresa4->valor = $inventarioCompra->number;
                }
                if (isset($inventarioCompra->select)) {
                    ($inventarioCompra->select == '') ? $generalesEmpresa4->dato = Null : $generalesEmpresa4->dato = $inventarioCompra->select;
                }
                $generalesEmpresa4->save();
            }

            // Guardado tabla GeneralesAlertas
            $alertas = json_decode($request->GeneralesAlertas);
            foreach ($alertas as $key => $alerta) {
                $generalesEmpresa5         = ParametrosGenerales::where('nombre_id', $alerta->id)->first();
                $generalesEmpresa5->estado = $alerta->check ?? 0;
                if (isset($alerta->number)) {
                    ($alerta->number == '') ? $generalesEmpresa5->valor = Null : $generalesEmpresa5->valor = $alerta->number;
                }
                if (isset($alerta->select)) {
                    ($alerta->select == '') ? $generalesEmpresa5->dato = Null : $generalesEmpresa5->dato = $alerta->select;
                }
                $generalesEmpresa5->save();
            }

            // Guardado pestaña Facturacion Electronica

                // Rutas para comprobantes electrónicos
                $FeCbtes            = json_decode($request->FeCbte);
                foreach ($FeCbtes as $key => $FeCbte) {
                    $generalesEmpresa6         = ParametrosGenerales::where('nombre_id', $FeCbte->id)->first();
                    $generalesEmpresa6->estado = $FeCbte->check ?? 0;
                    if (isset($FeCbte->file)) {
                        if ($FeCbte->id == 47) {
                            $file = $request->FeCbte_file47 ?? Null;
                        }elseif ($FeCbte->id == 48) {
                            $file = $request->FeCbte_file48 ?? Null;
                        }elseif ($FeCbte->id == 49) {
                            $file = $request->FeCbte_file49 ?? Null;
                        }

                        if ($file != Null) {
                            $destinationPath = 'files';

                            $filen = $file->getClientOriginalName();
                            $filename =substr(md5(uniqid(rand())),0,6).'_'.$filen;
                            $filename = str_replace(" ","_",$filename);
                            $upload_success = $file->move($destinationPath, $filename);

                            $generalesEmpresa6->file = $filename;
                        }
                    }
                    if (isset($FeCbte->select)) {
                        ($FeCbte->select == '') ? $generalesEmpresa6->dato = Null : $generalesEmpresa6->dato = $FeCbte->select;
                    }
                    if (isset($FeCbte->password)) {
                        ($FeCbte->password == '') ? $generalesEmpresa6->valor = Null : $generalesEmpresa6->valor = $FeCbte->password;
                    }
                    if (isset($FeCbte->date)) {
                        ($FeCbte->date == '') ? $generalesEmpresa6->date = Null : $generalesEmpresa6->date = $FeCbte->date;
                    }
                    $generalesEmpresa6->save();
                }

                // Información de la cuenta de correo electrónico
                $InfoCuentasEmails  = json_decode($request->InfoCuentasEmail);
                foreach ($InfoCuentasEmails as $key => $InfoCuentasEmail) {
                    $generalesEmpresa7         = ParametrosGenerales::where('nombre_id', $InfoCuentasEmail->id)->first();
                    $generalesEmpresa7->estado = $InfoCuentasEmail->check ?? 0;
                    if (isset($InfoCuentasEmail->select)) {
                        ($InfoCuentasEmail->select == '') ? $generalesEmpresa7->dato = Null : $generalesEmpresa7->dato = $InfoCuentasEmail->select;
                    }
                    if (isset($InfoCuentasEmail->number)) {
                        ($InfoCuentasEmail->number == '') ? $generalesEmpresa7->valor = Null : $generalesEmpresa7->valor = $InfoCuentasEmail->number;
                    }
                    if (isset($InfoCuentasEmail->text)) {
                        ($InfoCuentasEmail->text == '') ? $generalesEmpresa7->valor = Null : $generalesEmpresa7->file = $InfoCuentasEmail->text;
                    }
                    if (isset($InfoCuentasEmail->password)) {
                        ($InfoCuentasEmail->password == '') ? $generalesEmpresa7->valor = Null : $generalesEmpresa7->file = $InfoCuentasEmail->password;
                    }
                    $generalesEmpresa7->save();
                }

                // Emitir comprobante de correo electrónico para
                $FECbteElectronicos = json_decode($request->FECbteElectronico);
                foreach ($FECbteElectronicos as $key => $FECbteElectronico) {
                    $generalesEmpresa8         = ParametrosGenerales::where('nombre_id', $FECbteElectronico->id)->first();
                    $generalesEmpresa8->estado = $FECbteElectronico->check ?? 0;
                    if (isset($FECbteElectronico->number)) {
                        ($FECbteElectronico->number == '') ? $generalesEmpresa8->valor = Null : $generalesEmpresa8->valor = $FECbteElectronico->number;
                    }
                    $generalesEmpresa8->save();
                }
            // FIN Guardado pestaña Facturacion Electronica


            return response()->json(['codigo'=>1,"mensaje" => "exitosamente!"]);

        } catch (\Throwable $th) {
            dd($th->getMessage().' - '.$th->getFile().' - '.$th->getLine());
            dd($th->getLine());
            //throw $th;
            DB::rollback();
            return response()->json(['codigo'=>0,'mensaje'=>'Fallo al guardar parametros generales. <br> '.$th.'']);
        }
    }

    // Enviar correo de prueba
    public function SendTestMail(Request $request)
    {
        try {
            if (!$request->email) {
                return ['codigo'=>0,'mensaje'=>'Debe ingresar un correo electronico para el envío.'];
            }

            $data = array(
                'anio' => date('Y'),
            );

            $ParametrosGenerales = ParametrosGenerales::get();
            $host = TipoServidorMail::find($ParametrosGenerales->firstWhere('id',55)->dato);

            env('MAIL_DRIVER'       , 'smtp');
            env('MAIL_HOST'         , $host->nombre);
            env('MAIL_PORT'         , $ParametrosGenerales->firstWhere('id',56)->valor);
            env('MAIL_USERNAME'     , $ParametrosGenerales->firstWhere('id',59)->file);
            env('MAIL_PASSWORD'     , $ParametrosGenerales->firstWhere('id',61)->file);
            env('MAIL_ENCRYPTION'   , 'tls');
            env('MAIL_FROM_ADDRESS' , $ParametrosGenerales->firstWhere('id',59)->file);
            env('MAIL_FROM_NAME'    , $ParametrosGenerales->firstWhere('id',58)->file);

            Config::set('mail.username', $ParametrosGenerales->firstWhere('id',59)->file);
            Config::set('mail.password', $ParametrosGenerales->firstWhere('id',61)->file);

            Mail::send('Comercio.emails.test_email', $data, function ($message) use($ParametrosGenerales) {
                $message->from($ParametrosGenerales->firstWhere('id',59)->file, $ParametrosGenerales->firstWhere('id',58)->file);
                $message->to($request->email, $request->email);
                $message->subject('Notificación de correo de prueba');
            });

            return response()->json(['codigo'=>1,"message" => "Correo de prueba enviado a ".$request->email." de forma exitosa"]);
        } catch (\Throwable $th) {
            return response()->json(['codigo'=>0,'message'=>'Fallo al enviar correo de prueba. <br> '.$th.'']);
        }
    }

}
