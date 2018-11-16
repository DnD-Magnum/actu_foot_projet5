<?php
namespace blogApp\src\model;
/**
 * Class PostManager
 * Model qui gere les posts
 */
class PostManager extends \blogApp\core\Model
{

	/**
     * Recupere le nombre de post
     * Retourne la variable $totalPOSTS 
     */
	public function postCount()
	{
		$totalPostsReq = $this->db->query('SELECT COUNT(id) FROM posts');
		$totalPosts = $totalPostsReq->fetch()[0];
		return $totalPosts;
	}

	/**
	 * Recupere tous les posts
	 * Retourne une variable
	 */
	public function getAllPosts()
	{
		$nbPostsPerPage = 5;
		$totalPosts = $this->postCount();
		$totalPages = ceil($totalPosts / $nbPostsPerPage);

		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPages) {
			$_GET['page'] = intval($_GET['page']);
			$currentPage = $_GET['page'];
		} else {
			$currentPage = 1;
		}

		$depart = ($currentPage - 1) * $nbPostsPerPage;
		// On récupère les  billets
		$req = $this->db->query('SELECT posts.id, author, title, image_path, post, id_categorie, categories.name, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts LEFT JOIN categories ON posts.id_categorie = categories.id ORDER BY date_post DESC LIMIT ' . $depart . ', ' . $nbPostsPerPage);
		$req = $req->fetchAll();

		$varsForPagination = [$req, $totalPages, $currentPage];

		return $varsForPagination;
	}

	/**
	 * Recupere le dernier post
	 * Retourne une variable
	 */
	public function getLastPost()
	{
		// On récupère les 5 derniers billets
		$req = $this->db->query('SELECT posts.id, author, title, image_path, post, id_categorie, categories.name, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts LEFT JOIN categories ON posts.id_categorie = categories.id ORDER BY date_post DESC LIMIT 0, 1');
		$req = $req->fetch();

		return $req;
	}

	/**
	 * Recupere les 5 derniers posts
	 * Retourne une variable
	 */
	public function getRecentPosts()
	{
		// On récupère les 5 derniers billets
		$req = $this->db->query('SELECT posts.id, author, title, image_path, post, id_categorie, categories.name, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts LEFT JOIN categories ON posts.id_categorie = categories.id ORDER BY date_post DESC LIMIT 1, 20');
		$req = $req->fetchAll();

		return $req;
	}

	/**
	 * Recupere 1 post
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function getPost($postId)
	{
	    $req = $this->db->prepare('SELECT posts.id, author,title, image_path, post, id_categorie, categories.name, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts LEFT JOIN categories ON posts.id_categorie = categories.id WHERE posts.id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}

	/**
	 * Cree un nouveau post 
	 * @param auteur du post $string
	 * @param titre du post $string
	 * @param contenu du post $string
	 * Retourne une variable
	 */
	public function addNewPost($author, $title, $post)
	{
		if (!empty($author) && !empty($title) && !empty($post) && isset($_SESSION['token']))
		{
			$newPost = $this->db->prepare('INSERT INTO posts (author, title, post, date_post) VALUES(?, ?, ?, NOW())');
		    $affectedPost = $newPost->execute(array($author, $title, $post));

		    return $affectedPost;
		}
	}

	/**
	 * Modifie un post
	 * @param titre du post $string
	 * @param contenu du post $string
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function updatePost($title, $post, $idPost)
	{
		$newPost = $this->db->prepare('UPDATE posts SET title = ?, post = ? WHERE id = ?');
		$affectedPost = $newPost->execute(array($title, $post, $idPost));

		return $affectedPost;
	}

	/**
	 * Supprime un post
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function deletePost($idPost)
	{
		$deletedPost = $this->db->prepare('DELETE FROM posts WHERE posts . id = ?');
		$affectedPost = $deletedPost->execute(array($idPost));

		return $affectedPost;
	}
}