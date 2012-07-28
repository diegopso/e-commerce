<?php

/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */

/**
 * Contém método para facilitar a importação de arquivos, como controllers, models e helpers
 * 
 * @author	Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * @version	1
 *
 */
class Import {

    /**
     * Carrega um ou mais arquivos a partir de um diretório
     * 
     * @param	string	$folder				indica o diretório que serão carregados os arquivos, os valores possíveis são 'core', 'exception', 'controller', 'model' e 'helper'
     * @param	array	$class				um array com os nomes das classes
     * @throws	DirectoryNotFoundException	disparada cara o diretório não conste na lista de diretórios padrão
     * @throws	FileNotFoundException		disparada se o arquivo com o nome da classe não for encontrado
     * @throws	ClassNotFoundException		disparada se dentro do arquivo não existir a classe
     * @return	void
     */
    public static function load($folder, $class = array()) {
        $folders = array();
        $folders['core'] = 'core/libs/';
        $folders['exception'] = 'core/libs/exceptions/';
        $folders['controller'] = 'app/controllers/';
        $folders['model'] = 'app/models/';
        $folders['helper'] = 'app/helpers/';

        if (!array_key_exists($folder, $folders))
            throw new DirectoryNotFoundException($folder . 's');

        foreach ($class as $c) {
            $file = root . $folders[$folder] . $c . '.php';
            if (!file_exists($file))
                throw new FileNotFoundException($folders[$folder] . $c . '.php');

            require_once $file;

            if (!class_exists($c))
                throw new ClassNotFoundException($c);
        }
    }

    /**
     * Importa as classes específicadas no parâmetro no diretório do núcleo do framework
     * @param	string	$class1		nome da classe
     * @param	string	$classN		nome da classe
     * @return	void
     */
    public static function core() {
        $args = func_get_args();
        self::load('core', $args);
    }

    /**
     * Importa as classes específicadas no parâmetro no diretório dos controllers
     * @param	string	$class1					nome da classe
     * @param	string	$classN					nome da classe
     * @throws	ControllerNotFoundException		disparado se o arquivo com o nome do controller não for encontrado
     * @throws	ClassNotFoundException			disparado se dentro do arquivo não existir uma classe com o nome do controller
     * @return	void
     */
    public static function controller() {
        $args = func_get_args();
        foreach ($args as $c) {
            $file = root . 'app/controllers/' . $c . '.php';
            if (!file_exists($file)) {
                $modules = Modules::instance();
                $found = false;

                foreach ($modules as $path) {
                    $file = $path . 'controllers/' . $c . '.php';
                    if (file_exists($file)) {
                        $found = true;
                        break;
                    }
                }

                if (!$found)
                    throw new ControllerNotFoundException($c);
            }

            require_once $file;

            if (!class_exists($c))
                throw new ClassNotFoundException($c);
        }
    }

    /**
     * Importa as classes específicadas no parâmetro no diretório dos models
     * @param	string	$class1		nome da classe
     * @param	string	$classN		nome da classe
     * @return	void
     */
    public static function model() {
        $args = func_get_args();
        self::load('model', $args);
    }

    /**
     * Importa as classes específicadas no parâmetro no diretório dos helpers
     * @param	string	$class1		nome da classe
     * @param	string	$classN		nome da classe
     * @return	void
     */
    public static function helper() {
        $args = func_get_args();
        self::load('helper', $args);
    }

    /**
     * Importa uma view específicada
     * @param	array	$vars			variáveis a serem utilizadas na view
     * @param	string	$controller		nome do controller
     * @param	string	$view			nome da view
     * @throws	FileNotFoundException	disparado se o arquivo não for encontrado
     * @return	string					retorna o conteúdo da view
     */
    public static function view($vars, $controller, $view) {
        $buffer = ob_get_clean();
        ob_start();
        extract($vars);

        $file = '';
        if (Modules::is_set(module)) {
            $file = modpath . module . '/views/' . $controller . '/' . $view . '.php';
        }

        if (!file_exists($file)) {
            $file = root . 'app/views/' . $controller . '/' . $view . '.php';

            if (!file_exists($file)) {
                $modules = Modules::instance();
                $found = false;

                foreach ($modules as $path) {
                    $file = $path . 'views/' . $controller . '/' . $view . '.php';
                    if (file_exists($file)) {
                        $found = true;
                        break;
                    }
                }

                if (!$found)
                    throw new FileNotFoundException('views/' . $controller . '/' . $view . '.php');
            }
        }

        require_once $file;

        $content = ob_get_clean();
        echo $buffer;
        return $content;
    }

    public static function get_contents($view, $controller = null, $module = null) {
        $file = '';
        
        if ($module) {
            if($module === 'app')
                $file = root . 'app/views/' . $controller . '/' . $view . '.php';
            else
                $file = modpath . $module . '/views/' . $controller . '/' . $view . '.php';
        } elseif (Modules::is_set(module)) {
            if ($controller)
                $file = modpath . module . '/views/' . $controller . '/' . $view . '.php';
            else
                $file = modpath . module . '/views/' . strtolower(str_replace('Controller', '', controller)) . '/' . $view . '.php';
        }else {
            if ($controller) {
                $file = root . 'app/views/' . $controller . '/' . $view . '.php';
            } else {
                $file = root . 'app/views/' . strtolower(str_replace('Controller', '', controller)) . '/' . $view . '.php';
            }
        }
        
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        
        return null;
    }

}
