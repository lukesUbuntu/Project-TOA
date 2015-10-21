<?php
use Phalcon\Http\Request;

class LoginController extends \Phalcon\Mvc\Controller
{

    private $_request = null;
    private $getRequest = false;
    private $url = false;

    /**
     * Controller constructor
     * @return mixed
     */
    public function initialize(){
        //don't show navbar
        $this->view->show_navigation = false;
        //set our redirect URL if defined
        $redirectTo = $this->Request()->getQuery("url", null, false);
        $this->url = $redirectTo != false ? $redirectTo : 'index';

        //pass on any getRequest to the post url
        $this->getRequest = str_replace('/login', '', $this->Request()->getURI());
        //pass the any view the getRequest
        $this->view->setVar("getRequest", $this->getRequest);


        //load any assets for this controller
        $this->assets->addJs('js/login.js');
        $this->assets->addCss('css/login.css');


        //check we not already logged in
        if (Sentry::check())
        {

            return $this->response->redirect($this->url);
        }
    }

    protected function Request()
    {
        if ($this->_request == null)
            $this->_request = new Phalcon\Http\Request();

        return $this->_request;
    }

    public function indexAction()
    {
        $this->view->login_tab = "login_form";
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
                'password' => $password
            ));

            //login user
            Sentry::login($user, false);
            $_SESSION['user_id'] = Sentry::getUser()->id;


            return $this->response->redirect($this->url);

            //return $this->response->redirect('index');

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
     * @param array $errors
     * @return bool | returns false if no errors else returns the re
     */
    private function errorCheck($errors = array())
    {
        if (count($errors) > 0 && $errors != false) {
            //set any errors
            foreach ($errors as $error)
                $this->flash->error($error);



            //return user to login and render errors
            return $this->view->render('login', 'index');
        }
        return false;
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

        //Username
        $username = $this->request->getPost("username", null, false);
        if ($username == false) $errors[] = "Missing username";
        else
            $username = strtolower($username);//lowercase username

        //get our posts required
        $email = $this->request->getPost("email", null, false);
        if ($email == false) $errors[] = "Missing email address";


        $password = $this->request->getPost("password", null, false);
        if ($password == false) $errors[] = "Missing password";

        $confirm = $this->request->getPost("confirm", null, false);
        if ($confirm == false) $errors[] = "Missing confirm password";

        if ($confirm != false && $confirm != $password)
            $errors[] = "Passwords don't match";

        //lets check username is okay
        //pattern for username
        $usernamePattern = '^[a-z0-9_-]{3,15}$';
        $exists = Users::find("username = '$username'");
        if (count($exists) > 0)$errors[] = "username exists";
        else
        if (!preg_match($usernamePattern,$username))
            $errors[] = "username doesn't match requirements
            <ul>
                <li>3 - 15 chars</li>
                <li>letters and numbers only</li>
                <li>No spaces</li>
            </ul>
            ";

        //present
        $this->view->setVar("username", ($username == false)?  '': $username);
        $this->view->setVar("email", ($email == false) ?  '':$email);
        $this->view->setVar("password", ($password == false) ? '' : $password);


        //check any errors
        $errors = $this->errorCheck($errors);
        if ($errors != false) return $errors;






        /** safe to register user below this point **/

        try {
            // Let's register a user.
            $user = Sentry::register(array(
                'email' => $email,
                'password' => $password,
                'username' => $username,
                'activated' => true  //activate user
            ));
            // Send activation code to the user so he can activate the account
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $errors[] = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $errors[] = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $errors[] = 'User with this login already exists.';
        }



        //check any errors
        $errors = $this->errorCheck($errors);
        if ($errors != false) return $errors;

        // Authenticate the user and log them in
        $this->view->login_tab = "login_form";
        $this->flash->error("Account Created! for $email");

        //Sentry::login($user, false);
        return $this->view->render('login', 'index');

    }

}

