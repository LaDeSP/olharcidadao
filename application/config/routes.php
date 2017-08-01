<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['cadastrar'] = "registrar/novousuario";
$route['sair'] = "registrar/logout";
$route['publicar/(:any)'] = "registrar/publicacao/(:any)";

//paginação
$route['publicacoes/p'] = "Inicio";
$route['publicacoes/p/(:num)'] = "Inicio";

//categoria
$route['categoria/(:num)'] = "Inicio/filtrar/$1";
$route['categoria/(:num)/(:num)'] = "Inicio/filtrar/$1";

//painel
$route['painel/(:num)'] = "registrar/login";
$route['painel'] = "registrar/login";