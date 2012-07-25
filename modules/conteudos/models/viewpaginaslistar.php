<?php
/** @Entity("viewpaginaslistar") */
class Model_ViewPaginasListar extends Model
{
    /** @Column(Type="int(11)") */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $titulo;

    /** @Column(Type="int(11)") */
    public $data;

    /** @Column(Type="varchar(32)") */
    public $tipo;

    /** @Column(Type="int(11)") */
    public $id_autor;

    /** @Column(Type="varchar(6)") */
    public $nome_autor;


}