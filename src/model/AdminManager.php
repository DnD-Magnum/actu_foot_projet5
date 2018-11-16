<?php
namespace blogApp\src\model;
class AdminManager extends \blogApp\core\Model
{

	/**
     * Recupere les donnees de l admin
     * @param pseudo de l'admin $string
     * Retourne les mdp et id
     */
	public function getAdmin($user){
		$req = $this->db->prepare('SELECT id, password FROM admin WHERE user = :user');
		$req->execute(array(
		    'user' => $user));
		return $req->fetch();
	}

	/**
     * Recupere les donnees d un admin via le param1
     * Compare le password recuperer a celui du params2
     * @param pseudo login $string
     * @param password login $string
     * Retourne boolean true ou false
     */
	public function connect($name, $password){
		if (isset($_POST['token'])) {
			$result = $this->getAdmin($name);
			if (password_verify($password, $result['password'])){
				$_SESSION['connect'] = [$name];
				return true;
			}
			return false;
		}
		
	}
}