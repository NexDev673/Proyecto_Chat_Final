<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table = 'puestos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'salario_referencia',
        'estado'
    ];

    protected $useTimestamps = false;
}
