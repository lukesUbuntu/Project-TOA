<?php

class UsersHasGame extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $game_game_id;

    /**
     *
     * @var integer
     */
    public $game_score;

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('game_game_id', 'Game', 'game_id', array('alias' => 'Game'));
        $this->belongsTo('users_id', 'Users', 'id', array('alias' => 'Users'));
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
            'game_game_id' => 'game_game_id', 
            'game_score' => 'game_score', 
            'users_id' => 'users_id'
        );
    }


    /**
     * Return the related "Game Data"
     *
     *
     * @return \apiCall[]
     */
    public function apiCall() {
        $data = $this->toArray();
        $data['game_details'] = $this->getRelated('Game')->apiCall();
        $data['user_details'] = $this->getRelated('Users')->apiCall();
        return $data;
    }



    /**
     * @return mixed | returns basic information on user
     */
    public function gameDetailsBrief()
    {
        return $this->getRelated('Game')->basicData();

    }
    /**
     * @return mixed | returns basic information on user
     */
    public function userDetailsBrief()
    {
        $data = $this->getRelated('Users')->basicData();
        $data['score'] = $this->game_score;
        return $data;
    }

}
