<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('pruebabd', 'PruebaBD::index');
$routes->get('departamentos', 'Departamentos::index');
$routes->post('departamentos/guardar', 'Departamentos::guardar');
$routes->get('departamentos/editar/(:num)', 'Departamentos::editar/$1');
$routes->post('departamentos/actualizar/(:num)', 'Departamentos::actualizar/$1');
$routes->post('departamentos/eliminar/(:num)', 'Departamentos::eliminar/$1');
$routes->get('puestos', 'Puestos::index');
$routes->post('puestos/guardar', 'Puestos::guardar');
$routes->get('puestos/editar/(:num)', 'Puestos::editar/$1');
$routes->post('puestos/actualizar/(:num)', 'Puestos::actualizar/$1');
$routes->post('puestos/eliminar/(:num)', 'Puestos::eliminar/$1');