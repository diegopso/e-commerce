<?php
/** @Entity("pagina") */
class Model_Pagina extends Model
{
    /**
    * @AutoGenerate()
    * @Column(Type="int(11)",Key="Primary")
    */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $titulo;

    /** @Column(Type="varchar(256)") */
    public $subtitulo;

    /** @Column(Type="text") */
    public $conteudo;

    /** @Column(Type="int(11)") */
    public $data;

    /** @Column(Type="varchar(32)") */
    public $tipo;

    /** @Column(Type="varchar(8)") */
    public $status;

    /** @Column(Type="varchar(256)") */
    public $palavras_chave;

    /** @Column(Type="int(11)") */
    public $id_autor;

    /** @Column(Type="int(11)") */
    public $id_loja;
}