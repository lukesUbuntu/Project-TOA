<?php
use Phalcon\Mvc\Controller;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

class AdminController extends ControllerBase
{
    public function initialize(){
        $this->view->show_navigation = true;
    }

    /**
     * Pass data to all the templates if user is logged in
     */
    public function passAdmin(){
        //show nav
        $User = $this->loginCheck();
        $this->view->setVar("User", $User);   //checks login and pass's admins details
        $this->view->setVar("Admin",$this->isAdmin);
        $this->view->show_navigation = true;

    }
    public function indexAction()
    {
        $this->passAdmin();
    }

    /**
     * Override the default controllerBase login checks as we want to check for admin login.
     * @param string $redirectTo
     * @return Users |
     */
    public function loginCheck($redirectTo = 'admin')
    {

        if (!Sentry::check()) {
            //Module

            // User is not logged in, or is not activated
            $this->view->disable();
            header('Location: '.$this->config->baseUri.'login?url=' . $redirectTo);
            die();
        }

        //get the usersID
        $userId = Sentry::getUser()->id;

        $userProfile = Users::findFirst($userId); //get the actual user:Object from model

        //aget the user from sentry to check against admin group
        $user = Sentry::findUserByID($userId);

        //get admin group and check if user is an admin
        $admin = Sentry::findGroupByName('Administrator');

        // Check if the user is in the administrator group
        if (!$user->inGroup($admin)) {
            //add user to group for now
            //if (Sentry::getUser()->addGroup($admin));
            // User is not in Administrator group
            die ("Not Administrator Account");//@todo return user to an error page
        }

        //return the $userprofile
        return $userProfile;
    }

    /**
     * Words Action View
     */
    public function wordsAction(){
        $this->passAdmin();
        //render the list of current words in system
        $WordsList = \Words::find();

        $this->assets
            ->addJs('/cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js')
            ->addJs('/cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js')
            ->addJs('js/words.js');

        $this->view->partial('admin/words/listWords', array('WordsList' => $WordsList));

       // die();


    }
    public function ConfigAction(){
        echo "Testing";
        $test = $this->view->getRender('admin/users', 'index');

    }
    /**
     *  Users Action View
     */
    public function usersAction(){
        $this->passAdmin();
        //Get all the users
        $users = \Users::find();

        //get admin group and check if user is an admin
        $admin = Sentry::findGroupByName('Administrator');

        //find what users are admin
        $allUsers = array();
        foreach($users as $thisUser)
        {
            $tmpUser = Sentry::findUserByID($thisUser->id);
            $thisUser->admin = $tmpUser->inGroup($admin);

            $allUsers[] = $thisUser;
        }

        //render view
        $this->view->setVar("Users",$allUsers);
        // if (!$user->inGroup($admin)) {
        echo $this->view->getRender('admin/users', 'index');
    }
    /**
     * Installer for when moving to another system
     */
    public function installAction(){
        $ConfigWriteAble = false;
        //check the file perms of \app\config
        $configFile = getcwd().'/../app/config/config.php';
        if (is_writable($configFile)) {
            $ConfigWriteAble = true;
            echo 'Config file is writable<p>';
        } else {
            echo "Config file is not writable. Please run <pre>$ chmod 777 $configFile</pre>  or edit config manually<p>";
        }
        //lets check adminGroup
        //get admin group and check if user is an admin
        try{
            $admin = Sentry::findGroupByName('Administrator');
            echo "Group Check Fine<p>";

        }catch (Exception $message){
            //end up here no Administrator group
            //lets create
            // Create the group
            Sentry::createGroup(array(
                'name'        => 'Administrator',
                'permissions' => array(
                    'admin' => 1,
                    'users' => 1,
                ),
            ));
        }

        if ($ConfigWriteAble){
            //get the current config options.
            $dbPassword = $this->readConfigLine('password',$configFile);
            $dbName = $this->readConfigLine('dbname',$configFile);
            $dbUsername = $this->readConfigLine('username',$configFile);
            $gameWebRoot = $this->readConfigLine('gameWebRoot',$configFile);
            $baseUri = $this->readConfigLine('baseUri',$configFile);
        }

    }

    /**
     * @param $configLine | line of the config/setting to fetch
     */
    public function readConfigLine($configLine,$configFile){
        //'password'\s+=>\s'(.*?)'
        $configOptions = file_get_contents($configFile);
        $pattern = "/'$configLine'\\s+=>\\s'(.*?)'/";

        if (preg_match($pattern,$configOptions,$matches)){
            return $matches[1];
        }
        return false;
    }

}

