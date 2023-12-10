<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class DeducibleIR extends Model
{

    protected $table = 'deducible_ir';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
    ];
}
