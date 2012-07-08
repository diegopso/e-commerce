<?php
/** @Entity("produto") */
class Model_Produto extends Model
{
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
}