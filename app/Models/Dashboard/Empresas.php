<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Empresas extends Model
{

    protected $table = 'empresas';

    protected $fillable = [
        'tipo_negocio',
        'empresa',
        'razon_social',
        'identificacion',
        'representante_id',
        'telefono',
        'fax',
        'email',
        'direccion',
        'pais_id',
        'provincia_id',
        'ciudad_id',
        'ruc_contador',
        'resolucion',
        'fecha_vencimiento',
        'ambiente',
        'artesano',
        'contabilidad',
        'tipo_regimen_id',
        'reteiva',
        'reterenta',
        'estado',
        'database',
        'logo',
        'firma',
        'alto_firma',
        'ancho_firma',
        'electronica',
    ];

    public function representante()
    {
        return $this->belongsTo('App\User', 'representante_id');
    }

    public function contador()
    {
        return $this->belongsTo('App\User', 'contador_id');
    }

    public function paises()
    {
        return $this->belongsTo('App\Models\Dashboard\Paises', 'pais_id');
    }

    public function provincias()
    {
        return $this->belongsTo('App\Models\Dashboard\Provincias', 'provincia_id');
    }

    public function ciudades()
    {
        return $this->belongsTo('App\Models\Dashboard\Ciudades', 'ciudad_id');
    }

    // Calcular la diferencia de fechas
    public function vence($id)
    {
        // Consulto la fecha de vencimiento de la empresa
        $fvence = Empresas::find($id)->fecha_vencimiento;
        // Formatear la fecha y extraer la fecha actual
        $fvence = new DateTime($fvence);
        $fhoy = new DateTime();
        $intervalo = $fhoy->diff($fvence);

        // Retorno la diferencia de dias entre ambas fechas
        if (1 == $intervalo->invert) {
            // Negativo
            return $intervalo->days * -1;
        } else {
            // Positivo
            return $intervalo->days;
        }
    }

}
