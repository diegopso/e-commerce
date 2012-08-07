<?php
/** @Entity("viewcategorias") */
class Model_Viewcategorias extends Model
{
    /** @Column(Type="int(11)") */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $nome;

    /** @Column(Type="int(11)") */
    public $id_categoria_pai;

    /** @Column(Type="varchar(256)") */
    public $nome_categoria_pai;


}