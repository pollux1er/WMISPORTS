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

class equipes extends entity {
	
	var $id;
	var $nom_equipe;
	var $status;
	var $type_sport;
	var $capitaine;
	var $commentaire;
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	// creation d'une equipe
	public function newTeam($captain, $settings) {
	
	}
	
	// assignation du capitaine a l'equipe
	public function setCaptain($idmember) {
	
	}
	
	// ajouter des joueurs a l'equipe
	public function addPlayers() {
	
	}
	
	// Retirer un joueur de l'equipe
	public function removePlayers() {
	
	}
	
	// Inviter des joueurs 
	public function invitePlayers() {
	
	}
	
	// Contacter des joueurs
	public function contactPlayers() {
	
	}
	
	// Lister les équipes d'un capitaine et celle dont il est joueur
	public function getMyTeams($idjoueur) {
		$sql = "SELECT eq.nom_equipe AS nom_equipe, eq.id AS id 
				FROM $this->table AS eq 
				WHERE eq.capitaine = '$idjoueur' OR eq.id IN 
					(SELECT id_equipe 
					FROM equipes_joueurs 
					WHERE id_joueur = $idjoueur)
				ORDER BY eq.id;";
	//	echo "<pre>"; var_dump($sql); die;
		$res = $this->select($sql);
		
		return $res;
	}
	
	// Get le nom de lequipe
	public function getTeamName($idTeam) {
		$sql = "SELECT nom_equipe FROM $this->table WHERE id = '$idTeam'";
		$res = $this->select($sql);
		if(count($res))
			return $res[0]->nom_equipe;
		return '';
	}
	
	// Mettre a jour les parametres de l'equipe
	
	public function __destruct() {
		parent::__destruct();
	}	
}
?>