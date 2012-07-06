<?php

/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */

/**
 * Classe Model representa uma entidade do banco de dados, deve ser herdada, nela deve ficar a lógica de negócio da aplicação. Já vem com  métodos para as operações CRUD prontas
 * 
 * @author	Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * @version	2
 *
 */
class Model {

    /**
     * Guarda true se a classe for uma nova instância de Model e false a instância vinher do banco
     * @var	boolean
     */
    private $_isNew = true;

    /**
     * Verifica se a classe é uma nova instância de Model ou se os valores vem do banco
     * @return		boolean	retorna true se classe foi instânciada pelo usuário, ou false se foi instânciada pela classe DatabaseQuery
     */
    public function _isNew() {
        return $this->_isNew;
    }

    /**
     * Define se a classe é ou não uma nova instância. Esse método não deve ser chamado
     * @return	void
     */
    public function _setNew() {
        $this->_isNew = false;
    }

    /**
     * Guarda o nome da propriedade que é a chave primária
     * @var	string
     */
    protected $_key = null;

    /**
     * Identifica e retorna o nome da propriedade que é uma chave primária
     * @return	string		nome da propriedade
     */
    protected function _getKey() {
        if ($this->_key)
            return $this->_key;

        $class = preg_replace('@^Model_@', '', get_called_class());
        $annotation = Annotation::get($class);
        foreach ($this as $p => $v) {
            if ($p != '_isNew') {
                $property = $annotation->getProperty($p);
                if ($property->Column && $property->Column->Key)
                    return $this->_key = $p;
            }
        }
    }

    /**
     * Define o valor da propriedade em caso de auto incremento
     * @param	int	$id		valor do auto incremento
     * @return	void
     */
    public function _setLastId($id = null) {
        $key = $this->_getKey();
        if ($key) {
            if ($id)
                $this->{$key} = $id;
        }
    }

    /**
     * Método do Active Record, retorna uma instância do Model buscando do banco pela chave primária
     * @param	int	$id		valor da chave primária
     * @return	object		retorna uma intância de Model
     */
    public static function get($id = null) {
        $class = preg_replace('@^Model_@', '', get_called_class());
        $instance = new $class();
        
        if(!$id)
            return $instance;
        
        $db = Database::getInstance();
        return $db->{$class}->single($instance->_getKey() . ' = ?', $id);
    }

    /**
     * Método do Active Record, retorna um array de instâncias do Model buscando do banco pelos parâmetros
     * @param	int		$p		número da página (ex.: 1 listará de 0 á 10)	
     * @param	int		$m		quantidade máxima de itens por página
     * @param	string	$o		coluna a ser ordenada
     * @param	string	$t		tipo de ordenação (asc ou desc)
     * @return	array			retorna umma lista de instâncias de Model
     */
    public static function all($p = 1, $m = 10, $o = 'Id', $t = 'asc') {
        $p = $m * (($p < 1 ? 1 : $p) - 1);
        $class = preg_replace('@^Model_@', '', get_called_class());
        $db = Database::getInstance();
        return $db->{$class}->orderBy($o, $t)->paginate($p, $m);
    }

    public static function search() {
        
    }

    /**
     * Método do Active Record para salvar o objeto no banco, se for uma nova intância dá um 'insert', senão dá 'update'
     * @return	void
     */
    public function save() {
        $class = preg_replace('@^Model_@', '', get_called_class());
        $key = $this->_getKey();

        $db = Database::getInstance();
        if ($key && $this->{$key})
            $db->{$class}->update($this);
        else
            $db->{$class}->insert($this);
        $db->save();
    }

    /**
     * Método do Active Record que deleta um objeto do banco de dados, porém o objeto não pode ser uma nova instância
     * @return	void
     */
    public function delete() {
        $class = preg_replace('@^Model_@', '', get_called_class());

        $db = Database::getInstance();
        $db->{$class}->delete($this);
        $db->save();
    }

}
