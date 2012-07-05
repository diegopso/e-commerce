<?php
/** @Entity("post") */
class Post extends Model
{
	/**
     * @AutoGenerate()
     * @Column(Type="int(11)",Key="Primary")
     */
    public $Id;

	/** @Column(Type="varchar(128)") */
	public $Title;

	/** @Column(Type="int(11)") */
	public $Date;

	/** @Column(Type="text") */
	public $Content;


}