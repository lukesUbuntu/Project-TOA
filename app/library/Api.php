<?php
/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 4/08/2015
 * Time: 11:41 PM
 */

namespace Api\Response;


class Api
{
    private $cache = null;      //memcache
    public function __construct(){
        // Cache data for 5 mins
        $frontCache = new \Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 300
        ));
        //Create the Cache setting memcached connection options
        $this->cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
            'host' => 'localhost',
            'port' => 11211,
            'persistent' => false
        ));
    }

    /**
     * @param $data response to send back as JSON with Callback
     * @param bool|true $success
     * @param int $status_code of response default 200
     * @param string $status_message of response default OK
     */
    public function response($data, $success = true, $status_code = 200, $status_message = "OK")
    {

        //new response
        $response = new \Phalcon\Http\Response();
        //header('Access-Control-Allow-Origin: *');
        $response->setStatusCode($status_code, $status_message);
        $response->setContentType('application/json', 'utf-8');
        $response->setHeader('Access-Control-Allow-Origin', '*');
        //encode call
        $json = json_encode(array('success' => $success, 'data' => $data));
        //set response to send back check for callback
        $response->setContent(isset($_GET['callback'])
            ? "{$_GET['callback']}($json)"
            : $json);
        $response->send();
        exit; //kill from other processing
    }
}