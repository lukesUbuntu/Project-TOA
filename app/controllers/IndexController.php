<?php

use  \Phalcon\Mvc\Model;

class IndexController extends ControllerBase
{

    /**
     * @description __construct
     */
    public function onConstruct()
    {

    }

    /**
     * Display Login View
     */
    public function indexAction()
    {



        $this->loginCheck();
        //load our games into view
        $games = \Game::find();
        $this->view->setVar("Games",$games);
    }



}

