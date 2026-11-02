<?php

namespace App\Controllers;

use App\Models\DepartamentoModel;

class Departamentos extends BaseController
{
    // Mostrar departamentos y realizar búsquedas
    public function index()
    {
        $modelo = new DepartamentoModel();
        $buscar = trim($this->request->getGet('buscar') ?? '');

        if ($buscar !== '') {
            $modelo->like('nombre', $buscar);
        }

        $datos = [
            'titulo' => 'Administración de departamentos',
            'departamentos' => $modelo->orderBy('id', 'DESC')->findAll(),
            'buscar' => $buscar
        ];

        return view('departamentos/index', $datos);
    }

    // Registrar departamento
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

    // Mostrar formulario de edición
    public function editar($id)
    {
        $modelo = new DepartamentoModel();

        $departamento = $modelo->find($id);

        if (!$departamento) {
            return redirect()->to('/departamentos')
                ->with('error', 'Departamento no encontrado.');
        }

        return view('departamentos/editar', [
            'departamento' => $departamento
        ]);
    }

    // Actualizar departamento
    public function actualizar($id)
    {
        $modelo = new DepartamentoModel();

        $departamento = $modelo->find($id);

        if (!$departamento) {
            return redirect()->to('/departamentos')
                ->with('error', 'Departamento no encontrado.');
        }

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

        try {
            $modelo->update($id, [
                'nombre' => trim($this->request->getPost('nombre')),
                'descripcion' => trim($this->request->getPost('descripcion') ?? ''),
                'estado' => $this->request->getPost('estado')
            ]);

            return redirect()->to('/departamentos')
                ->with('mensaje', 'Departamento actualizado correctamente.');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo actualizar. Verifica que el nombre no esté repetido.');
        }
    }
        // Eliminar departamento
public function eliminar($id)
{
    $modelo = new DepartamentoModel();

    $departamento = $modelo->find($id);

    if (!$departamento) {
        return redirect()->to('/departamentos')
            ->with('error', 'Departamento no encontrado.');
    }

    // Verificar si existen empleados asociados
    $db = \Config\Database::connect();

    $empleados = $db->table('empleados')
        ->where('departamento_id', $id)
        ->countAllResults();

    if ($empleados > 0) {
        return redirect()->to('/departamentos')
            ->with('error', 'No se puede eliminar: existen empleados asociados a este departamento.');
    }

    $modelo->delete($id);

    return redirect()->to('/departamentos')
        ->with('mensaje', 'Departamento eliminado correctamente.');
}
}
