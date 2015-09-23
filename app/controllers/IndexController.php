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

        $games = \Game::find();//get our games
        $user = Users::findFirst(Sentry::getUser()->id); //get user

        $this->view->setVar("Games",$games);
        $this->view->setVar("User", $user);
    }



}

