<?php

require_once __DIR__.'/../vendor/autoload.php';

use classes\controllers\GoodController;
use classes\controllers\HarvestController;
use classes\controllers\SaleController;
use classes\controllers\CollectorController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->before(function (Request $request) {
    if ($request->getMethod() === 'OPTIONS') {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods',
            'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers',
            'Content-Type');
        return $response;
    }
});

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods',
        'GET, POST, PUT, DELETE, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers',
        'Content-Type');
    return $response;
});

$app->get('/collector/list.json', function () use ($app) {
    $controller = new CollectorController();
    $list = $controller->actionList();
    return $app->json($list);
});

$app->post('/collector/add-item', function (Request $request) use ($app) {

    $controller = new CollectorController();
    $list = $controller->actionAdd($_POST,$_FILES);
    return $app->json($list);
});

$app->post('/collector/update-item', to: function (Request $request) use ($app) {
    $controller = new CollectorController();
    $list = $controller->actionEdit($_POST['id'],$_POST,$_FILES);
    return $app->json($list);
});

$app->post('/collector/delete-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $controller = new CollectorController();
    $result = $controller->actionDelete($data['id']);
    return $app->json($result);
});

$app->post('/collector/list_filtered.json', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $controller = new CollectorController();
    $list = $controller->actionFilter($data['full_name']);
    return $app->json($list);
});

$app->get('/harvest/list.json', function () use ($app) {
    $controller = new HarvestController();
    $list = $controller->actionList();
    return $app->json($list);
});

$app->post('/harvest/add', function (Request $request) use ($app) {

    $data = json_decode($request->getContent(), true);
    $controller = new HarvestController();
    $result = $controller->actionAdd($data['harvest']);
    return $app->json($result);
});

$app->post('/harvest/update', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $controller = new HarvestController();
    $result = $controller->actionEdit($data['harvest']['id'],$data['harvest']);
    return $app->json($result);
});

$app->post('/harvest/delete', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $controller = new HarvestController();
    $result = $controller->actionDelete($data['id']);
    return $app->json($result,200);
});

$app->post('/harvest/list_filtered.json', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $controller = new HarvestController();
    $list = $controller->actionFilter($data['collector_id']);
    return $app->json($list);
});


$app->run();