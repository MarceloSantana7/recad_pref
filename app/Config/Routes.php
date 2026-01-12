<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

service('auth')->routes($routes, ['except' => ['login']]);

$routes->get('/', 'Home::index');

// Login
$routes->get('/login', '\CodeIgniter\Shield\Controllers\LoginController::loginView');
$routes->post('/login', 'Login::login');

service('auth')->routes($routes);


// Dashboard Admin
$routes->get('/admin/dashboard','Admin::index');
// Dashboard Cadastrador
$routes->get('/cadastrador/dashboard','Cadastrador::index');
$routes->get('/cadastrador/recadastro','Cadastrador::recadastro');
$routes->post('/cadastrador/recadastro','Cadastrador::recadastro');
/// Rotas para etapas
$routes->get('/recadastro/etapa1/(:num)', 'Cadastrador::etapa1/$1');
$routes->post('/recadastro/salvarEtapa1', 'Cadastrador::salvarEtapa1');
$routes->get('/recadastro/etapa2/(:num)', 'Cadastrador::etapa2/$1');
$routes->post('/recadastro/salvarEtapa2', 'Cadastrador::salvarEtapa2');
$routes->get('/recadastro/etapa3/(:num)', 'Cadastrador::etapa3/$1');
$routes->post('/recadastro/salvarEtapa3', 'Cadastrador::salvarEtapa3');
$routes->get('/recadastro/concluido/(:num)', 'Cadastrador::concluido/$1');
// Servidor
$routes->post('/servidor/consultacpf','Cadastrador::findServidorCPF');
