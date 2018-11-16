<?php
namespace blogApp\core;
/**
* Class Autoloader
* Permet de charger dynamiquement une class
*/
class Autoloader
{
    /**
     * Enregistre notre autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    /**
    * Inclue le fichier correspondant à notre classe
    * @param string $class Nom de la class à charger
    */
    static function autoload($class)
    {
        // Uniquement si présent dans notre namespace
        if (strpos($class, 'blogApp' .  '\\') === 0) {
            $class = str_replace('blogApp' . '\\','', $class);
            $class = str_replace('\\','/', $class);
            $classPath = "../" . $class . '.php';
            if (!file_exists($classPath)) {
                header('HTTP/1.0 404 Not Found');
                exit();
            }
            require $classPath;
        }
    }

}
