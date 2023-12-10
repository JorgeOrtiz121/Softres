<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class DocumentoAutorizado extends Model
{
    use TenantConnector;

    protected $table = 'documento_autorizado';
    protected $connection = 'tenant';

    protected $fillable = [
        'codigo',
        'nombre',
        'id_sustento_tributario'
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function SustentoTributario()
    {
        return $this->belongsTo('App\Models\Empresas\SustentoTributario','id_sustento_tributario');
    }

}
