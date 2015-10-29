<?php
use Phalcon\Mvc\Controller;


class ApiController extends ControllerBase
{
    //holder for our api libary
    private $_api = null;

    private $_request = null;
    /**
     * Construct
     */
    public function onConstruct(){
        //disable view
        $this->view->disable();
        //$this->_request = new Phalcon\Http\Request();
    }
    /**
     *
     */
    public function indexAction()
    {
        return $this->Api()->response("Incorrect API call",false);
    }

    /**
     * API
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

    /**
     * @api {get} /user Return the current user
     * @apiName userAction
     *
     * @apiDescription Returns the current logged in users information
     *
     * @apiExample Example usage:
     * http://localhost/api/user
     *
     * @apiSuccess {Int}      id            Users ID
     * @apiSuccess {String}   first_name    Users First name
     * @apiSuccess {String}   last_name     Users Last name
     * @apiSuccess {String}   email         User email address
     * @apiSuccess {String}   permissions   permissions is admin (currently not implmented)
     * @apiSuccess {String}   activated     Is the users account activated or enabled
     * @apiSuccess {String}   last_login    Date time stamp of last login
     * @apiSuccess {String}   created_at    Date time stamp when account was registered
     *
     *
     * @apiError no user logged in
     *
     * @apiErrorExample {json} Failed-Response:
     *    {
     *       "success": false,
     *       "data": "no user logged in"
     *       }
     * @apiSuccessExample {json} Success-Response:
     * {
     *      "success": true,
     *          "data": {
     *              "id":           "2",
     *              "email":        "test@test.com",
     *              "permissions":  null,
     *              "activated":    "1",
     *              "activated_at": null,
     *              "last_login":   "2015-08-27 00:34:53",
     *              "first_name":   null,
     *              "last_name":    null,
     *              "created_at":   "2015-08-07 22:15:06",
     *              "updated_at":   "2015-08-27 00:34:53"
     *
     * }
     * }
     */
    public function userAction()
    {
        try {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in", false);

            // Get the current active/logged in user
            $user = Users::findFirst(Sentry::getUser()->id);

            return $this->Api()->response($user->apiCall(), true);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in", false);
        }
    }

    /**
     * @api {get} /words Returns list of words with description english and maori
     *
     * @apiName words
     *
     * @apiDescription returns users current feathers owned
     *
     * @apiExample Example usage:
     * http://localhost/api/words
     *
     * @apiSuccess {Int}      index  index of item
     * @apiSuccess {String}   mri_word  maori word
     * @apiSuccess {String}   eng_word  english translation of word
     * @apiSuccess {String}   img_src1   image1 src tag of word
     * @apiSuccess {String}   img_src2  image2 src tag of word
     * @apiSuccess {String}   desc      description of word
     *
     *
     * @apiSuccessExample {json} Success-response
     *{
     *  "success": true,
     *      "data": {
     *          "index": "2",
     *          "mri_word": "kia ora",
     *          "eng_word": "hello",
     *          "img_src": "",
     *          "desc": "",
     *          "audio_src": ""
     *      }
     *}
     */

    public function wordsAction()
    {
        //basic query call
        $url = str_replace('/api/words','',$this->Request()->getURI());
        $url = str_replace("?", "", $url);
        //"&word_desc&eng_word&limit=10&&random";

        //specify in_array security what calls above can be made
        $acceptableFlags = array('mri_word', 'eng_word', 'img_src1','img_src2', 'word_desc', 'audio_src', 'limit');




        //parse to our search array
        $searchFlag = array();
        $flags = array();
        $limit = false;
        //parse it
        parse_str($url,$searchFlag);

        //check if its a valid flag
        foreach($searchFlag as $flag => $value){
            if (!in_array($flag,$acceptableFlags)) return $this->Api()->response("Invalid Flag `$flag``",false);
        }



        //kill limit if passed
        if (isset($searchFlag['limit'])){
            //word limit
            $limit = $searchFlag['limit'];
            unset($searchFlag['limit']);
        }
        if (isset($searchFlag['random'])){
            //randomise wordlise
            unset($searchFlag['random']);
        }

        //unique flags
        foreach($searchFlag as $key => $value)
            $flags[] = $key. ' != "" ';

        //implode into our query
        $query = implode(' AND ', $flags);

        //check ? at 1st point of scring then remove
        $query = str_replace('?','',$query);

        //check if we have a limit on return
        if ($limit == false){
            $wordsData = \Words::find(
                array(
                    $query,
                    'order' => 'RAND()'
                )
            );
        }
        else{
            $wordsData = \Words::find(
                array(
                    $query,
                    'limit' => $limit,
                    'order' => 'RAND()'
                )
            );
        }


        return $this->Api()->response($wordsData->toArray(), true);
    }

    function addAnd($n)
    {
        return($n.' != ""');
    }

    protected function ifFlagExists($flagName){
        $theFlags = $this->Request()->getQuery($flagName, null, false);
        return ($theFlags !== false && gettype($theFlags) == "string");
    }

    /**
     * @api {get} /addFeather adds a feather to the users account
     *
     * @apiName addFeather
     *
     * @apiDescription adds a feather to the users account
     *
     * @apiExample Example usage:
     * http://localhost/api/addFeather
     * http://localhost/api/addFeather?amount=5 //adds 5 feathers (1 > 5 max)
     *
     * @apiSuccess {String}   data      updated
     *
     *
     */
    public function addFeatherAction()
    {
      try {
           //check if a user is logged in
           if (!Sentry::check())
               return $this->Api()->response("no user logged in", false);

           // Get the current active/logged in user
           $user = Users::findFirst(Sentry::getUser()->id);


           $feathers = $this->Request()->getQuery("amount", null, false);

           if ($feathers)
               $user->addFeathers($feathers);
            else
                $user->addFeather();


            $user->save();

            return $this->Api()->response("Updated", true);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
           // User wasn't found, should only happen if the user was deleted during api call
           return $this->Api()->response("no user logged in", false);
       }
    }
    /**
     * @api {get} /removeFeather removes a feather from the users account
     *
     * @apiName removeFeather
     *
     * @apiDescription removes a feather from the users account
     *
     * @apiExample Example usage:
     * http://localhost/api/removeFeather
     * http://localhost/api/removeFeather?amount=5 //adds 5 feathers (1 > 5 max)
     *
     * @apiSuccess {String}   data      updated
     *
     *
     */
    public function removeFeatherAction()
    {
        try {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in", false);

            // Get the current active/logged in user
            $user = Users::findFirst(Sentry::getUser()->id);


            $feathers = $this->Request()->getQuery("amount", null, false);

            if ($feathers)
                $user->removeFeathers($feathers);
            else
                $user->removeFeather();


            $user->save();

            return $this->Api()->response("Updated", true);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in", false);
        }
    }



    /**
     * @api {get} /getFeathers Returns the current users feather count
     *
     * @apiName getFeathers
     *
     * @apiDescription returns users current feathers owned
     *
     * @apiExample Example usage:
     * http://localhost/api/getFeathers
     *
     * @apiSuccess {Int}      feathers  Users feather count
     *
     * @apiError no feathers count
     *
     * @apiErrorExample {json} Failed-Login:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no user logged in"
     *     }
     * @apiErrorExample {json} Failed-Response:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no game data found for user"
     *     }
     * @apiSuccessExample {json} Success-response
     * {
     *   "success": true,
     *      "data": {
     *          "feathers": 0
     *      }
     *   }
     */
    public function getFeathersAction()
    {
        try {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in", false);

            // Get the current active/logged in user
            $user = Users::findFirst(Sentry::getUser()->id);


            return $this->Api()->response($user->getFeathers(), true);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in", false);
        }
    }

    /**
     * @api {get} /usersGames Returns all users games played
     *
     * @apiName usersGamesAction
     *
     * @apiDescription returns a list of the current logged in users games
     *
     * @apiExample Example usage:
     * http://localhost/api/usersGames
     *
     * @apiSuccess {Int}      game_game_id  Game ID of the game
     * @apiSuccess {Int}      game_score    Users current score on this game
     * @apiSuccess {Int}      users_id      User ID
     * @apiSuccess {Object}   game_details   Refer to Game::Object or api /listGames
     * @apiSuccess {Object}   user_details   Refer to User::Object or api /user
     *
     * @apiError no games in system
     *
     * @apiErrorExample {json} Failed-Login:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no user logged in"
     *     }
     * @apiErrorExample {json} Failed-Response:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no game data found for user"
     *     }
     * @apiSuccessExample {json} Success-Response:
     * {
     *      "success": true,
     *      "data": {
     *              "game_game_id": "7",
     *              "game_score": "100",
     *              "users_id": "2",
     *                  "game_details": {
     *                          "game_id": "7",
     *                          "name": "This is my test Game",
     *                          "description": "The description",
     *                          "start_file": "start.html",
     *                          "author": "James",
     *                          "prefix": "testgame"
     *              },
     *      "user_details": {
     *                  "id": "2",
     *                  "email": "test@test.com",
     *                  "permissions": null,
     *                  "activated": "1",
     *                  "activated_at": null,
     *                  "last_login": "2015-08-27 00:34:53",
     *                  "first_name": null,
     *                  "last_name": null,
     *                  "created_at": "2015-08-07 22:15:06",
     *                  "updated_at": "2015-08-27 00:34:53"
     *      }
     *  }
     * }
     */
    public function usersGamesAction()
    {
        try {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in", false);


            // Get the current active/logged in users game
            // $users_games = \UsersHasGame::findfirst(array('users_id' => Sentry::getUser()->id));
            $users_id = Sentry::getUser()->id;

            $users_games = \UsersHasGame::find("users_id = '$users_id'");


            //check if user has any games
            if (count($users_games) <= 0)
                return $this->Api()->response("no game data found for user", false);

            //loop users games
            $games = array();

            foreach ($users_games as $game) {

                if (!$this->gamePrefix)
                    $games[] = $game->apiCall();
                else //if we are called from within game then return just that users game details
                    if ($this->gamePrefix == $game->Game->prefix) {
                        $games = $game->apiCall();
                        break;
                    }


            }
            //if searching via prefix recheck game
            if (count($games > 0))
                return $this->Api()->response($games, true);


            return $this->Api()->response("no user games found", false);


        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in", false);
        }

    }

    /**
     * @api {get} /GamesScore  returns all games scores
     *
     * @apiName GamesScore
     *
     * @apiDescription returns all games and there scores
     *
     * @apiExample Example usage:
     * http://localhost/api/GamesScore
     *
     * @apiSuccess {Int}      game_id                   Game ID of the game
     * @apiSuccess {String}   name                      Name of game
     * @apiSuccess {String}   prefix                    Game prefix (refers to folder)
     * @apiSuccess {Object}   scores                    Lists all users scores for game
     * @apiSuccess {Int}      scores.id                 Users ID
     * @apiSuccess {String}   scores.email              Users Email
     * @apiSuccess {Int}      scores.feathers_earned    Users Email
     * @apiSuccess {String}   scores.username           Users username
     * @apiSuccess {Int}      scores.score              Users username
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *      "success": true,
     *      "data": {
     *               "19": {
     *                  "game_id": "19",
     *                  "name": "TBlocks",
     *                  "prefix": "tblocks",
     *                  "scores": [
     *                          {
     *                              "id": "7",
     *                              "email": "test2@gmail.com",
     *                              "feathers_earned": "341",
     *                              "username": "test3",
     *                              "score": "150150"
     *                          },
     *                          {
     *                              "id": "8",
     *                              "email": "tester@tester.com",
     *                              "feathers_earned": "16",
     *                              "username": "tester",
     *                              "score": "800"
     *                          }
     *                          ]
     *           }
     * }
     */
    public function GamesScoreAction()
    {



            // Get all games with scores
            $gamesData = \UsersHasGame::find();

            //store game users scores
            $gameScores = array();
            //store games
            $gameData = array();

            foreach($gamesData as $score){
                //store the game info into gameArray
                //$theGame =  $score->getRelated('Game');
                //$theUsers = $score->getRelated('Users');
                if (!isset($gameScores[$score->game_game_id]))
                $gameScores[$score->game_game_id] = $score->gameDetailsBrief();

                $gameScores[$score->game_game_id]['scores'][] = $score->userDetailsBrief();

            }



            return $this->Api()->response($gameScores, true);
    }

    /**
     * @api {get} /saveGameData?game_score=10   saves game data score
     *
     * @apiName usersGamesAction
     *
     * @apiDescription returns a list of the current logged in users games
     *
     * @apiExample Example usage:
     * http://localhost/api/saveGameData
     *
     * @apiSuccess {String}   data          updated game
     *
     * @apiError no games in system
     *
     * @apiErrorExample {json} Failed-Login:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no user logged in"
     *     }
     * @apiErrorExample {json} Failed-Response:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no game data found for user"
     *     }
     *
     * @apiErrorExample {json} Failed-Prefix:
     *     {
     *       "success"  :   false,
     *       "data"     :   "Failed prefix"
     *     }
     *
     */
    public function saveGameDataAction()
    {

        try {

            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in", false);

            // Get the current active/logged in users game
            $users_games = \UsersHasGame::findFirst(array('users_id' => Sentry::getUser()->id));
            //add expierance to user
            $this->addExperience();
            //we have valid user
            if (count($users_games) <= 0)
                return $this->Api()->response("no game data found for user", false);


            //get game_score
            $game_score = $this->Request()->getQuery("game_score", null, false);
            if ($game_score == false) return $this->Api()->response("game_score not supplied or 0 game score applied", false);


            //end here with prefix and score
            $game = \Game::findFirst("prefix = '$this->gamePrefix'");
            //->count()
            if ($game && count($game) > 0) {    //we have game
                //find the users current data else create new record

                //we have game object
                $game_id = $game->game_id;
                $users_id = Sentry::getUser()->id;


                $theGame = \UsersHasGame::findfirst("users_id  = '$users_id' AND game_game_id = '$game_id'");



                //$user->addExperience();

                if (!is_object($theGame) || count($theGame) <= 0){
                    $theGame = new \UsersHasGame;
                    //push any changes
                    $theGame->game_game_id = $game->game_id;
                    $theGame->game_score = $game_score;
                    $theGame->users_id = Sentry::getUser()->id;
                    //return $this->Api()->response("Updated game data, new score");
                }
                print_r($theGame->game_score);exit;
                //only update if new score is bigger
                if ($game_score > $theGame->game_score){
                    $theGame->game_score = $game_score;
                    $theGame->save();

                    return $this->Api()->response("updated game data");
                }


                return $this->Api()->response("not updated score same or lower");



            } else
                return $this->Api()->response("Invalid Prefix ".$this->gamePrefix, false);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in", false);
        }

    }
    /**
     * @api {get} /getGameScore   returns all game scores for your game
     *
     * @apiName getGameScore
     *
     * @apiDescription returns all game scores for your game or game_id
     *
     * @apiExample Example usage:
     * http://localhost/api/getGameScore
     * http://localhost/api/getGameScore?game_id=19
     *
     * @apiSuccess {Int}      game_id                   Game ID of the game
     * @apiSuccess {String}   name                      Name of game
     * @apiSuccess {String}   prefix                    Game prefix (refers to folder)
     * @apiSuccess {Object}   scores                    Lists all users scores for game
     * @apiSuccess {Int}      scores.id                 Users ID
     * @apiSuccess {String}   scores.email              Users Email
     * @apiSuccess {Int}      scores.feathers_earned    Users Email
     * @apiSuccess {String}   scores.username           Users username
     * @apiSuccess {Int}      scores.score              Users username
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *      "success": true,
     *      "data": {
     *              "game_id": "19",
     *               "name": "TBlocks",
     *               "prefix": "tblocks",
     *                  "scores": [
     *                          {
     *                              "id": "7",
     *                              "email": "test2@gmail.com",
     *                              "feathers_earned": "341",
     *                              "username": "test3",
     *                              "score": "150150"
     *                          },
     *                          {
     *                              "id": "8",
     *                              "email": "tester@tester.com",
     *                              "feathers_earned": "16",
     *                              "username": "tester",
     *                              "score": "800"
     *                          }
     *                          ]
     *           }
     * }
    */
    public function getGameScoreAction()
    {
        //can get game score from
        //get the game id
        $game_id = $this->Request()->getQuery("game_id", null, false);

        //if no game_id passed lets get the game for the rendered prefix
        if ($game_id == false){
            $game = \Game::findFirst("prefix = '$this->gamePrefix'");

            if ($game && count($game) > 0)
                $game_id = $game->game_id;
            else
            return $this->Api()->response("Invalid game_id or not loaded from a game", false);
        }


        // Get all games with scores
        $gamesData = \UsersHasGame::find("game_game_id = '$game_id' ");

        //store game users scores
        $gameScores= $gamesData[0]->gameDetailsBrief();

        foreach($gamesData as $score){
            $gameScores['scores'][] = $score->userDetailsBrief();
        }

        if (count($gameScores) > 0)
        return $this->Api()->response($gameScores, true);
        else
            return $this->Api()->response("Invalid game_id or not loaded from a game", false);
    }

    /**
     * @api {get} /listGames Returns all games
     * @apiName listGamesAction
     *
     * @apiDescription Returns all the games on the system from the plugin folder
     *
     * @apiExample Example usage:
     * http://localhost/api/listGames
     *
     * @apiSuccess {Int}      game_id       Game ID of the current game
     * @apiSuccess {String}   name          Name of the game
     * @apiSuccess {String}   description   Description of the game
     * @apiSuccess {String}   start_file    Start File that will be loaded
     * @apiSuccess {String}   author        Developer of the game
     * @apiSuccess {String}   prefix        Prefix folder name of the game
     *
     * @apiError no games in system
     *
     * @apiErrorExample {json} Failed-Response:
     *     {
     *       "success"  :   false,
     *       "data"     :   "no games in system"
     *     }
     * @apiSuccessExample {json} Success-Response:
     * {
     *      "success":true,
     *      "data":[
     *              {
     *                 "game_id":"7",
     *                  "name":"This is my test Game",
     *                  "description":"The description",
     *                  "start_file":"start.html",
     *                  "author":"James",
     *                  "prefix":"testgame"
     *              }
     *          ]
     * }
     */
    public function listGamesAction()
    {
        //get all games
        $games = Game::find();

        //check we have games
        if (count($games) <= 0)
            return $this->Api()->response("no games in system", false);

        //return all games
        return $this->Api()->response($games->toArray());

    }


    private function addExperience(){
        //update users experiance
        $users_id = Sentry::getUser()->id;
        $theUser = \Users::findFirst("id = '$users_id'");
        $theUser->addExperience();
        $theUser->save();

    }
}

