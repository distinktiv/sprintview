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
    $rmFiles = $app['sprintview.getRmFile'];
    $rmFiles("../web/js/rm.json");
    return $app['twig']->render('layout.html',['name' => 'toto']);
});


/***********************/
//Helpers
/***********************/
$app['sprintview.getRmFile'] = $app->protect(function($file_path){
    $file_data = file_get_contents($file_path);
    $json_data = json_decode($file_data, true);
    if (is_array($json_data)) {
        foreach ($json_data as $data) {
                //echo $data;
        }
    }
});

$app->run();
?>

