<?php
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */
 
/**
* Definição dos modulos utilizados
*/
Modules::add('dbmap', modpath . 'dbmap/');
Modules::add('midia', modpath . 'midia/');
//Modules::add('auth', modpath . 'auth/');
Modules::add('produtos', modpath . 'produtos/');
Modules::add('categorias', modpath . 'categorias/');
Modules::add('conteudos', modpath . 'conteudos/');
//Modules::add('propaganda', modpath . 'propaganda/');


/**
 * As rotas são para reescrita de URL. Veja um exemplo:
 * Route::add('^([\d]+)-([a-z0-9\-]+)$','home/view/$1/$2');
 * 
 * Também é possível criar prefixos. Veja um exemplo:
 * Route::prefix('admin');
 */
