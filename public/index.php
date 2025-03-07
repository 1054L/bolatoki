<?php
/*
use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
*/

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $kernel = new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    // $request = Request::createFromGlobals(); 
    // $response = $kernel->handle($request); 
    // $response = new \Symfony\Component\HttpFoundation\JsonResponse(['test' => 'ok']);
    // $response->send();
    // $kernel->terminate($request, $response); 
    return $kernel; 
};