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
    $rmFiles = $app['sprintview.getManager'];
    $rm = $rmFiles("../web/js/rm.json");
    $pm = $rmFiles("../web/js/pm.json");
    return $app['twig']->render('layout.html',['rm' => $rm, 'pm'=>$pm]);
});


/***********************/
//Helpers
/***********************/
$app['sprintview.getManager'] = $app->protect(function($file_path){
    $file_data = file_get_contents($file_path);
    $json_data = json_decode($file_data, true);
    if (is_array($json_data)) {
        return $json_data[0];
    }
});


$app->run();
?>

