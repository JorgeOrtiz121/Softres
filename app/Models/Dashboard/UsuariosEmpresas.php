<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class UsuariosEmpresas extends Model
{
    protected $table = 'users_empresas';
    protected $connection = 'mysql';

    protected $fillable = [
        'usuario_id',
        'empresa_id',
        'cargo_usuario_id',
        'estado',
        'user_id',

    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'usuario_id');
    }

    public function empresas()
    {
        return $this->belongsTo('App\Models\Dashboard\Empresas', 'empresa_id');
    }
}
