<?php
/**
 * Created by PhpStorm.
 * User: 9901623
 * Date: 2/09/2015
 * Time: 12:02 PM
 */

namespace Games\Plugin;

use \Phalcon\Config;


class Plugin
{
    private $separator = null;

    private $current_folder = null;

    private $config_file = null;

    private $game_folders = array();

    /***
     * @param $configFile | JSON file that will be in folder
     */
    public function __construct($configFile = "config.json"){

        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);



        //define our OS separator for file paths
        $this->separator = DIRECTORY_SEPARATOR;

        //@todo setting the game folder this needs to come from config
        $this->current_folder = getcwd()."/../games";

        //define our JSON config file we are reading
        $this->config_file = $configFile;

        //pass check get
        //$this->checkGames();
    }

    /**
     * checkConfig
     * @return a json config if there is a config file
     */
    private function checkConfig($gameFolder){

        //if the file exists lets check the json is valid
        if (file_exists($this->getConfigFile($gameFolder))) {
            //get the json file contents
            $game_data = file_get_contents($this->getConfigFile($gameFolder));

            if ($game_json = json_decode($game_data)){
                //have a valid json lets add additional data
                $game_json->prefix = trim($gameFolder);

                //lets check if game is in db
                $game = \Game::findFirst("prefix = '$gameFolder'");

                if($game && $game->count() > 0){
                    //var_dump($game);exit;
                    $game->add($game_json);
                    $game->save();

                }else{
                    $NewGame = new \Game;
                    //push any changes
                    $NewGame->add($game_json);
                    $NewGame->save();

                }
                unset($game);
            }
        }

    }

    /**
     * checkNewGames
     * @description checks and updates any new games
     * @return null
     */
    public function checkNewGames(){
        //check if we have already have game folders
        if (count($this->game_folders) > 0)
            return $this->game_folders;

        //grab all game folders
        $dir = new \DirectoryIterator($this->current_folder);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                //add game folder to our array
                $this->game_folders[] = $fileinfo->getFilename();

                //check game folder for config file
                $this->checkConfig($fileinfo->getFilename());
            }
        }
        //return $this->game_folders;
    }

    /**
     * getConfigFile
     * @return a full path to the game config file in a plugin
     */
    private function getConfigFile($folderName){
        //will return something like /home/toa/public_html/project-toa/games/thegame/config.json
        //or c:\xampp\htdocs\project-toa\games\thegame\config.json
        return $this->current_folder.$this->separator.$folderName.$this->separator.$this->config_file;
    }

    /**
     * addGame
     * @description adds game to database/model
     */
    private function addGame($gameData){
        //game modal will handle if correct data
        $new_game = new \Game();
        $new_game->add($gameData);
        $new_game->save();
    }
    public function runAsCron(){


        //check games for additions
        $this->checkNewGames();

        //count all games in system see if we need to do a internal scan
        $Games = new \Game;

    }

    public function runGame($prefix){
        $Games = new \Game;
        $exist = $Games::findFirst(array(
            'prefix'=>$prefix,
        ));

        if(!$exist)
            return "Game does't exist";

        ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
        <?
        require $exist->path();

    }
}