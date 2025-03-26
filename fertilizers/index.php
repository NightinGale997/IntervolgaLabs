<?php

function AutoLoader(string $className): void
{
    require_once $_SERVER["DOCUMENT_ROOT"] . '/fertilizers/' . str_replace('\\', '/', $className) . '.php';
}

spl_autoload_register('AutoLoader');

$routes = require __DIR__. '/routes.php';
$route = $_SERVER['REQUEST_URI'];
$routeFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $route, $matches)) {
        $routeFound = true;
        unset($matches[0]);
        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];
        $controller = new $controllerName();
        $controller->$actionName(...$matches);
        break;
    }
}

if (!$routeFound) {
    echo "404: Страница не найдена.";
}