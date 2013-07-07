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

class joueurs extends entity {
	
	var $table_jeq = 'equipes_joueurs';
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	public function saveTeamPlayer($joueur, $equipe) {
		$this->saveRecord($joueur, array('notes', 'assistant', 'position', 'remplacant', 'equipes')); // add player in database
		$joueur['id_joueur'] = $this->lastId();
		$joueur['id_equipe'] = $equipe;
		$pt = new equipes_joueurs();
		$pt->newRecord($joueur, array('noms', 'email', 'equipes')); // add player to the team on relation table
		// Check for team future games and add player to that games
		$idplayer = $this->lastId();
		$game = new rencontres();
		$games = $game->getNextGames();
		//echo "<pre>"; var_dump($games);var_dump($idplayer); die;
		if(count($games) > 0){
			foreach($games as $g) {
				$req = "INSERT INTO `status_joueur_rencontre` (`id_joueur`, `id_rencontre`, `reply`) VALUES ('".$idplayer."', '".$g->id."', NULL);";
				$res = $this->insert($req);
			}
		}
	}
	
	public function getPlayerInfo($idPlayer) {
		$sql = "SELECT j.noms AS noms, j.email AS email, jeq.remplacant AS remplacant, jeq.assistant AS assistant, jeq.position AS position, jeq.notes AS notes, jeq.id_joueur AS idplayer , j.genre AS genre FROM $this->table as j LEFT JOIN $this->table_jeq as jeq ON jeq.id_joueur = j.id WHERE j.id = '$idPlayer'";
		//var_dump($sql);
		$res = $this->select($sql);
		return $res[0];
	}
	
	public function getTeamPlayers($idTeam) {
		$sql = "SELECT jeq.id_equipe as idequipe, j.noms as noms, jeq.id_joueur as idplayer , j.genre as genre FROM $this->table_jeq as jeq INNER JOIN $this->table as j ON jeq.id_joueur = j.id WHERE jeq.id_equipe = '$idTeam'";
		$res = $this->select($sql);
		return $res;
	}
	
	public function getRegularTeamPlayers($idTeam) {
		$sql = "SELECT jeq.id_equipe AS idequipe, j.email AS email, jeq.remplacant AS remplacant, jeq.position AS position, j.noms AS noms, jeq.id_joueur AS idplayer , j.genre AS genre FROM $this->table_jeq AS jeq INNER JOIN $this->table as j ON jeq.id_joueur = j.id WHERE jeq.id_equipe = '$idTeam' AND jeq.remplacant NOT IN('y') AND j.email IS NOT NULL";
		//var_dump($sql); die;
		$res = $this->select($sql);
		return $res;
	}
	
	public function getSubTeamPlayers($idTeam) {
		$sql = "SELECT jeq.id_equipe AS idequipe, j.email AS email, jeq.remplacant AS remplacant, jeq.position AS position, j.noms AS noms, jeq.id_joueur AS idplayer , j.genre AS genre FROM $this->table_jeq AS jeq INNER JOIN $this->table as j ON jeq.id_joueur = j.id WHERE jeq.id_equipe = '$idTeam' AND jeq.remplacant NOT IN('n') AND j.email IS NOT NULL";
		//var_dump($sql); die;
		$res = $this->select($sql);
		return $res;
	}
	
	public function getCaptain($idteam) {
		$sql = "SELECT j.noms, j.id FROM equipes AS eq INNER JOIN $this->table AS j ON j.id = eq.capitaine WHERE eq.id = '".$idteam."' LIMIT 1;";
		$res = $this->select($sql);
		return $res;
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>