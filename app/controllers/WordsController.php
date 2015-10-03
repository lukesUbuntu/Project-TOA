<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class WordsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for words
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Words", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "index";

        $words = Words::find($parameters);
        if (count($words) == 0) {
            $this->flash->notice("The search did not find any words");

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $words,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a word
     *
     * @param string $index
     */
    public function editAction($index)
    {

        if (!$this->request->isPost()) {

            $word = Words::findFirstByindex($index);
            if (!$word) {
                $this->flash->error("word was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "words",
                    "action" => "index"
                ));
            }

            $this->view->index = $word->index;

            $this->tag->setDefault("index", $word->index);
            $this->tag->setDefault("mri_word", $word->mri_word);
            $this->tag->setDefault("eng_word", $word->eng_word);
            $this->tag->setDefault("img_src", $word->img_src);
            $this->tag->setDefault("desc", $word->desc);
            $this->tag->setDefault("audio_src", $word->audio_src);

        }
    }

    /**
     * Creates a new word
     */
    public function createAction()
    {


        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "index"
            ));
        }

        $word = new Words();

        $word->mri_word = $this->request->getPost("mri_word");
        $word->eng_word = $this->request->getPost("eng_word");
        $word->img_src = $this->request->getPost("img_src");
        $word->desc = $this->request->getPost("desc");
        $word->audio_src = $this->request->getPost("audio_src");



        if (!$word->save()) {
            foreach ($word->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "new"
            ));
        }

        $this->flash->success("word was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "words",
            "action" => "index"
        ));

    }

    /**
     * Saves a word edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "index"
            ));
        }

        $index = $this->request->getPost("index");

        $word = Words::findFirstByindex($index);
        if (!$word) {
            $this->flash->error("word does not exist " . $index);

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "index"
            ));
        }

        $word->mri_word = $this->request->getPost("mri_word");
        $word->eng_word = $this->request->getPost("eng_word");
        $word->img_src = $this->request->getPost("img_src");
        $word->desc = $this->request->getPost("desc");
        $word->audio_src = $this->request->getPost("audio_src");


        if (!$word->save()) {

            foreach ($word->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "edit",
                "params" => array($word->index)
            ));
        }

        $this->flash->success("word was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "words",
            "action" => "index"
        ));

    }

    /**
     * Deletes a word
     *
     * @param string $index
     */
    public function deleteAction($index)
    {

        $word = Words::findFirstByindex($index);
        if (!$word) {
            $this->flash->error("word was not found");

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "index"
            ));
        }

        if (!$word->delete()) {

            foreach ($word->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "words",
                "action" => "search"
            ));
        }

        $this->flash->success("word was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "words",
            "action" => "index"
        ));
    }

}
