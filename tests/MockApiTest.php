<?php
/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 4/08/2015
 * Time: 11:41 PM
 */

/*
  @description mocks the \Api\Reponse class
 */
class MockApi  {
    private $cache = null;      //memcache

    /**
     * @param $data response to send back as JSON with Callback
     * @param bool|true $success
     * @param int $status_code of response default 200
     * @param string $status_message of response default OK
     */
    public function response($data, $success = true, $status_code = 200, $status_message = "OK")
    {
        echo json_encode(array('success' => $success, 'data' => $data));

    }

}


class MockApiController extends  ApiController{
    private $_api = null;

    //public function initialize(){}

    protected function Api()
    {
        if($this->_api == null)
            $this->_api = new MockApi();

        return $this->_api;
    }
}