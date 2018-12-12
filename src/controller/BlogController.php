<?php
namespace blogApp\src\controller;
use \blogApp\src\model\CommentManager;
use \blogApp\src\model\PostManager;
use \blogApp\src\model\CategorieManager;
/**
 * Class BlogController
 * controler frontend
 */
class BlogController extends \blogApp\core\Controller
{
	protected $template = 'frontend/template';

	/**
     * Recupere le dernier post via la fonction du modele
     * Redirige vers la vue
     */
	public function recentPosts(){
		$postManager = new PostManager(); 
	    $posts = $postManager->getRecentPosts(); 

		$this->render('frontend/recentpostview', [
	        'posts' => $posts
	    ]);
	}

	/**
     * Recupere tout les posts via la fonction du modele
     * Redirige vers la vue
     */
	public function allPosts(){
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getAllPosts(); // Appel d'une fonction de cet objet

		$this->render('frontend/allpostview', [
	        'posts' => $posts[0],
	        'totalPages' => $posts[1],
		    'currentPage' => $posts[2]
	    ]);
	}

	/**
     * Recupere le post et ses commentaire
     * Redirige vers la vue
     */
	public function post(){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostManager();
		    $commentManager = new CommentManager();

		    $post = $postManager->getPost($_GET['id']);
		    $comments = $commentManager->getComments($_GET['id']);

		    $this->render('frontend/postview', [
		        'post' => $post,
		        'comments' => $comments[0],
		        'totalPages' => $comments[1],
		        'currentPage' => $comments[2]
		    ]);   
        } else {
        	\blogApp\core\MessageAlert::messageType('danger', 'Ce post n\'existe pas');
	        $this->allPosts();
        }
	}

	/**
     * Redirige vers la vue game
     */
	public function game()
	{
		    $this->render('frontend/gameview');
	}

	/**
     * Recupere l id du post
     * rajoute le commentaire au post
     * Redirige vers la vue
     */
	public function addComment()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])){
				$commentManager = new CommentManager();
			    $affectedLines = $commentManager->postComment($_GET['id'], $_POST['author'], $_POST['comment']);

			    if ($affectedLines === false) {
			        \blogApp\core\MessageAlert::messageType('danger', 'Le commentaire n\'a pu être posté réessayer plus tard');
			        $this->redirectBack();
			    }
			    else {
			    	\blogApp\core\MessageAlert::messageType('success', 'Le commentaire a bien été posté, merci');
			        $this->redirectBack();
			    }		
			}
		}
	}

	/**
     * Recupere l id du commentaire
     * Ajoute +1 au compteur de signalement du commentaire
     * Redirige vers la vue
     */
	public function signalComment()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$commentManager = new CommentManager();
			$affectedLines = $commentManager->addSignalComment($_GET['id']);

			$this->redirectBack();
		} else {
			\blogApp\core\MessageAlert::messageType('danger', 'Le commentaire n\'a pu être signalé');
	        $this->allPosts();
		}
	}

	/**
     * Redirige vers la page contact
     */
	public function contact()
	{
		$this->render('frontend/contactview');
	}

	public function addPostCategorie()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$categorieManager = new CategorieManager(); // Création d'un objet
		    $posts = $categorieManager->getCategoriePosts($_GET['id']); // Appel d'une fonction de cet objet

			$this->render('frontend/categoriepostsview', [
				'categorie' => $posts[0],
		        'posts' => $posts[1],
		        'totalPages' => $posts[2],
		        'currentPage' => $posts[3]
		    ]);
		}
		
	}
}