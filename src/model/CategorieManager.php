<?php
namespace blogApp\src\model;

/**
 * Class CategorieManager
 * Class qui gere les categories
 */
class CategorieManager extends \blogApp\core\Model
{
	/**
	 * Recupere toutes les categorie existante
	 * Retourne une variable
	 */
	public function getCategories()
	{
		// On récupère les  billets
		$req = $this->db->query('SELECT id, name FROM categories');
		$req = $req->fetchAll();

		return $req;
	}

	/**
     * Recupere le nombre de  posts par categorie
     * @param id de la categorie $number
     * Retourne la variable $totalPosts 
     */
	public function postCategorieCount($categorieId)
	{
		$totalPostsReq = $this->db->prepare('SELECT COUNT(id) FROM posts WHERE id_categorie = ?');
		$totalPostsReq->execute([$categorieId]);
		$totalPosts = $totalPostsReq->fetch()[0];
		return $totalPosts;
	}

	/**
	 * Recupere tous les posts d'une caregorie
	 * Retourne une variable
	 */
	public function getCategoriePosts($categorieId)
	{
		$nbPostPage = 5;
		$totalPosts = $this->postCategorieCount($categorieId);
		$totalPages = ceil($totalPosts/$nbPostPage);

		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPages) {
			$_GET['page'] = intval($_GET['page']);
			$currentPage = $_GET['page'];
		} else {
			$currentPage = 1;
		}

		$depart = ($currentPage - 1) * $nbPostPage;

	    $reqCategorie = $this->db->prepare('SELECT id, name FROM categories WHERE id = ?');
	    $reqCategorie->execute(array($categorieId));
	    $categorie = $reqCategorie->fetch();

	    $req = $this->db->prepare('SELECT id, author, title, image_path, post, id_categorie, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id_categorie = ? ORDER BY date_post DESC LIMIT ' . $depart . ', ' . $nbPostPage);
	    $req->execute(array($categorieId));
		$post = $req->fetchAll();

		$values = [$categorie, $post, $totalPages, $currentPage];
	    return $values;
	}
}