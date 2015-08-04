<?php

use Phalcon\Mvc\Controller;

//extend ControllerBase to include login checks in other controllers when needed

class ControllerBase extends Controller
{
    //constructor
    public function initialize(){
        //check user is logged in otherwise redirect to /LoginController
        if (!Sentry::check())
        {
            // User is not logged in, or is not activated
            $this->view->disable();
            $this->response->redirect('login');
        }
    }


}
