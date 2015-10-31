<?php
use Phalcon\Mvc\Controller;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

class AdminController extends ControllerBase
{
    private $_api = null;

    private $_request = null;

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
        //load our global admins.js
        $this->assets->addJs('js/admin/admin.js');

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
        //render the list of current words in syste

        $WordsList = \Words::find();
        //attach our other libarys
        $this->addDataTables();
        $this->addUpload();

        $this->assets
            ->addJs('js/admin/words.js');
        $this->view->setVar('WordsList',$WordsList);

    }
    /**
     * Update a words Object
     */
    public function wordsAddAction(){
        $word = $this->Request()->getPost("word", null, false);

        $theWord = new \Words;
        $theWord->wordUpdate((object)$word);
        $theWord->save();
        return $this->Api()->response("updated");
    }
    /**
     * Update a words Object
     */
    public function wordsUpdateAction(){
        //grab word object we ar eupdating from
        $word = $this->Request()->getPost("word", null, false);

        /*
         * Array
            (
                [index] => 21
                [mri_word] => ra
                [eng_word] => sun
                [img_src1] =>
                [word_desc] =>
                [img_src2] =>
            )
         */
        if ($word != false){
            //we have a valid post to process lets move to object
            $word = (object)$word;

           $theWordRecord = \Words::findfirst("index = '$word->index'");

            //we have record lets update
            if ($theWordRecord && count($theWordRecord) > 0) {
                $theWordRecord->wordUpdate($word);
                $theWordRecord->save();
                $this->Api()->response("Updated record");
            }
                else
                    return $this->Api()->response("Failed. incorrect index", false);


        }

        return $this->Api()->response("Missing word data", false);
    }

    /**
     * Upload a image Object
     * https://docs.phalconphp.com/en/latest/api/Phalcon_Http_Request_File.html
     * Make sure the folder/assets folder is 755 - 777 this requires ReadWrite access
     */
    public function uploadWordImageAction()
    {


        $validImageExtension = array('jpg','jpeg','png','gif','bmp','');

        //Check if the user has uploaded files
        if ($this->Request()->hasFiles() == true) {
            //get the file [0] will be file 0 index
            $file = $this->Request()->getUploadedFiles()[0];

            //grab word object we ar eupdating from
            $index = $this->Request()->getPost("index", null, false);

            if ($index == false)
                return $this->Api()->response("Missing index data", false);

            $theWordRecord = \Words::findfirst("index = '$index'");

            //we have record lets update
            if ($theWordRecord && count($theWordRecord) > 0) {

                //lets check the file extension is okay
                if (!in_array(strtolower($file->getExtension()),$validImageExtension))
                    return $this->Api()->response("Invalid image format", false);


                //Print the real file names and their sizes
                $fileName = $index.'_'.$file->getKey().'_.'.$file->getExtension();
                $url = 'http://'.$this->Request()->getServerName().'/public/assets/imgs/'.$fileName;

                //save results
                if ($file->getKey() == 'img_src1')
                    $theWordRecord->img_src1 = $url;

                if ($file->getKey() == 'img_src2')
                    $theWordRecord->img_src2 = $url;

                //move file
                $assetsFolder = __DIR__ . '/../../public/assets/imgs/';
                //send back response
                $response['tag'] = $file->getKey();
                $response['url'] = $url;
                $response['message'] = 'updated';

                if ($file->moveTo($assetsFolder.$fileName)){
                    $theWordRecord->save();
                    return $this->Api()->response($response);
                }else{
                    $this->Api()->response("Failed to move file please check CHMOD", false);
                }


            }
            return $this->Api()->response("Missing word data or incorrect index", false);
        }

        return $this->Api()->response("Missing file attachment data", false);
    }
    /**
     * Delete a words Object
     */
    public function wordsDeleteAction(){
        //grab word object we ar eupdating from
        $word = $this->Request()->getPost("word", null, false);


        if ($word != false){
            //we have a valid post to process lets move to object
            $word = (object)$word;

            $theWordRecord = \Words::findfirst("index = '$word->index'");

            //we have record lets update
            if ($theWordRecord && count($theWordRecord) > 0) {
                $theWordRecord->delete();
                $this->Api()->response("Updated record");
            }
            else
                return $this->Api()->response("Failed. incorrect index", false);


        }

        return $this->Api()->response("Missing word data", false);
    }
    public function ConfigAction(){

        return "Sorry not enabled";

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

        //render the list of current words in system
        ///js/vendor/datatables/jquery.dataTables.js
        $this->addDataTables();
        $this->assets
            ->addJs('js/admin/users.js');
        //pass our users to view
        $this->view->setVar("Users", $allUsers);
        return $this->view->render('admin', 'users');

    }
    public function GamesAction(){
        $this->passAdmin();
        //Get all the users
        $games = Game::find();
        $this->addDataTables();

        $this->assets
            ->addJs('js/admin/games.js');

        $this->view->setVar("Games", $games);
        return $this->view->render('admin', 'games');

    }

    /**
     * Enable disable games for admin
     */
    public function adminGamesAction(){
        $index = $this->Request()->getPost("index", null, false);
        $action = $this->Request()->getPost("action", null, false);

        if ($index == false || $action == false)return $this->Api()->response("Missing invalid Index or Action", false);

        //get the game
        $theGame = Game::findFirst($index);
        if (!is_object($theGame))return $this->Api()->response("Invalid Game details", false);

        if ($action == 'disable'){
            $theGame->enabled = 0;
            $theGame->save();
            $this->Api()->response("Updated disabled");
        }

        if ($action == 'enable'){
            $theGame->enabled = 1;
            $theGame->save();
            $this->Api()->response("Updated enabled");
        }

        $this->Api()->response("Invalid Game Action", false);

    }

    /**
     * Remove admin account from admin permsions
     */
    public function usersAdminAction(){
        $user_index = $this->Request()->getPost("index", null, false);
        $action = $this->Request()->getPost("action", null, false);


        if ($user_index == false || $action == false)return $this->Api()->response("Missing invalid Index or Action", false);

        $user = Users::findFirst($user_index);
        //check user is auser
        if (!is_object($user))return $this->Api()->response("Invalid User details", false);

        //get admin group for adding or removing
        $admin = Sentry::findGroupByName('Administrator');

        //remove admin
        if ($action == 'removeAdmin'){
            //lets remove admin permision
            //aget the user from sentry to check against admin group
            $theAdmin = Sentry::findUserByID($user->id);

            // Check if the user is in the administrator group
            if ($theAdmin->inGroup($admin)) {
                $theAdmin->removeGroup($admin);
                return $this->Api()->response("Success user removed as admin");
            }
            return $this->Api()->response("User not in group", false);
        }

        //make admin
        if ($action == 'makeAdmin'){
            //lets remove admin permision
            //aget the user from sentry to check against admin group
            $theAdmin = Sentry::findUserByID($user->id);

            // Check if the user is in the administrator group
            if (!$theAdmin->inGroup($admin)) {
                $theAdmin->addGroup($admin);
                return $this->Api()->response("Success user is now admin");
            }
            return $this->Api()->response("User is already admin", false);
        }

        //delete user from system
        if ($action == 'delete'){
            //remove admin group if in.
            $theAdmin = Sentry::findUserByID($user->id);
            if ($theAdmin->inGroup($admin)) {
                $theAdmin->removeGroup($admin);
            }
            $gamesData = \UsersHasGame::find(array( 'users_id' => $user->id));

            if (is_object($gamesData) && count($gamesData) > 0){
                foreach($gamesData as $game){
                    if ($game->users_id == $user->id)$game->delete();
                }

            }


            $user->delete();
            //$gamesData->save();
            return $this->Api()->response("Success user removed as admin");
        }

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

    /**
     * Sending out our API Json Calls
     * @return \Games\Api\Api|null
     */
    protected function Api()
    {
        if ($this->_api == null)
            $this->_api = new Games\Api\Api();

        return $this->_api;
    }

    /**
     * @return null|\Phalcon\Http\Request
     */
    protected function Request()
    {
        if ($this->_request == null)
            $this->_request = new Phalcon\Http\Request();

        return $this->_request;
    }



}

