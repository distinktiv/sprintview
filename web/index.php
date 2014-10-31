<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

/***********************/
//Configurations
/***********************/
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(),array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// ... definitions


/***********************/
//Routing
/***********************/
$app->get('/', function() use($app) {
    return $app['twig']->render('layout.html',['name' => 'toto']);
});
$app->run();
?>

