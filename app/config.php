<?php
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


/**
 * Arquivo de configuração
 * 
 */

/**
 * Define o tipo do debug, pode assumir os seguintes valores: off, local, network e all
 * @var	string
 */
define('debug', 'off');

/**
 * Tipo do drive do banco de dados, pode assumir os seguintes valores: mysql
 * @var	string
 */
define('db_type', 'mysql');

/**
 * Local do banco de dados 
 * @var	string
 */
define('db_host', 'localhost');

/**
 * Nome do banco de dados
 * @var	string
 */
define('db_name', 'store');

/**
 * Usuário do banco de dados
 * @var	string
 */
define('db_user', 'root');

/**
 * Senha do banco de dados
 * @var	string
 */
define('db_pass', 'root');

/**
 * Master Page padrão
 * @var	string
 */
define('default_master', 'template');

/**
 * Controller padrão
 * @var	string
 */
define('default_controller', 'Home');

/**
 * Action padrão
 * @var	string
 */
define('default_action', 'index');

/**
 * Página de login
 * @var	string
 */
define('default_login', '~/auth');

/**
 * Charset padrão
 * @var	string
 */
define('charset', 'UTF-8');

/**
 * Linguagem padrão
 * @var	string
 */
define('default_lang', 'pt-br');

/**
 * Chave de segurança (deve ser alterada)
 * @var	string
 */
define('salt', 'BFF2A863B773C3E425BF793C9AE02210DFECE51E658E8098587D9BF7690C15E7');

/**
 * Forçar o mapeamento do banco de dados pelo DBmap, apenas se o módulo estiver ativo.
 * @var string
 */
define('dbmap_force', false);

define('marketing', Modules::is_set('propaganda'));

define('auto_ajax', false);
define('auto_dotxml', false);

define('auto_dotjson', false);