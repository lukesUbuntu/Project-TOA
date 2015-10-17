<?php
use Phalcon\Mvc\Controller;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

class AdminController extends ControllerBase
{
    public function initialize(){
        //check user is logged in and admin
        $this->loginCheck('admin');
    }

    public function indexAction()
    {

        //get the current user logged in
        $userProfile = Users::findFirst(Sentry::getUser()->id); //get user

        $user = Sentry::findUserByID(1);

        //get admin group and check if user is an admin
        $admin = Sentry::findGroupByName('Administrator');

        //scores
        // Check if the user is in the administrator group
        if (!$user->inGroup($admin)) {
            // User is not in Administrator group
            die ("Not Administrator Account");//@todo return user to an error page
        }

        $this->view->setVar("User", $userProfile);


    }

}

