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

    /** @Column(Type="varchar(256)") */
    public $palavras_chave;

    /** @Column(Type="int(11)") */
    public $id_imagem;

    /** @Column(Type="int(11)") */
    public $id_pagina;

    /** @Column(Type="int(11)") */
    public $id_loja;


}