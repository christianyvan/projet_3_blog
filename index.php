<?php
/**
 * On crée une intance de router et on appelle la fonction routeReq.
 * index.php fera office de controlleur frontal, à partir duquel le controlleur 
 * associé à l'action de l'utilisateur via le router sera utilisé.
 */

define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https":"http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once 'controllers/Router.php';
$router = new Router();
$router->routeReq();