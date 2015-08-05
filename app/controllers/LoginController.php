<?php

class LoginController extends \Phalcon\Mvc\Controller
{


    public function indexAction()
    {

    }

    /**
     * Checks the users details and logins them into members
     */
    public function checkAction()
    {
        //preset our error if any
        $errors = array();

        //get email or return false
        $email = $this->request->getPost("email",null,false);

        if ($email == false)$errors[] = "Missing email address";

        $password = $this->request->getPost("password",null,false);
        if ($password == false)$errors[] = "Missing password";

        //check errors if any return back to login screen
        if (count($errors) > 0){

            //set any errors
            foreach ($errors as $error)
            $this->flash->error($error);

            //return user to login
           return $this->response->redirect('login');
        }
        //get sentry to authenticate
        try{

            $user = Sentry::authenticate(array(
                'email'    => $email,
                'password' => $password,
            ));
            //login user
            Sentry::login($user, false);
            return $this->response->redirect('index');

        }catch(\Exception $e){
            //get the error message
            $this->flash->error($e->getMessage());

            //return user to login
            return $this->response->redirect('login');
        }
    }

}

