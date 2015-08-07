<?php



class IndexController extends ControllerBase
{

    /**
     * Display Login View
     */
    public function indexAction()
    {


    }

    /**
     * logs the user out
     */
    public function logoutAction()
    {

        if (Sentry::check()){
            Sentry::logout();
            return $this->response->redirect('index');
        }

    }

}

