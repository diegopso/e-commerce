<?php

/** @Entity("produto") */
class Model_Produto {
    
    /**
     * Guarda true se a classe for uma nova instância de Model e false a instância vinher do banco
     * @var	boolean
     */
    private $_isNew = true;

    /**
     * Guarda o nome da propriedade que é a chave primária
     * @var	string
     */
    protected $_key = 'id';
    
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
     * Identifica e retorna o nome da propriedade que é uma chave primária
     * @return	string		nome da propriedade
     */
    protected function _getKey() {
        return $this->_key;
    }

    /**
     * Define o valor da propriedade em caso de auto incremento
     * @param	int	$id		valor do auto incremento
     * @return	void
     */
    public function _setLastId($id = null) {
        $key = $this->_getKey();
        if ($key){
            if ($id){
                $this->{$key} = $id;
            }
        }
    }
    
    /**
     * @AutoGenerate()
     * @Column(Type="int(11)",Key="Primary")
     */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $nome;

    /** @Column(Type="int(11)") */
    public $quantidade;

    /** @Column(Type="float") */
    public $preco;

    /** @Column(Type="varchar(256)") */
    public $modelo;

    /** @Column(Type="float") */
    public $altura;

    /** @Column(Type="float") */
    public $largura;

    /** @Column(Type="float") */
    public $comprimento;

    /** @Column(Type="float") */
    public $peso;

    /** @Column(Type="varchar(8)") */
    public $status;

    /** @Column(Type="int(11)") */
    public $id_imagem;

    /** @Column(Type="int(11)") */
    public $id_pagina;

    /** @Column(Type="int(11)") */
    public $id_loja;

    /**
     * Método do Active Record, retorna uma instância do Model buscando do banco pela chave primária
     * @param	int	$id		valor da chave primária
     * @return	object		retorna uma intância de Model
     */
    public static function get($id = null) {
        $instance = new self();

        if (!$id)
            return $instance;

        $db = Database::getInstance();
        return $db->Model_Produto->single('id = ?', $id);
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
        $db = Database::getInstance();
        return $db->Model_Produto->orderBy($o, $t)->paginate($p, $m);
    }
    
    /**
     * Método do Active Record para salvar o objeto no banco, se for uma nova intância dá um 'insert', senão dá 'update'
     * @return	void
     */
    public function save() {
        $key = $this->_getKey();
        
        $db = Database::getInstance();
        if ($key){
            $bool = $this->{$key};
            if($bool){
                //ocorrendo erro aqui embaixo
                $db->Model_Produto->update($this);
            }
            else{
                $db->Model_Produto->insert($this);
            }
        }else
            $db->Model_Produto->insert($this);
        $db->save();
    }
    
    /**
     * Método do Active Record que deleta um objeto do banco de dados, porém o objeto não pode ser uma nova instância
     * @return	void
     */
    public function delete() {
        $db = Database::getInstance();
        $db->Model_Produto->delete($this);
        $db->save();
    }
}