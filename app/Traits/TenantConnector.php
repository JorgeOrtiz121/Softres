<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Dashboard\Empresas;
use Illuminate\Support\Facades\Auth;


trait TenantConnector{
    
    /**
    * Switch the Tenant connection to a different company.
    * @param Company $company
    * @return void
    * @throws
    */

    public static function Reconectar(){
        
        $data = Empresas::find(session()->get('id'));

        // if(Auth::guest()){
            DB::purge('tenant');
    
                Config::set('database.connections.tenant.database', $data->database);
                // Config::set('database.connections.tenant.database', $data->database);
    
            DB::reconnect('tenant');
    
            Schema::connection('tenant')->getConnection()->reconnect();
            
        // }else{
            // return redirect('/login');
        // }
    }
}