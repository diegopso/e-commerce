<?php

/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */

ini_set('upload_max_filesize', '10M');
ini_set('memory_limit', '512M');
ini_set('post_max_size', '10M');


//calcula o endereço de root
$root = str_replace('\\', '/', dirname(dirname(dirname(__FILE__))));
if (substr($root, -1) != '/')
    $root = $root . '/';

//define as variáveis de root
define('root', $root);
define('root_virtual', str_replace($_SERVER['DOCUMENT_ROOT'], '', root));
define('wwwroot', root . 'app/wwwroot/');
define('modpath', $root . 'modules/');

//importa os arquivos iniciais
require_once root . 'core/libs/Import.php';
require_once root . 'core/libs/Route.php';
require_once root . 'core/libs/modules.php';
require_once root . 'app/routes.php';
require_once root . 'app/config.php';
require_once root . 'core/constantes.php';
require_once root . 'core/functions.php';

//carrega os módulos ativos
foreach (Modules::instance() as $m) {
    if (file_exists($m . 'init.php'))
        require_once $m . 'init.php';
}

Import::core('App');

$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';

new App($url);

/* Using LESS */
$files = scandir(wwwroot . 'media/less');
foreach ($files as $file) {
    if (preg_match('@.less$@', $file)) {
        Lessc::ccompile(wwwroot . 'media/less/' . $file, wwwroot . 'media/css/' . str_replace('.less', '.css', $file));
    }
}