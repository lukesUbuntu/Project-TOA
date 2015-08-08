<?php
/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 8/08/2015
 * Time: 12:17 AM
 * @description test unit for ApiController
 */


use project\toa;
use \Phalcon\Di;
use Phalcon\Mvc\View as View;

//require our mock test overrides
require_once("MockApiTest.php");

class ApiControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $api;
    /**
     * The controller instance
     * @var Object
     */
    protected $view;
    /**
     * The controller instance
     * @var Object
     */
    protected $controller;
    /**
     * The dependency object
     * @var Object
     */
    protected $di;

    /**
     * Set up the test environment
     * @return void
     */
    public function setUp()
    {
        //need to use mock feature to remove contructor and exit functions
        $this->controller = new  MockApiController;
        //setup our view if needed
        $this->view = new View();
        $this->di = DI::getDefault();
        //call parent setup if any
        parent::setUp();
    }

    /**
     * Returns the Di object
     * @return object
     */
    public function getDi(){
        return $this->di;
    }

    /**
     * Test for call api/
     */
    public function test_IndexAction(){
        //$this->controller->api = new MockApi();
        $this->controller->indexAction();
        //check api call response
        $this->expectOutputString('{"success":true,"data":"Incorrect API call"}');

    }
}
