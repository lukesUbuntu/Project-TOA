<?php
use Phalcon\Mvc\Controller;


class ApiController extends ControllerBase
{
    //holder for our api libary
    private $_api = null;

    /**
     *
     */
    public function onConstruct(){
        //disable view
        $this->view->disable();

    }
    /**
     *
     */
    public function indexAction()
    {
        return $this->Api()->response("Incorrect API call",false);
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
    {
        "success": true,
            "data": {
                "id":           "2",
                "email":        "test@test.com",
                "permissions":  null,
                "activated":    "1",
                "activated_at": null,
                "last_login":   "2015-08-27 00:34:53",
                "first_name":   null,
                "last_name":    null,
                "created_at":   "2015-08-07 22:15:06",
                "updated_at":   "2015-08-27 00:34:53"
            }
    }
     */
    public function userAction()
    {
        try
        {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in",false);

            // Get the current active/logged in user
            $user = Users::findFirst( Sentry::getUser()->id);

            return $this->Api()->response($user->apiCall(),true);
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in",false);
        }
    }
    /**
     * @api {get} /usersGames Returns all users games
     * @api {get} /usersGames?prefix=test   Returns games matching test
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
    {
        "success": true,
            "data": {
                "game_game_id": "7",
                "game_score": "100",
                "users_id": "2",
                "game_details": {
                    "game_id": "7",
                    "name": "This is my test Game",
                    "description": "The description",
                    "start_file": "start.html",
                    "author": "James",
                    "prefix": "testgame"
                },
                "user_details": {
                    "id": "2",
                    "email": "test@test.com",
                    "permissions": null,
                    "activated": "1",
                    "activated_at": null,
                    "last_login": "2015-08-27 00:34:53",
                    "first_name": null,
                    "last_name": null,
                    "created_at": "2015-08-07 22:15:06",
                    "updated_at": "2015-08-27 00:34:53"
                }
            }
    }
     */
    public function usersGamesAction()
    {
        try
        {
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in",false);

            //possible get users game by prefix if passed
            $prefix = (isset($_GET['prefix'])) ? $_GET['prefix'] : false;



            // Get the current active/logged in users game
           // $users_games = \UsersHasGame::findfirst(array('users_id' => Sentry::getUser()->id));
            $users_id = Sentry::getUser()->id;

            $users_games = \UsersHasGame::find("users_id = '$users_id'");


            //check if user has any games
            if(count($users_games) <= 0)
                return $this->Api()->response("no game data found for user",false);

            //loop users games
            $games = array();
            foreach($users_games as $game){

                if (!$prefix)
                $games[] = $game->apiCall();
                else//condition
                    if ($prefix == $game->Game->prefix){
                        $games = $game->apiCall();
                        break;
                    }



            }
            //if searching via prefix recheck game
            if (count($games > 0 ))
                return $this->Api()->response($games,true);



                return $this->Api()->response("no user games found",false);




        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in",false);
        }

    }
    /**
     * Save game data
     * score
     */
    public function saveGameDataAction()
    {
        try
        {
            $GET = $_GET;
            //check if a user is logged in
            if (!Sentry::check())
                return $this->Api()->response("no user logged in",false);

            // Get the current active/logged in users game
            $users_games = \UsersHasGame::findFirst( array('users_id' => Sentry::getUser()->id));

            if(count($users_games) <= 0)
                return $this->Api()->response("no game data found for user",false);

            //we have valid user
            //get game_score
            if (!isset($GET['game_score']))  //move to phalcon ifnull
               return $this->Api()->response("Failed game_score",false);

             //get game_prefix
            if (!isset($GET['prefix']))  //move to phalcon ifnull
                return $this->Api()->response("Failed prefix",false);

            //end here with prefix and score
            $prefix = $GET['prefix'];
            $game_score = $GET['game_score'];
            $game = \Game::findFirst("prefix = '$prefix'");

            if($game && $game->count() > 0){    //we have game
              //we have game object
                $game_id = $game->game_id;
                $theGame = \UsersHasGame::findFirst("game_game_id = '$game_id'");
                if($theGame && $theGame->count() > 0){

                    $theGame->game_score = $game_score;
                    //var_dump($game);exit;
                    $theGame->save();
                    return $this->Api()->response("updated game");
                }else{
                    $NewGame = new \UsersHasGame;
                    //push any changes
                    $NewGame->game_game_id = $game->game_id;
                    $NewGame->game_score = $game_score;
                    $NewGame->users_id = Sentry::getUser()->id;
                    $NewGame->save();
                    return $this->Api()->response("updated game");
                }


            }else
            return $this->Api()->response("haxor",false);

        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // User wasn't found, should only happen if the user was deleted during api call
            return $this->Api()->response("no user logged in",false);
        }

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
            return $this->Api()->response("no games in system",false);

        //return all games
        return $this->Api()->response($games->toArray());

    }


    /**
     *
     */
    protected function Api()
    {
        if($this->_api == null)
            $this->_api = new Games\Api\Api();

        return $this->_api;
    }

}

