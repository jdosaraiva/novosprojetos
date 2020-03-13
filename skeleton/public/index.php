<?php

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);
$request = $creator->fromGlobals();

$classController = $rotas[$caminho];

/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/dependencies.php';

/** @var RequestHandlerInterface $controller */
$controller = $container->get($classController);
$response = $controller->handle($request);

(new SapiEmitter())->emit($response);
