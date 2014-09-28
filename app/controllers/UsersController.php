<?php

class UsersController extends ControllerBase
{

    public function indexAction()
    {
    	echo "Communis";
    }


    public function register_nameAction()
    {
    	$this->view->disable();
    	$result = array();
    	$result['success'] = false;
        if ($this->request->isPost() == true) {
            $name = $this->request->getPost("name");
            $users = Users::query()
            	->where("name = '$name'")
            	->execute();
            if (count($users) == 0) {
                $result['success'] = true; 
            }
        }
        return $this->json($result);      
    }


    public function register_userAction()
    {
    	$this->view->disable();
    	$result = array();
    	$result['success'] = false;
            $result['user'] = array();
            if ($this->request->isPost() == true) {
            $name = $this->request->getPost("name");
            $university = $this->request->getPost("university");
            $password = $this->request->getPost("password");
            
            $user = new Users();
            $user->uuid = uuid_create(UUID_TYPE_RANDOM);
            $user->name = $name;
            $user->university = $university;
            $user->password = $password;

            if ($user->create() == true) {
                $result['success'] = true;
                $result['user'] = $user;
            }
        }
        return $this->json($result);      
    }


    public function loginAction()
    {
    	$this->view->disable();
    	$result = array();
    	$result['success'] = false;
        $result['user'] = array();
        if ($this->request->isPost() == true) {
            $name = $this->request->getPost("name");
            $university = $this->request->getPost("university");
            $password = $this->request->getPost("password");
            
            $users = Users::query()
            	->where("name = '$name'")
            	->andwhere("university = '$university'")
            	->andwhere("password = '$password'")
            	->orderBy('modified_in desc')
            	->execute();

            if (count($users) != 0) {
                $result['success'] = true;
                $result['user'] = $users[0];
            }
        }
        return $this->json($result);      
    }

    
}

