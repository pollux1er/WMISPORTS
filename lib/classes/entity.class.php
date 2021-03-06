<?php
/**
 * Classe de gestion des entites
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Patient
 * @license		GNU General Public License
 */

abstract class entity extends bd {
	
	protected $table;
	public $id;
	protected $primaryKey;
	/**  Variable pour les données surchargées.  */
    private $data = array();

    /**  La surcharge n'est pas utilisée sur les propriétés déclarées.  */
    public $declared = 1;
	 /**  La surcharge n'est lancée que lorsque l'on accède à la classe depuis l'extérieur.  */
    private $hidden = 2;

    public function __set($name, $value) {
       // echo "Définition de '$name' à la valeur '$value'\n";
        $this->$name = $value;
    }

    public function __get($name) {
       // echo "Récupération de '$name'\n";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
           
        }
		return $this->$name;
        $trace = debug_backtrace();
        trigger_error(
            'Propriété non-définie via __get(): ' . $name .
            ' dans ' . $trace[0]['file'] .
            ' à la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    /**  Since PHP 5.1.0  */
    public function __isset($name) {
        //echo "Est-ce que '$name' est défini ?\n";
        return isset($this->$name);
    }

    /**  Since PHP 5.1.0  */
    public function __unset($name) {
        //echo "Effacement de '$name'\n";
        unset($this->$name);
    }
	public function __construct($table = null) {
		parent::__construct();
		if(is_null($table))
			return 'Table non specifiee pour ' . __CLASS__;
		$this->setTableName($table);
		//var_dump($table);
		$this->primaryKey = $this->getPrimaryKey($this->table);
	}
	
	protected function setTableName($tableName) {
		$this->table = $tableName;
	}
	
	public function getAllFields() {
		$fieldList = array();
		$req = "SHOW FIELDS FROM $this->table";
		$res = $this->select($req);
		foreach($res as $f)
			$fieldList[] = $f->Field;
		return $fieldList;
	}
	
	/** Methode de sauvegarde ou de mise a jour d'un enregistrement */
	public function saveRecord($post, $exceptions = null) {
		// var_dump($post);
		// var_dump($exceptions);
		if($exceptions)
			if(is_array($exceptions))
				foreach($exceptions as $e)
					unset($post[$e]);
		if(is_string($this->primaryKey))
			isset($post[$this->primaryKey]) ? $this->updateRecord($post) : $this->newRecord($post);
		// else 
			// if(is_array($this->primaryKey))
				// if(in_array($this->primaryKey, $post)) ? $this->updateRecord($post) : $this->newRecord($post);
		//var_dump($post);die;
	}
	
	/** Methode de sauvegarde d'un nouvel enregistrement */
	public function newRecord($post, $exceptions = null) {
		if($exceptions)
			if(is_array($exceptions))
				foreach($exceptions as $e)
					unset($post[$e]);
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		$query = $this->buildInsertQuery($this->data, $this->table);
		//var_dump($query);
		if(!$this->insert($query))
			return 0;
		return $this->lastId();
	}
	
	/** Methode de mise a jour d'un enregistrement */
	protected function updateRecord($post) {
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		//
		$query = $this->buildUpdateQuery($this->data, $this->table, $post["$this->primaryKey"], $this->primaryKey);
		//var_dump($query); die;
		$this->update($query);
	}
	
	public function getRecord($id){
		if(is_array($id)) {
			$req = "SELECT * FROM $this->table WHERE ";
			foreach($id as $cle => $val) {
				$req .= "$cle = '$val' ";
			}
			$req .= " LIMIT 1";
			$res = $this->select($req);
			if(empty($res)) {
				return null;
			} else {
				return $res[0];
			}
		}
		$req = "SELECT * FROM $this->table WHERE $this->primaryKey = '$id' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	
	
	public function getName($id, $table, $field = null) {
		if($id == '' || is_null($id))
			return '';
		//
		if(is_null($field))
			$req = "SELECT nombre FROM $table WHERE identificador = '$id' LIMIT 1";
		else
			$req = "SELECT $field as nombre FROM $table WHERE identificador = '$id' LIMIT 1";
		//var_dump($req); 
		$res = $this->select($req);
		return $res[0]->nombre;
	}
	
	public function log() {
		$req = "INSERT INTO ";
	}
	
	public function getAllRecords($filter = null) {
		$req = "SELECT * FROM $this->table";
		if(!is_null($filter)) {
			$req .= " WHERE ";
			foreach($filter as $k => $v) {
				$req .= " $k = '$v'";
			}
		}
		$res = $this->select($req);
		return $res;
	}
	
	protected function buildUpdateQueryWhere($data, $keys, $table = null) {
		$table = is_null($table) ? $table = __CLASS__ : $table;
		$updates = '';
		$where = '';
		$query = "UPDATE $table SET ";
		
		foreach($data as $k => $v)
			if(!in_array($v, $keys))
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		$updates = removeLastChar($updates);
		
		foreach($keys as $k => $v)
			$where .= "$k = '$v' AND "; 
		$where = removeLastWord(trim($where));
		
		$query .= " $updates WHERE $where";
		return $query;
	}
	
	public function delRecord($id) {
		$id = is_array($id) ? $id["$this->primaryKey"] : $id;
		$req = "DELETE FROM $this->table WHERE ".$this->primaryKey." = '$id';";
		//var_dump($req); die;
		$this->sql($req);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>