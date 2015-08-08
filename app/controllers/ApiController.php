<?php
use Phalcon\Mvc\Controller;
class ApiController extends Controller
{
    //holder for our api libary
    private $_api = null;

    //constructor
    public function onConstruct(){
        //disable view
        $this->view->disable();


    }

    public function indexAction()
    {
        $this->Api()->response("Incorrect API call");
    }

    protected function Api()
    {
        if($this->_api == null)
            $this->_api = new \Api\Response\Api();

        return $this->_api;
    }

}

