<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        $datos = [
            'titulo' => 'Inicio | Administración de Personal',
            'desarrollador' => 'Oscar Santos',
            'carnet' => '202401162',
            'descripcion' => 'Sistema web para la administración y organización del personal.
            Yo solo trabajé todo el proyecto'
        ];

        return view('inicio/index', $datos);
    }
}
