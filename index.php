<?php
session_start();

if (isset($_GET['p']))
    $params = explode('/', $_GET['p']);

if ((isset($params[0]) && !empty($params[0])
    && file_exists("controller/" . $params[0] . "_controller.php")))
    $controllerName = $params[0];
else
    $controllerName = 'home';

if (isset($params[2])) {
    $actionParam = array_slice($params, 2);
}

$actionName = isset($params[1]) ? $params[1] : 'index';

require_once("controller/" . $controllerName . "_controller.php");

$controller = new $controllerName;

if (!method_exists($controller, $actionName)) {
    $actionName = 'index';
}

if (isset($actionParam)){
    $controller->$actionName($actionParam);
}
else {
    $controller->$actionName();
}

?>