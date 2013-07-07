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
		$req = "SELECT * FROM status_joueur_rencontre WHERE id_joueur = '".$idplayer."' AND id_rencontre = '".$idrencontre."' LIMIT 1;";
		
		$status = $this->select($req);
		//var_dump($status);
		if((count($status)) > 0)
			return $status[0];
		return null;
	}
	
	public function invitePlayer($game, $player, $name, $email, $title, $message) {
		$j = new joueurs();
		$captainName = $j->getCaptain($idteam);
		$html = '<div style="font-family:verdana, arial;font-size:10pt;"><span style="font-size:10pt;"><br><br>Dear ' . $email . ',<br><br><br><br><h2>Welcome to WMISPORTS!</h2><br><br>WMISPORTS has proven very useful to the teams using it, and hopefully it will be useful for your teams as well.<br><br><br>Below are some tips. If you need any help at all, or have any suggestions, don\'t hesitate to contact us at <font color="blue">info@wmisports.com</font> and we\'ll get back to you asap.<br><br>Thanks for using WMISPORTS,<br><br><br>- WMISPORTS Customer Service Dept.<br><b><a href="http://wmisports.com/" target="_blank">wmisports.com</a></b><br><br><br><br><br><font color="#c0c0c0">P.S.<br>You\'re being sent this email because someone registered at WMISPORTS using your email address. If it wasn\'t you, simply ignore the activation email that will also have been sent to your address, and you won\'t receive any further emails.<br></font><br>If you received this email in error and wish to opt out of receiving any further WMISPORTS emails ever, please email "unsubscribe@wmisports.com".<br><hr><h3>Captain tips:</h3><br><ul><li><b>Click the <b><font color="red">"3. Invite players"</font></b> link to invite players</b> to your team\'s games. That sends a single email to each player you select, allowing them to indicate their attendance at ALL games.<br><br></li><li><b>Tell your players to expect emails from</b> <font color="blue">r2d2@wmisports.com</font>, and check bulk/junk mail folders, spam filter settings, and/or add that to their address book. (You could tell them via an email from your own address.)<br><br></li><li><b>Click the link in the activation email that is sent to you</b> (if you haven\'t already), in order to complete registration &amp; be able to contact your players from WMISPORTS. (Check your spam/junk folders.)<br><br></li><li>You can also invite players to individual games, or remind players who\'ve already been invited: click the "invite/remind" link next to each game. (When possible, it\'s better to invite to all games at once to reduce email to your players.)<br><br></li><li>Contact players with your own message (without inviting to games): click the "Contact players" link. (As with game invites, you can choose to contact all players, or a selection of regular players/subs.)<br><br></li><li>Delegate to your assistant captains so they can help run the team on your behalf: see FAQ #4 in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><hr><h3>Player tips:</h3><br><ul><li><b>Click the link in the activation email that is sent to you</b>: that will automatically add any teams you\'re on to your new account (teams where you\'re using the same email address). You DON\'T need to type in the name of the team you\'re on: that\'s for creating a brand new team.<br><br></li><li>If you\'re on other teams (e.g. using a different email address), open one of the team emails you\'ve received. Click your schedule link, and then click "Register/add team to account".<br><br></li><li>If you need another email with your schedule link, go to WMISPORTS.com and click "Get your sched link email".<br><br></li></ul><hr><h3>Tips for everyone:</h3><br><ul><li>Hovering your mouse over buttons/links/other things will show info explaining what they do.<br><br></li><li>Tick the "remember me" checkbox when signing in, and next time you visit WMISPORTS.com on the same computer you\'ll be signed in automatically: no need to type your password. (Not recommended on shared computers.)<br><br></li><li>More info is in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><br><br><font color="#c0c0c0">5817</font></span></div>';
		//$newmail->setHtmlBody($html);
		//echo "<pre>"; var_dump($html);
		$teamName = "";
		$subject = "$title / $teamName";
		$headers ='From: "$email / WMISPORTS "<r2d2@wmisports.com>'."\n"; 
		$headers .='Reply-To: r2d2@wmisports.com'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 
		if(!mail($email, $subject, $html, $headers)) {
			//die;
			$this->inviteChekIn($game, $player);
		}	
	}
	
	private function inviteChekIn($game, $player) {
		$req = "UPDATE `status_joueur_rencontre` SET `invite_status` = 'y' WHERE `id_joueur` = '".$player."' AND `id_rencontre` = '".$game."' LIMIT 1 ;";
		$checkin = $this->update($req);
	}
	
	//public function save
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>