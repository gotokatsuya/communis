<?php

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $uuid;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $university;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var date
     */
    public $created_at;

    /**
     *
     * @var date
     */
    public $modified_in;


    public function beforeCreate()
    {
        //Set the creation date
        $this->created_at = date('Y-m-d H:i:s');
        $this->modified_in = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        //Set the modification date
        $this->modified_in = date('Y-m-d H:i:s');
    }

}
