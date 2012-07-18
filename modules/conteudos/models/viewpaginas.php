<?php
/** @Entity("viewpaginas") */
class Model_ViewPaginas extends Model
{
    /** @Column(Type="int(11)") */
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

    /** @Column(Type="int(11)") */
    public $id_arquivo;

    /** @Column(Type="varchar(256)") */
    public $caminho;

    /** @Column(Type="varchar(8)") */
    public $extensao;

    /** @Column(Type="varchar(256)") */
    public $nome_original;

    /** @Column(Type="varchar(16)") */
    public $mimetype;

    /** @Column(Type="varchar(6)") */
    public $nome_autor;


}