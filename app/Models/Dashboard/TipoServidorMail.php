<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TipoServidorMail extends Model
{
    protected $table='tipo_servidor_mails';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
    ];
}
