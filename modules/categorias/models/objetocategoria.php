<?php
/** @Entity("objetocategoria") */
class Model_Objetocategoria extends Model
{
    /**
    * @AutoGenerate()
    * @Column(Type="int(11)",Key="Primary")
    */
    public $id;

    /** @Column(Type="int(11)") */
    public $id_objeto;

    /** @Column(Type="int(11)") */
    public $id_categoria;

    /** @Column(Type="varchar(16)") */
    public $tipo_objeto;


}