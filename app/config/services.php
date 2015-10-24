<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Returns a gamePrefix
 * @description returns the root folder of where the game location is. This is our game prefix
 * @todo resolve if gamewebroot incorrect use hostname as failed with wrong folder
 */
$di->set('gamePrefix', function () use ($config) {
    $request = new Phalcon\Http\Request();
    $gameFolder = $request->getServerName().$config->gameWebRoot;   //@todo check gameWebRoot if slash or not

    //simple regex the the config gameWebRoot folder and extract the first path after
    if (preg_match('#' . $gameFolder . '/(.*)/#', $request->getHTTPReferer(), $prefixs))
        return (count($prefixs) > 1) ? $prefixs[1] : false;

    return false;

}, true);
//return config file
$di->set('config', function () use ($config) {
    return $config;
}, true);



/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function() use ($config){
    return new DbAdapter(array(
        'host'        => $config->database->host,
        'username'    => $config->database->username,
        'password'    => $config->database->password,
        'dbname'      => $config->database->dbname,
    ));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();

    if ($session->session_id != "")
    $session->start();

    return $session;
});
/**
 * Store isAdmin as service
 */
$di->set('isAdmin', function () {
    $session = new SessionAdapter();
    if (!$session->has("admin")) {

        $userId = Sentry::getUser()->id;

        //aget the user from sentry to check against admin group
        $user = Sentry::findUserByID($userId);

        //get admin group and check if user is an admin
        $admin = Sentry::findGroupByName('Administrator');

        $session->set("admin",$user->inGroup($admin));

    }

    return $session->get("admin");
});
/**
 * Setup flash messages for alerts
 */
$di->set('flash', function() {
    return new \Phalcon\Flash\Session(array(
        'error' => 'alert alert-error',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
}, true);

