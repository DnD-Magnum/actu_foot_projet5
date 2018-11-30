<?php

	/**
	 * Variable constante qui a comme valeur le prefixe du chemin de l url
	 */
	define('PATH_PREFIX', '/courPHP/projet5_actufoot');

	/**
	 * Fonction qui renvoie la class active dans les onglets de la navbar
	 * Verifie si l url conrespont au chemin indiquer dans la variable
	 * Renvoie active si ca correspond
	 */
	function active($path)
	{
		if (preg_match($path, $_SERVER['REQUEST_URI'])) 
		{
			echo "active";
		}
	}

	/**
	 * Fonction qui renvoie l attribut checked dans input radio d'un formulaire 
	 * Verifie si la valaleur du boutton radio correspond a une valeur dans la base de donné
	 * Renvoie checked si ca correspond
	 */
	function selected($categoriePost, $categorieRadio) 
	{
		if ($categoriePost == $categorieRadio) 
		{
			echo "selected";
		}
	}

	function truncate($text, $length, $textEnd)
	{
		if (strlen($text) >= $length) {
			$text = substr($text, 0, $length);
			$espace = strrpos($text, " ");
			$text = substr($text, 0, $espace) . $textEnd;
		}
		return $text;
	}

	function getCategorys()
	{
		$categorieManager = new \blogApp\src\model\CategorieManager();
        $categories = $categorieManager->getCategories();
        foreach ($categories as $categorie) :
            echo "<a class='dropdown-item' href='" . PATH_PREFIX . "/categorie/" . $categorie['slug'] . "?id=" . $categorie['id'] . "'>" . $categorie['name'] . "</a>";
        endforeach;
	}

	function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}