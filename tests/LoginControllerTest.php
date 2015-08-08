<?php
/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 8/08/2015
 * Time: 12:17 AM
 */


use project\toa;
use \Phalcon\Di;
use Phalcon\Mvc\View as View;

/**
 * Class UnitTest
 */
class LoginControllerTest extends \PHPUnit_Framework_TestCase
{
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
		//$this->controller = new LoginController;
        $this->controller = new LoginController();

        $this->view = new View();
        $this->di = DI::getDefault();
		parent::setUp();
	}
    /**
     * Returns the Di object
     * @return object
     */
    private function getDi(){
        return $this->di;
    }

    /**
     *  Test errorCheck on loginController
     */
	public function test_ErrorCheck(){
        $method = new ReflectionMethod(
            'LoginController', 'errorCheck'
        );
        //we are testing a private method so make it accessible
        $method->setAccessible(TRUE);

        $errors = $method->invoke(new LoginController);
        //should return false
        $this->assertEquals(false,
            $errors
        );

        //
        $errors = $method->invoke(new LoginController,array("error message 1","error message 2"));
        $this->assertEquals(false,
            $errors
        );
    }



}