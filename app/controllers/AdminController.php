<?php

class AdminController extends ControllerBase
{

    public function indexAction()
    {

        //check user is logged in and admin
        $this->loginCheck('admin');


        $user = Users::findFirst(Sentry::getUser()->id); //get user
        //scores

        $this->view->setVar("User", $user);


    }

}

