<?php
namespace blogApp\core;


class MessageAlert
{
	/**
	 * Fonction qui verifie si une Session message alert existe
	 * si oui envoie la div conteneur du message alert
	 */
	static function verifySessionAlert()
	{
		if (isset($_SESSION['succes'])){
				?>
                <div class="alert alert-<?= $_SESSION['succes'][0]; ?>" role="alert">
                    <?= $_SESSION['succes'][1] ?>
                </div>
				<?php
		}
	}

	/**
	 * Fonction qui envoie un message alert et demande de l'afficher
	 */
	static function messageType($type, $message){
		$_SESSION['succes'] = [$type, $message];
	}

	/**
	 * Fonction qui detruit la session message alert
	 */
	static function destroyMessage(){
		unset($_SESSION['succes']);
	}
}
?>