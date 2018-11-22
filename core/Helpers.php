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
	function checked($categoriePost, $categorieRadio) 
	{
		if ($categoriePost == $categorieRadio) 
		{
			echo "checked";
		}
	}