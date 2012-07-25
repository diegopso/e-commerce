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
class Exception_LimiteDeArquivosExcedido extends TriladoException {
    /**
     * Contrutor da classe
     * @param	string	$action		nome da action
     */
    public function __construct() {
        parent::__construct('Você não pode mais cadastrar arquivos neste conteúdo.');
    }

    /**
     * Se o debug estiver habilitado, informa ao usuário detalhes sobre a action
     * @see		PageNotFoundException::getDetails()
     * @return	string		retorna os detalhes da action
     */
    public function getDetails() {
        return 'Você não pode mais cadastrar arquivos.';
    }

}