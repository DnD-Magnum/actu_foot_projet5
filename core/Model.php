<?php 
namespace blogApp\core;
/**
 * Class Model
 * Model principal
 * Gere les functions appeller dans les enfants
 */
class Model 
{
	protected $db;
    //private $_singleton = Database::getInstance();
    function __construct(){
		$this->db = \blogApp\core\Database::getInstance()->dbConnect();
    }

    /**
     * Extrait les variables et renvoi la vue
     * @param chemin de la vue $string
     * @param extrait les variables $variable
     * Renvoie ver la vue
     */
	public function renderVars($vars){
		extract($vars);
	}
}