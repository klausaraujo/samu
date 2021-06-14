<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* BASES  */
$route['bases'] = 'bases/main/index';

/* AMBULANCIAS  */
$route['ambulancias'] = 'ambulancias/main/index';

/* USUARIOS  */
$route['usuarios'] = 'usuarios/main/index';