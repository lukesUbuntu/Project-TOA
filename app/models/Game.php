<?php



class Game extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $game_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $start_file;

    /**
     *
     * @var string
     */
    public $author;

    /**
     *
     * @var string
     */
    public $prefix;

    /**
     *
     * @var string
     */
    public $logo;

    /**
     *
     * @var boolean
     */
    public $enabled;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('game_id', 'Users_has_game', 'game_game_id', array('alias' => 'Users_has_game'));
    }

    /**
     * Before we create new record
     */
    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }
    /**
     * Before we update lets update update_at colum
     */
    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'game_id' => 'game_id', 
            'name' => 'name', 
            'description' => 'description', 
            'start_file' => 'start_file', 
            'author' => 'author',
            'logo'  =>  'logo',
            'prefix' => 'prefix',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'enabled' => 'enabled'
        );
    }

    /**
     * Adds the gamedata to model
     * @param $gameData
     */

    public function add($gameData){
        $this->author = $gameData->author;
        $this->name = $gameData->name;
        $this->prefix = $gameData->prefix;
        $this->description = $gameData->description;
        $this->logo = $gameData->logo;
        $this->start_file = $gameData->start_file;
    }
    /**
     * Returns the game path
     */
    public function path(){
        return $this->prefix.DIRECTORY_SEPARATOR.$this->start_file;
    }
    /**
     * Returns the game image
     */
    public function logo(){
        return (isset($this->logo) && strlen(trim($this->logo)) > 3) ? $this->prefix.DIRECTORY_SEPARATOR.$this->logo : '../public/images/gameImageDefault.png';
    }
    /**
 * Define what information is allowed from Users to API
 */
    public function apiCall(){
        //unset important attributes they don't need
        return $this->toArray();
    }

    /**
     * @return array | Returns basic information
     */
    public function basicData(){
        return array(
            'game_id' => $this->game_id,
            'name' => $this->name,
            'prefix' => $this->prefix
        );
    }

    public function isEnabled(){
        return ($this->enabled);
    }


}
