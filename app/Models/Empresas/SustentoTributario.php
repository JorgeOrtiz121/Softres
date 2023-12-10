<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class SustentoTributario extends Model
{
    use TenantConnector;

    protected $table = 'sustento_tributario';
    protected $connection = 'tenant';

    protected $fillable = [
        'codigo',
        'nombre',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function DocumentoAutorizado(){
        return $this->hasMany('App\Models\Empresas\DocumentoAutorizado','id_sustento_tributario','id');
    }

}
