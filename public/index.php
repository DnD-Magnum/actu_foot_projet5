<?php
/**
 * Lance une session
 * Demarre l' autoloader
 * Genere un jeton token (faille csrf) 
 * Require pour les fonction du Helpers
 * Lance la fonction run du router qui va emmener ver le bon controller
 */
session_start();
require('../core/Autoloader.php');
\blogApp\core\Autoloader::register();
\blogApp\core\Csrf::generateToken();
require_once("../core/Helpers.php");
$router = new blogApp\core\Router();
$router->run();
//var_dump(password_hash('12Ludoactufoot34', PASSWORD_DEFAULT));