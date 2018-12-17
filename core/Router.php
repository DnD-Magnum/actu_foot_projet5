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
	'/$' => 'BlogController@recentPosts',
    '/toutes-les-news' => 'BlogController@allPosts',
    '/post' => 'BlogController@post',
    '/mini-jeux' => 'BlogController@game',
    '/contact$' => 'BlogController@contact',
    '/categorie/' => 'BlogController@addPostCategorie',
    '/addcomment' => 'BlogController@addComment',
    '/signalcomment' => 'BlogController@signalComment',
    '/admin$' => 'AdminController@allPostsAdmin',
    '/admin/editer-post' => 'AdminController@editPost',
    '/admin/modifier-post' => 'AdminController@modaratePost',
    '/admin/newpost' => 'AdminController@newPost',
    '/admin/configurepost' => 'AdminController@configuratePost',
    '/admin/configurecomment' => 'AdminController@configurateComment',
    '/admin/comment' => 'AdminController@modarateComment',
    '/verifypass' => 'AdminController@adminConnect',
    '/deconnexion' => 'AdminController@disconect',
    '/admin-login$' => 'AdminController@login'
	];


	/**
	 * Cherche une correspondance entre l'url et un chemin du tableaux router ci-dessus
	 * Si correspondance instancie le bon controller et apelle la fonction associer en clef
	 */
	public function run()
	{
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		$path = str_replace(PATH_PREFIX_P5 ,"",$uri[0]);
		$adminVerify = explode('/', $path);

		\blogApp\core\Csrf::verifyToken();
		if (isset($adminVerify[1]) && $adminVerify[1] == 'admin' && !isset($_SESSION['connect'])) 
		{
			header('location: ' . PATH_PREFIX_P5 . '/admin-login');
			exit();
		} else 
		{
			foreach($this->_router as $key => $route) 
			{
				if (preg_match('#^' . $key . '#', $path)) 
				{
					$run = explode('@', $route);
					$run[0] = "\blogApp\src\controller\\" . $run[0];
					$controller = new $run[0]();
					$controller->{$run[1]}();
				} 
			}
		}
	}
	
}