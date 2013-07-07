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

class equipes_joueurs extends entity {
	
	
	
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
	
	// Lister les équipes d'un capitaines
	public function getTeams($captain) {
		
	}
	
	// Mettre a jour les parametres de l'equipe
	
	public function __destruct() {
		parent::__destruct();
	}	
}
?>