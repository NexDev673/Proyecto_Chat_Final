
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class PruebaBD extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            $db->initialize();

            if ($db->connID) {
                return "¡Conexión exitosa con la base de datos!";
            }

            return "No se pudo conectar con la base de datos.";

        } catch (\Throwable $e) {
            return "Error de conexión: " . $e->getMessage();
        }
    }
}
