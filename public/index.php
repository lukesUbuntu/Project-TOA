<?php
namespace project\toa;
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";





    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);


    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
