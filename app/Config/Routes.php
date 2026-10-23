<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('pruebabd', 'PruebaBD::index');
$routes->get('departamentos', 'Departamentos::index');
$routes->post('departamentos/guardar', 'Departamentos::guardar');