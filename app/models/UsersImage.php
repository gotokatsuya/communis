<?php

class UsersImage extends \Phalcon\Mvc\Model
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
    public $public_id;

    
    /**
     *
     * @var string
     */
    public $uuid;

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


    public function api()
    {
        $data = array(
            'image_id' => $this->id, 
            'public_id' => $this->public_id, 
                   );
        return $data;
    }

}
