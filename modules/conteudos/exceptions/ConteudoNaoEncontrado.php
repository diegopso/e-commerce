<?php

/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */

/**
 * Exceção para action não encontrada, é tratada pela framework, que resulta numa página não encontrada
 * 
 * @author	Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * @version	1
 *
 */
class Exception_ConteudoNaoEncontrado extends PageNotFoundException {
    /**
     * Contrutor da classe
     * @param	string	$action		nome da action
     */
    public function __construct() {
        parent::__construct('O conteúdo solicitado não foi encontrado.');
    }

    /**
     * Se o debug estiver habilitado, informa ao usuário detalhes sobre a action
     * @see		PageNotFoundException::getDetails()
     * @return	string		retorna os detalhes da action
     */
    public function getDetails() {
        return 'Se você digitou o endereço desta pagina manualmente confira a existências de erros.';
    }

}