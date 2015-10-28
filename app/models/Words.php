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
    public $img_src1;

    /**
     *
     * @var string
     */
    public $word_desc;

    /**
     *
     * @var string
     */
    public $img_src2;

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

    /**
     * @param $word | Updates the word record
     */
    public function wordUpdate($word){
        $this->mri_word = $word->mri_word;
        $this->eng_word = $word->eng_word;
        $this->word_desc = $word->word_desc;
        //$this->img_src1 = $this->cleanLink($word->img_src1);
        //$this->img_src2 = $this->cleanLink($word->img_src2);
    }

    private function cleanLink($link){

        if (strlen($link) > 4){
            if (strpos($link, 'http') === 0) {
                return $link;
            }
            return 'http://'.$link;
        }

        return "";
    }





}
