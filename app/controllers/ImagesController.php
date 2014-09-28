<?php

class ImagesController extends ControllerBase
{
    public function onConstruct()
    {
        include_once(__DIR__ . '/../../cloudinary/src/Cloudinary.php');
        include_once(__DIR__ . '/../../cloudinary/src/Uploader.php');
        include_once(__DIR__ . '/../../cloudinary/src/Api.php');
        \Cloudinary::config(array(
            "cloud_name" => "communis", 
            "api_key" => "344798775626991", 
            "api_secret" => "iwp61WLAzfUn_PNrxB87WJGEJCE")
        );
    }

    public function indexAction()
    {

    }

    public function uploadAction()
    {
        $this->view->disable();
        $result = array();
        $result['success'] = false;
        
        if($this->request->isPost() == true && $this->request->hasFiles() == true){
            $uuid = $this->request->getPost("uuid");
            $type = $this->request->getPost("type");
            $files = $this->request->getUploadedFiles();
            foreach($files as $file){
    		    $ret = \Cloudinary\Uploader::upload($file->getTempName());
    		    $usersImage = new UsersImage();
                $usersImage->public_id = $ret['public_id'];
                $usersImage->uuid = $uuid;
                $usersImage->type = $type;
                if ($usersImage->create() == true) {
                    $result['success'] = true;
                }
            }
        }
        return $this->json($result);      
    }
 
    public function get_profileAction()
    {
        $this->view->disable();
        $result = array();
        $result['success'] = false;
        
        if($this->request->isPost() == true){
            $uuid = $this->request->getPost("uuid");
            $usersImage = UsersImage::findFirst(array(
                "uuid = '$uuid'",
                "type = 'profile'",
                "order" => "modified_in desc"
                )
            );
            $result['success'] = true;
            $result['image'] = $usersImage;
        }
        return $this->json($result);      
    }

}