<?php
/** @Entity("user") */
class User extends Model
{
    /**
     * @AutoGenerate()
     * @Column(Type="int(11)",Key="Primary")
     */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $username;

    /** @Column(Type="varchar(256)") */
    public $password;

    function __construct($username = null, $password = null) {
        $this->username = $username;
        $this->password = $password;
    }

}