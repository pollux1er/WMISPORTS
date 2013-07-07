<?php
@session_start();
/**
 * Classe de gestion des provinces
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Patient
 * @license		GNU General Public License
 */

class sports extends entity {
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	public function getAutocaristes() {
		$req = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar' LIMIT 0, 10";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	
	public function hit($id) {
		$req = "UPDATE $this->table SET nb_visites = (nb_visites + 1) WHERE mdr_id = '$id' LIMIT 1";
		//var_dump($req); die;
		$this->sql($req);
	}
	
	public function getLastPayementInfo($id) {
		$req = "SELECT date_payement, choix_plan FROM payements WHERE id_autocariste = '".$id."' LIMIT 1";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	
	public function upgradeMembership($id) {
		$data = array('mdr_id' => $id, 'membership' => 'premium', 'valid' => '1');
		$this->saveRecord($data);	
	}
	
	public function demandeInscription($data) {
		$this->saveRecord($data);
	}
	
	public function login($form) {
		
	}
	
	public function getNbAutocariste() {
		$requete = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar';";
		return $this->countResult($requete);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>