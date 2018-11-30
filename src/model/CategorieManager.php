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
		$req = $this->db->query('SELECT id, name, slug FROM categories ORDER BY name ASC');
		$req = $req->fetchAll();

		return $req;
	}

	/**
	 * Cree une nouvelle categorie
	 * @param nom de la categorie $string
	 * Retourne une variable
	 */
	public function addNewCategorie($name)
	{
		//+slug
		$newCategorie = $this->db->prepare('INSERT INTO categories (name, slug) VALUES(?, ?)');
		$affectedCategorie = $newCategorie->execute(array($name, slugify($name)));

	    return $this->db->lastInsertId();
	}

	/**
	 * Recupere les donnee d'une categorie
	 * @param id de la categorie $string	 
	 * Retourne une variable
	 */
	public function getCategorie($categorieId)
	{
		$req = $this->db->prepare('SELECT * FROM categories WHERE id = ?');
		$req->execute([$categorieId]);
		$categorie = $req->fetch();
		return $categorie;
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
	 * Avec pagination
	 * @param id de la categorie $number
	 * Retourne un tableau
	 */
	public function getCategoriePosts($categorieId)
	{
		$reqCategorie = $this->db->prepare('SELECT id, name, slug FROM categories WHERE id = ?');
	    $reqCategorie->execute(array($categorieId));
	    $categorie = $reqCategorie->fetch();

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

	    $req = $this->db->prepare('SELECT id, author, title, image_path, post, id_categorie, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id_categorie = ? ORDER BY date_post DESC LIMIT ' . $depart . ', ' . $nbPostPage);
	    $req->execute(array($categorieId));
		$post = $req->fetchAll();

		$values = [$categorie, $post, $totalPages, $currentPage];
	    return $values;
	}
}