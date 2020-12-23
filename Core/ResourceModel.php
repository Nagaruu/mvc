<?php
namespace mvc\Core;

use mvc\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
	private $table;
	private $id;
	private $model;

	public function _init($table,$id,$model)
	{
		$this->table = $table;
		$this->id = $id;
		$this->model = $model;
	}

	public function save($model)
	{
		$arrModel = $model->getProperties();
		
		if($model->getId() == null){
			unset($arrModel["id"]);
			unset($arrModel["updated_at"]);
			$arrKey = array_keys($arrModel);
			$strKey = implode(" , ",$arrKey);

			$arrKeyValue = ":" . implode(" , :",$arrKey);
			$sql = "INSERT INTO $this->table ( {$strKey} ) VALUES ( {$arrKeyValue} )";
		}else {
			unset($arrModel["created_at"]);
			$arrKey = array_keys($arrModel);

			$strKey = implode(" , ",$arrKey);

			$arrKeyValue = ":" . implode(" , :",$arrKey);
			$str = "";
			foreach ($arrKey as $key => $value) {
				$sql .= $value . " = :" . $value . ",";
			}
			$str = substr($sql,0,-1);

			$sql = "UPDATE $this->table SET {$str} WHERE this->id = :id";
		}
		$req = Database::getBdd()->prepare($sql);
		return $req->execute($arrModel);
	}

	public function delete($model)
	{
		$arrId = [];
		$arrId['id'] = $model->getId();
		var_dump($model->getId());
		$sql = "DELETE FROM $this->table WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);	
        return $req->execute($arrId);
	}

	public function get($id = null)
	{
		if($id != null){
			$sql = "SELECT * FROM $this->table WHERE id =" . $id;

		}else { 
			$sql = "SELECT * FROM $this->table";
		}
		$req = Database::getBdd()->prepare($sql);
		$req->execute();
		if($id == null){
			return $req->fetchAll(PDO::FETCH_OBJ);
		}else {
			return $req->fetch();
		}	
	}
}