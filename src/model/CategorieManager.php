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
	 * Recupere tous les posts d'une caregorie
	 * Retourne une variable
	 */
	public function getCategoriePosts($categorieId)
	{

	    $reqCategorie = $this->db->prepare('SELECT id, name FROM categories WHERE id = ?');
	    $reqCategorie->execute(array($categorieId));
	    $categorie = $reqCategorie->fetch();

	    $req = $this->db->prepare('SELECT id, author, title, image_path, post, id_categorie, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id_categorie = ? ORDER BY date_post DESC');
	    $req->execute(array($categorieId));
		$post = $req->fetchAll();

		$values = [$categorie, $post];
	    return $values;
	}
}