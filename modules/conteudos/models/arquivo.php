<?php
/** @Entity("arquivo") */
class Model_Arquivo extends Model
{
    /**
    * @AutoGenerate()
    * @Column(Type="int(11)",Key="Primary")
    */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $caminho;

    /** @Column(Type="varchar(8)") */
    public $extensao;

    /** @Column(Type="varchar(256)") */
    public $nome_original;

    /** @Column(Type="varchar(16)") */
    public $mimetype;

    /** @Column(Type="int(11)") */
    public $id_loja;

    /** @Column(Type="int(11)") */
    public $id_pagina;

    public function save(){
        $db = new DatabaseQuery('Model_Arquivo');
        $db->whereSQL('id_pagina = '.$this->id_pagina);
        $count = $db->count();
        if($count >= Helper_Conteudos::$arquivos_por_pagina)
            throw new Exception_LimiteDeArquivosExcedido();
        
        return parent::save();
    }

}