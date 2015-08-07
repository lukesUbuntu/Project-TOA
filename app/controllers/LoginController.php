<?php

class LoginController extends \Phalcon\Mvc\Controller
{

    /**
     * Controller constructor
     * @return mixed
     */
    public function initialize(){
        //load any assets for this controller
        $this->assets->addJs('js/login.js');
        $this->assets->addCss('css/login.css');
        //check we not already logged in
        if (Sentry::check())
        {
            return $this->response->redirect('index');
        }
    }


    public function indexAction()
    {

    }


    /**
     * Checks the users details and logins them into members
     */
    public function checkAction()
    {
        //tab we are on
        $this->view->login_tab = "login_form";

        //if we are not a post just render view
        if ($this->request->isPost() == false) {
            return $this->view->render('login', 'index');
        }

        //preset our error if any
        $errors = array();

        //get email or return false
        $email = $this->request->getPost("email",null,false);

        if ($email == false)$errors[] = "Missing email address";

        $password = $this->request->getPost("password",null,false);
        if ($password == false)$errors[] = "Missing password";

        //check any errors
        $errors = $this->errorCheck($errors);
        if ($errors) return $errors;


        /** safe to authenticate user below this point **/

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
            $errors[] = $e->getMessage();
            //return user to login
        }
        //re check any errors
        $errors = $this->errorCheck($errors);
        if ($errors) return $errors;

        return $this->response->redirect('login');
    }

    /**
     * Registers a user into system
     */
    public function registerAction()
    {
        //tab we are on
        $this->view->login_tab = "register_form";

        //if we are not a post just render view
        if ($this->request->isPost() == false) {
            return $this->view->render('login', 'index');
        }
        //preset our error if any
        $errors = array();

        //get our posts required
        $email = $this->request->getPost("email", null, false);
        if ($email == false) $errors[] = "Missing email address";

        $password = $this->request->getPost("password", null, false);
        if ($password == false) $errors[] = "Missing password";

        $confirm = $this->request->getPost("confirm", null, false);
        if ($confirm == false) $errors[] = "Missing confirm password";

        if($confirm !=false && $confirm != $password)
            $errors[] = "Passwords don't match";

        //check any errors
        $errors = $this->errorCheck($errors);
        if ($errors) return $errors;


       /** safe to register user below this point **/

        try
        {
            // Let's register a user.
            $user = Sentry::register(array(
                'email'    => $email,
                'password' => $password,
                'activated' => true,  //activate user
            ));
            // Send activation code to the user so he can activate the account
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $errors[] = 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $errors[] = 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $errors[] = 'User with this login already exists.';
        }

        //check any errors
        $errors = $this->errorCheck($errors);
        if ($errors) return $errors;


        // Authenticate the user and log them in
        Sentry::login($user, false);
        return $this->response->redirect('index');

    }


    /**
     * @param array $errors
     * @return bool | returns false if no errors else returns the re
     */
    private function errorCheck($errors = array()){
        if (count($errors) > 0){
            //set any errors
            foreach ($errors as $error)
                $this->flash->error($error);

            //return user to login and render errors
            return $this->view->render('login', 'index');
        }
        return false;
    }

}

