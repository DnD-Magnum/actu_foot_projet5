<?php
namespace blogApp\core;
/**
* Class UploadFile
* Permet de gerer des fichier envoyé avec un formulaire
*/
class File
{
	/**
	* upload un fichier
	* @param name de linput $string
	* @param destination du fichier $string
	* @param taille maxi du fichier $number
	* @param extension obligatoire du fichier $string
	* Condition 1: fichier correctement uploadé
	* Condition 2: taille limite
	* Condition 3: extension
	* return deplacement du fichier vers $destination
	*/
	static function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
	{
	    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
	    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
	    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
	    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;

	    return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
	}

	/**
	* upload une image
	* @param name de linput $string
	* return une variable dont la valeur est le chemin de l'img
	*/
	static function uploadImage($index)
	{

		$nom = md5(uniqid(rand(), true));
		$ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
		if(self::upload($index, 'images/' . $nom . '.' . $ext, false, array('png','gif','jpg','jpeg') )){
			$picturePath = 'public/images/' . $nom . '.' . $ext;
			return $picturePath;
		}
		return false;
	}

	static function replaceImage($new, $old)
	{
		$newPath = self::uploadImage($new);
		self::remove($old);

		return $newPath;
	}

	static function remove($filepath)
	{
	 	unlink($filepath);
	}
}