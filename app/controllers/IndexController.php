<?php

use  \Phalcon\Mvc\Model;

class IndexController extends ControllerBase
{

    public function initialize(){}
    /**
     * @description __construct
     */
    public function onConstruct(){ }


    /**
     * Display Login View
     */
    public function indexAction()
    {

        $this->loginCheck();
        //load our games into view

        $games = \Game::find();//get our games

        //scores
        $ScoreBoard = UsersHasGame::find(array("limit" => 5));



        $this->view->setVar("Admin",$this->isAdmin);

        $this->view->setVar("Games",$games);


        $this->view->setVar("ScoreBoard", $ScoreBoard);
    }





}

