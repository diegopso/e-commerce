<?php
/** @Entity("palavrachave") */
class Palavrachave extends Model
{
    /**
    * @AutoGenerate()
    * @Column(Type="int(11)",Key="Primary")
    */
    public $id;

    /** @Column(Type="varchar(32)") */
    public $palavra;

    /** @Column(Type="int(11)") */
    public $id_objeto;

    /** @Column(Type="varchar(8)") */
    public $tipo_objeto;


}