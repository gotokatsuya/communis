<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    /**
     * 
     * @param array $content
     */
    protected function json($content=array()) {
        return $this->response->setContentType('application/json', 'UTF-8')->setContent(json_encode($content));
    }

	/**
     * 
     * @param int $code
     * @param array $content
     */
    protected function output($code, $content=array()) {
        //Header
        $this->response->setContentType('application/json')
                       ->setStatusCode($code, null)
                       ->sendHeaders();
        //Body
        $this->response->setJsonContent($content)
                       ->send();
    }
    
    public function notFoundAction() {
        $this->output(404);
    }
}
