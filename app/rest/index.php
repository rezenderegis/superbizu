<?php
//Autoload
$loader = require 'vendor/autoload.php';
 
//Instanciando objeto
$app = new \Slim\Slim(array(
    'templates.path' => 'templates'
));
 
//Listando todas
$app->get('/usuarios/', function() use ($app){
	(new \controllers\Login($app))->lista();
});
 
//get pessoa
$app->get('/usuarios/:id', function($id) use ($app){
	(new \controllers\Login($app))->get($id);
});
 
//Rodando aplicação
$app->run();