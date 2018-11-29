<?php
namespace blogApp\core;
/**
* Class UploadFile
* Permet de gerer des fichier envoyé avec un formulaire
*/
class UploadFile
{

	/**
	* upload un fichier
	* @param name de linput $string
	* @param destination du fichier $string
	* @param taille maxi du fichier $number
	* @param extension obligatoire du fichier $string
	* Test1: fichier correctement uploadé
	* Test2: taille limite
	* Test3: extension
	* return deplacement du fichier vers $destination
	*/
	function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
	{
	   //Test1: fichier correctement uploadé
	     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
	   //Test2: taille limite
	     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
	   //Test3: extension
	     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
	     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
	   //Déplacement
	     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
	}

	/**
	* upload une image
	* @param name de linput $string
	*/
	function uploadImage($index)
	{
		$nom = md5(uniqid(rand(), true));
		$ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
		$this->upload($index, 'images/' . $nom . '.' . $ext, false, array('png','gif','jpg','jpeg') );
		$picturePath = 'public/images/' . $nom . '.' . $ext;

		return $picturePath;
	}
}