<?php
namespace blogApp\core;

/**
 * Class Csrf
 * Gere les faille csrf
 */
class Csrf
{
	/**
	 * Genere je ton token
	 * Condition (if) le genere que si il existe pas 
	 */
	static function generateToken(){
		if (!isset($_SESSION['token'])) {
			$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			$_SESSION['token'] = $token;
		}
	}

	/**
	 * Genere le input type hidden
	 * Valeur de l input == token
	 */
	static function generateInput(){
		?>
		<input type='hidden' name='token' id='token' value='<?= $_SESSION['token'] ?>' />
		<?php
	}

	/**
	 * Verifie si le token du formulaire corespond a celui de la session 
	 * si non revoie a la page d accueil
	 */
	static function verifyToken(){
		if (isset($_POST) && (isset($_POST['token']) && $_POST['token'] != $_SESSION['token'])) {
			header('Location:' . PATH_PREFIX . '/');
			\blogApp\core\MessageAlert::messageType("danger", "Impossible d'envoyer le formulaire");
			die();
		}
	}
}
?>