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

class rencontres extends entity {
	
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	public function saveDates($dates, $status, $notes, $idTeam) {
		$i = 1;
		//echo "<pre>"; var_dump($dates);
		$record = null;
		for($i; $i <= count($dates); $i++) {
			if($dates[$i] != '') {
				$record = array('date' => dateMysqlEn($dates[$i]), 
										'notes' => trim($notes[$i]), 
										'status' => trim($status[$i]), 
										'equipe' => $idTeam);
				//var_dump($record);
				$this->saveRecord($record);
				$idrencontre = $this->lastId();
				$j = new joueurs();
				$joueurs = $j->getTeamPlayers($idTeam);
				foreach($joueurs as $p) {
					$req = "INSERT INTO `status_joueur_rencontre` (`id_joueur`, `id_rencontre`, `reply`) VALUES ('".$p->idplayer."', '".$idrencontre."', NULL);";
					$res = $this->insert($req);
				}
			}
		}
		// die;
	}
	
	// Return an array of games
	public function getNextGames($start = null) {
		$req = "SELECT * FROM `rencontres` WHERE `equipe` = '".$_GET['idteam']."'";
		$nbGames = $this->countResult($req);
		
		if(is_null($start) /* && $nbGames < 5 */) {
			$limit = '0, 5';
			$req = "SELECT id, DATE_FORMAT(date, '%a, %b %e') AS datef, status FROM `rencontres` WHERE `equipe` = '".$_GET['idteam']."' AND date >= CURDATE() ORDER BY date ASC LIMIT $limit";
			//echo "<pre>"; var_dump($req);
			$games = $this->select($req);
			return $games;
		}
	}
	
	public function checkInvitationStatus($idrencontre, $idplayer) {
		$req = "SELECT st.invite_status AS invite_status, st.id_joueur AS id_joueur, st.id_rencontre AS id_rencontre, st.reply AS reply, j.noms AS nom FROM status_joueur_rencontre AS st LEFT JOIN joueurs AS j ON j.id = st.id_joueur WHERE st.id_joueur = '".$idplayer."' AND st.id_rencontre = '".$idrencontre."' LIMIT 1;";
		
		$status = $this->select($req);
		//var_dump($status);
		if((count($status)) > 0)
			return $status[0];
		return null;
	}
	
	public function invitePlayer($game, $player, $name, $email, $title, $message) {
		global $app;
		$j = new joueurs();
		$m = new membres();
		$captain = $m->getRecord($j->getCaptain($_GET['idteam']));
		$patterns = array();
		$replacements = array();
		$patterns[0] = '/{captainname}/';
		$patterns[1] = '/{playername}/';
		$patterns[2] = '/{message}/';
		$patterns[3] = '/{date}/';
		$patterns[4] = '/{team}/';
		$patterns[5] = '/{idplayer}/';
		$patterns[6] = '/{idgame}/';
		$replacements[0] = $captain->name;
		$replacements[1] = $name;
		$replacements[2] = $message;
		$replacements[3] = $this->getDateOfGame($game);
		$replacements[4] = $this->getTeamNameFromGame($game);
		$replacements[5] = $player;
		$replacements[6] = $game;
		//echo "<pre>"; var_dump($captain); die;
		//var_dump($app->rootUrl.'inviteemail.txt');
		$html = file_get_contents($app->rootUrl.'inviteemail.txt');
		//$newmail->setHtmlBody($html);
		//echo "<pre>"; var_dump($html); die;
		$mail = stripslashes(preg_replace($patterns, $replacements, $html));
		$teamName = $this->getTeamNameFromGame($game);
		$subject = "$title / [$teamName] : " . $replacements[3] . " / " . "invite to game" ;
		$headers ='From: "'.$captain->name.' / WMISPORTS "<r2d2@wmisports.com>'."\n"; 
		$headers .='Reply-To: r2d2@wmisports.com'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 
		if(@mail($email, $subject, $mail, $headers)) {
			//die;
			$this->inviteChekIn($game, $player);
		}	
	}
	
	public function getReply($g, $p, $r) {
		$req = "UPDATE `status_joueur_rencontre` SET `reply` = '".$r."', `last_update` = NOW( ) WHERE `id_joueur` = '".$p."' AND `id_rencontre` = '".$g."' LIMIT 1 ;";
		return $this->update($req);
	}
	
	private function inviteChekIn($game, $player) {
		$req = "UPDATE `status_joueur_rencontre` SET `invite_status` = 'y', `last_update` = CURRENT_TIME( ) WHERE `id_joueur` = '".$player."' AND `id_rencontre` = '".$game."' LIMIT 1 ;";
		$checkin = $this->update($req);
	}
	
	public function getDateOfGame($idgame) {
		$sql = "SELECT * FROM $this->table WHERE id = '".$idgame."' LIMIT 1;";
		$res = $this->select($sql);
		return $res[0]->date;
	}
	
	public function getGameStatus($idgame) {
		$sql = "SELECT * FROM $this->table WHERE id = '".$idgame."' AND date >= CURDATE() LIMIT 1;";
		$res = $this->select($sql);
		if(count($res) == 0)
			return 'outdated';
		
		return 'uptodate';
	}
	
	public function getTeamNameFromGame($idgame) {
		$sql = "SELECT e.nom_equipe AS teamname FROM $this->table AS g LEFT JOIN equipes AS e ON e.id = g.equipe WHERE g.id = '".$idgame."' LIMIT 1;";
		///echo "<pre>"; var_dump($sql); die;
		$res = $this->select($sql);
		return $res[0]->teamname;
	}
	
	//public function save
	public function __destruct() {
		parent::__destruct();
	}	
}
?>