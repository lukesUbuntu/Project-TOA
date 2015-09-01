<?php
/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 25/08/2015
 * Time: 6:17 PM
 * @description Plugin class to render all games into the Phalcon Framework
 */

namespace Module;

//@todo boostrap as micro application
//@todo check if any changes from game where made
/**
 * bootstrap phalcon
 */
$config = include __DIR__ . "/../app/config/config.php";

/**
 * Read auto-loader
 */
include __DIR__ . "/../app/config/loader.php";

/**
 * Read services
 */
include __DIR__ . "/../app/config/services.php";






/***
 * Class Plugin
 * @package Game\Plugin
 */
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

        //define our OS separator for file paths
        $this->separator = DIRECTORY_SEPARATOR;

        //current location we are in
        $this->current_folder = getcwd();

        //define our JSON config file we are reading
        $this->config_file = $configFile;

        //pass check get
        $this->checkGames();
    }

    /**
     * checkConfig
     * @return a json config if there is a config file
     */
    private function checkConfig($gameFolder){
        $Games = new \Game;
        //if the file exists lets check the json is valid
        if (file_exists($this->getConfigFile($gameFolder))) {
            $game_data = file_get_contents($this->getConfigFile($gameFolder));
            if ($game_json = json_decode($game_data)){
                //have a valid json lets add additional data
                $game_json->prefix = trim($gameFolder);
                //lets check if game is in db
                $exist = $Games::findFirst(array(
                    'prefix'=>$gameFolder,
                ));
                //if doesn't exist add game
                if(!$exist){
                    $this->addGame($game_json);
                }

            }
        }

    }

    /**
     * checkGames
     * @description checks and updates any new games
     * @return null
     */
    public function checkGames(){
        //check if we have already have game folders
        if (count($this->game_folders) > 0)
                return $this->game_folders;

        //grab all game folders
        $dir = new \DirectoryIterator($this->current_folder);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $this->game_folders[] = $fileinfo->getFilename();
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
    protected function runAsCron(){

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