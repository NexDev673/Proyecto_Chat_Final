<?php

namespace App\Controllers;

use App\Models\PuestoModel;

class Puestos extends BaseController
{
    // Mostrar puestos y realizar búsquedas
    public function index()
    {
        $modelo = new PuestoModel();
        $buscar = trim($this->request->getGet('buscar') ?? '');

        if ($buscar !== '') {
            $modelo->like('nombre', $buscar);
        }

        $datos = [
            'titulo' => 'Administración de puestos',
            'puestos' => $modelo->orderBy('id', 'DESC')->findAll(),
            'buscar' => $buscar
        ];

        return view('puestos/index', $datos);
    }

    // Registrar puesto
    public function guardar()
    {
        $reglas = [
            'nombre' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'permit_empty|max_length[1000]',
            'salario_referencia' => 'required|decimal|greater_than_equal_to[0]',
            'estado' => 'required|in_list[Activo,Inactivo]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()
                ->withInput()
                ->with('errores', $this->validator->getErrors());
        }

        $modelo = new PuestoModel();

        try {
            $modelo->insert([
                'nombre' => trim($this->request->getPost('nombre')),
                'descripcion' => trim($this->request->getPost('descripcion') ?? ''),
                'salario_referencia' => $this->request->getPost('salario_referencia'),
                'estado' => $this->request->getPost('estado')
            ]);

            return redirect()->to('/puestos')
                ->with('mensaje', 'Puesto registrado correctamente.');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo registrar. Verifica que el nombre no esté repetido.');
        }
    }

    // Mostrar formulario de edición
    public function editar($id)
    {
        $modelo = new PuestoModel();

        $puesto = $modelo->find($id);

        if (!$puesto) {
            return redirect()->to('/puestos')
                ->with('error', 'Puesto no encontrado.');
        }

        return view('puestos/editar', [
            'puesto' => $puesto
        ]);
    }

    // Actualizar puesto
    public function actualizar($id)
    {
        $modelo = new PuestoModel();

        $puesto = $modelo->find($id);

        if (!$puesto) {
            return redirect()->to('/puestos')
                ->with('error', 'Puesto no encontrado.');
        }

        $reglas = [
            'nombre' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'permit_empty|max_length[1000]',
            'salario_referencia' => 'required|decimal|greater_than_equal_to[0]',
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
                'salario_referencia' => $this->request->getPost('salario_referencia'),
                'estado' => $this->request->getPost('estado')
            ]);

            return redirect()->to('/puestos')
                ->with('mensaje', 'Puesto actualizado correctamente.');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo actualizar. Verifica que el nombre no esté repetido.');
        }
    }

    // Eliminar puesto
    public function eliminar($id)
    {
        $modelo = new PuestoModel();

        $puesto = $modelo->find($id);

        if (!$puesto) {
            return redirect()->to('/puestos')
                ->with('error', 'Puesto no encontrado.');
        }

        // Verificar si existen empleados asociados
        $db = \Config\Database::connect();

        $empleados = $db->table('empleados')
            ->where('puesto_id', $id)
            ->countAllResults();

        if ($empleados > 0) {
            return redirect()->to('/puestos')
                ->with('error', 'No se puede eliminar: existen empleados asociados a este puesto.');
        }

        $modelo->delete($id);

        return redirect()->to('/puestos')
            ->with('mensaje', 'Puesto eliminado correctamente.');
    }
}
