<?php

class Words extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $index;

    /**
     *
     * @var string
     */
    public $mri_word;

    /**
     *
     * @var string
     */
    public $eng_word;

    /**
     *
     * @var string
     */
    public $img_src;

    /**
     *
     * @var string
     */
    public $word_desc;

    /**
     *
     * @var string
     */
    public $audio_src;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'words';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Words[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Words
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    /**
     * apiCall
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function apiCall(){
        //unset important attributes they don't need
        return $this->toArray();
    }



}
