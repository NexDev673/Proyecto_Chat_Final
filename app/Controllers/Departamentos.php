<?php

namespace App\Controllers;

use App\Models\DepartamentoModel;

class Departamentos extends BaseController
{
    public function index()
    {
        $modelo = new DepartamentoModel();

        $datos = [
            'titulo' => 'Administración de departamentos',
            'departamentos' => $modelo->orderBy('id', 'DESC')->findAll()
        ];

        return view('departamentos/index', $datos);
    }

    public function guardar()
    {
        $reglas = [
            'nombre' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'permit_empty|max_length[1000]',
            'estado' => 'required|in_list[Activo,Inactivo]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()
                ->withInput()
                ->with('errores', $this->validator->getErrors());
        }

        $modelo = new DepartamentoModel();

        try {
            $modelo->insert([
                'nombre' => trim($this->request->getPost('nombre')),
                'descripcion' => trim($this->request->getPost('descripcion') ?? ''),
                'estado' => $this->request->getPost('estado')
            ]);

            return redirect()->to('/departamentos')
                ->with('mensaje', 'Departamento registrado correctamente.');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo registrar. Verifica que el nombre no esté repetido.');
        }
    }
}
