<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $permissions;

    /**
     *
     * @var integer
     */
    public $activated;

    /**
     *
     * @var string
     */
    public $activation_code;

    /**
     *
     * @var string
     */
    public $activated_at;

    /**
     *
     * @var string
     */
    public $last_login;

    /**
     *
     * @var string
     */
    public $persist_code;

    /**
     *
     * @var string
     */
    public $reset_password_code;

    /**
     *
     * @var string
     */
    public $first_name;

    /**
     *
     * @var string
     */
    public $last_name;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var integer
     */
    public $feathers_earned;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        //lets make sure username is unique
        $this->validate(new Uniqueness(array(
            "field"   => "username",
            "message" => "username is already taken"
        )));

        if ($this->validationHasFailed() == true) {
            return false;
        }


        return true;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'UsersHasGame', 'users_id', array('alias' => 'UsersHasGame'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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
            'id' => 'id',
            'email' => 'email',
            'password' => 'password',
            'permissions' => 'permissions',
            'activated' => 'activated',
            'activation_code' => 'activation_code',
            'activated_at' => 'activated_at',
            'last_login' => 'last_login',
            'persist_code' => 'persist_code',
            'reset_password_code' => 'reset_password_code',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'feathers_earned' => 'feathers_earned',
            'username' => 'username'
        );
    }

    //return the current feathers of this user
    public function getFeathers()
    {
        if ($this->feathers_earned == null) $this->feathers_earned = 0;
        return array('feathers' => $this->feathers_earned);
    }

    //add feathers to the user
    public function addFeather()
    {
        $this->feathers_earned++;
    }

    //add feathers by amount
    public function addFeathers($amount)
    {
        if ($amount <= 5)
            $this->feathers_earned += $amount;

    }

    //remove feathers to the user
    public function removeFeather()
    {
        $this->feathers_earned--;
    }

    //remove feathers by amount
    public function removeFeathers($amount)
    {
        if ($amount <= 5)
            $this->feathers_earned -= $amount;

    }

    /**
     * Define what information is allowed from Users to API
     */
    public function apiCall(){

        return array(
            'id' => $this->id,
            'email' =>  $this->email,
            'permissions' =>  $this->permissions,
            'activated' =>  $this->activated,
            'activated_at' =>  $this->activated_at,
            'last_login' =>  $this->last_login,
            'first_name' =>  $this->first_name,
            'last_name' =>  $this->last_name,
            'created_at' =>  $this->created_at,
            'updated_at' =>  $this->updated_at,
            'feathers_earned' =>  $this->feathers_earned,
            'username' =>  $this->username
        );
        //unset important attributes they don't need
        //return $this->toArray();
    }


}
