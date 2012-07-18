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


}