<?php 
namespace blogApp\core;

/**
 * Class Router
 * Recupere l url et instancie le bon controller et execute la bonne fonction
 */
class Router
{

	/**
	 * Tableau $_router
	 * Stock le chemin qui suit l'url de l index dans la clef
	 *  => Associe le chemin au controller a instancier @ Associe la fonction
	 */
	private $_router = [
	'/' => 'BlogController@recentPosts',
    '/toutes-les-news' => 'BlogController@allPosts',
    '/post' => 'BlogController@post',
    '/contact' => 'BlogController@contact',
    '/categorie/trophee-et-recompense' => 'BlogController@addPostCategorie',
    '/categorie/transfert' => 'BlogController@addPostCategorie',
    '/addcomment' => 'BlogController@addComment',
    '/signalcomment' => 'BlogController@signalComment',
    '/admin' => 'AdminController@allPostsAdmin',
    '/admin/editer-post' => 'AdminController@editPost',
    '/admin/modifier-post' => 'AdminController@modaratePost',
    '/admin/newpost' => 'AdminController@newPost',
    '/admin/configurepost' => 'AdminController@configuratePost',
    '/admin/configurecomment' => 'AdminController@configurateComment',
    '/admin/comment' => 'AdminController@modarateComment',
    '/verifypass' => 'AdminController@adminConnect',
    '/deconnexion' => 'AdminController@disconect',
    '/admin-login' => 'AdminController@login'
	];


	/**
	 * Pour separe les requete GET_ de l url actuel on le separe avec un explode
	 * On remplace le chemin de l'index de l url actuel par un vide avec str_replace 
	 * On verify le token avec la fonction verifyToken de la classe Csrf
	 * On verifie si on est dans la partie admin
	 * Si on est pas connecter et quon veut acceder a la partie admin -> login 
	 * Sinon compare l'url actuelle a la clef $_router avec un foreach
	 * Instancie le controller
	 * Appele la fonction
	 */
	public function run(){
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		$path = str_replace(PATH_PREFIX ,"",$uri[0]);
		$adminVerify = explode('/', $path);

		\blogApp\core\Csrf::verifyToken();
		if (isset($adminVerify[1]) && $adminVerify[1] == 'admin' && !isset($_SESSION['connect'])) {
			header('location: ' . PATH_PREFIX . '/admin-login');
			exit();
		} else {
			foreach($this->_router as $key => $route) {
				if ($path == $key) {
					$run = explode('@', $route);
					$run[0] = "\blogApp\src\controller\\" . $run[0];
					$controller = new $run[0]();
					$controller->{$run[1]}();
				} 
			}
		}
	}
}