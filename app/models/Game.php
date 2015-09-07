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
     * Initialize method for model.
     */
    public function initialize()
    {

        $this->addBehavior(new Phalcon\Mvc\Model\Behavior\Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'created_at',
                'format' => 'Y-m-d H:i:s'
            )
        )));
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
            'prefix' => 'prefix',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at'
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
        $this->start_file = $gameData->start_file;
    }
    /**
     * Returns the game path
     */
    public function path(){
        return $this->prefix.DIRECTORY_SEPARATOR.$this->start_file;
    }

    /**
     * Define what information is allowed from Users to API
     */
    public function apiCall(){
        //unset important attributes they don't need
        return $this->toArray();
    }


}
