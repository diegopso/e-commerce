<?php
/** @Entity("categoria") */
class Model_Categoria extends Model
{
    /**
    * @AutoGenerate()
    * @Column(Type="int(11)",Key="Primary")
    */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $nome;

    /** @Column(Type="int(11)") */
    public $id_categoria_pai;

    /** @Column(Type="varchar(8)") */
    public $status;

    /** @Column(Type="int(11)") */
    public $id_loja;


}