<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* BASES  */
$route['bases'] = 'bases/main/index';

/* AMBULANCIAS  */
$route['ambulancias'] = 'ambulancias/main/index';

/* USUARIOS  */
$route['usuarios'] = 'usuarios/main/index';

/* EMERGENCIAS  */
$route['emergencias'] = 'emergencias/main/index';
$route['emergencias/listar'] = 'emergencias/main/listar';

/* FICHA ATENCION */
$route['fichaatencion'] = 'fichaatencion/main/index';
