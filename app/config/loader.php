<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
//register sentry namespace
$loader->registerNamespaces(
    array(
        "cartalyst\sentry"    => "vendor/Sentry/Cartalyst/"
    )
);
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir
    )
)->register();
