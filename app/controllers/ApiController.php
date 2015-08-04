<?php

class ApiController extends \Phalcon\Mvc\Controller
{
    //holder for our api libary
    private $api = null;

    //constructor
    public function initialize(){
        //disable view
        $this->view->disable();

        //setup our api lib
        $this->api = new \Api\Response\Api();
    }
    public function indexAction()
    {
        $this->api->response("Incorrect API call");
    }

}

