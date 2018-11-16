<?php //controller principal
namespace blogApp\core;
/**
 * Class Controller
 * Controller principal
 * Gere les functions appeller dans les enfants
 */
class Controller
{

	protected $template;

	/**
     * Extrait les variables et renvoi la vue
     * @param chemin de la vue $string
     * @param extrait les variables $variable
     * Renvoie ver la vue
     */
	public function render($path, $vars = []){
		extract($vars);
		ob_start();
		require('../views/' . $path . '.php');
		$content = ob_get_clean();
		require('../views/' . $this->template . '.php');
	}

	/**
     * Methode qui renvoi ver la page d origine
     */
	public function redirectBack(){
		header('Location:' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	public function redirect($path){
		header('Location:' . PATH_PREFIX . $path);
		exit();
	}
}