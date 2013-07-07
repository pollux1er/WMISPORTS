<?php
@session_start();
/**
 * Classe de gestion des projets
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class WMI extends bd {
	
	public $title = '';
	public $urlIndex = 'dashboard.php';
	public $urlLogin = 'index.html';
	public $acticationCode = '';
	
	public function __construct() {
		//GLOBAL $app, $user;
		parent::__construct();
		//$app = new premiumAutocar; //var_dump($this); die;
		// $user = new utilisateur;
		// if($this->checkSession()) { 
			// if($user->isAdministrator()) { //die('checkss');
				// $this->title = "Autocar Admin";} }
		// $this->checkSession();
	}
	
	public function envoyerDemande($POST) {
		
	}
	
	public function checkSession() {
		if(!isset($_SESSION['iduser']))
			return false;
		else return true;
	}
	
	public function setLang() {
		
	}
	
	public function initiliaseProject() {
				
		if(!isset($_SESSION['codeP'])) {
			$code = $this->generateCode('6','1','1');
			
			while($this->checkCode($code))
				$code = $this->generateCode('6','1','1');
			
			$this->code = $_SESSION['codeP'] = $code;
			
			if(!isset($_SESSION['iduser']))
				$this->newUser();
			
			$this->newProject($code);
		} else {
			$this->getProject($this->getCodeP());
		}
	//	return $this->code;
	}

	private function generateCode($numchars=5,$digits=1,$letters=1){
		$dig = "012345678923456789";
		$abc = "ABCDEFGHJKLMNOPQRSTUVWXYZ";
		$str = '';$randomized='';
		if($letters == 1){
			$str .= $abc;
		}

		if($digits == 1){
			$str .= $dig;
		}

		for($i=0; $i < $numchars; $i++){
			$randomized .= $str{rand() % strlen($str)};
		}

		return $randomized;
	}
	
	public function newProject($code) {
		$req = "INSERT INTO $this->table_projects(code, idUser, idStep, status) VALUES('$this->code', '$this->idUser', '0', '1')";
		$this->insert($req);
	}
	
	public function initializePages() {
		$req = "SELECT * FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."' LIMIT 3";
		$res = $this->countResult($req);
		if($res == 0) {
			if($this->getTypePages() == 'custom'){
				$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `id_html`, `codeProject`) VALUES (NULL, 'Home', '', '0', 'id0', '".$_SESSION['codeP']."');";
				//$req1 = "INSERT INTO $this->table_pages(id, title, content, order, codeProject) VALUES(NULL, 'Home', '', '1', '".$_SESSION['codeP']."')";
				//var_dump($req1);
				$this->insert($req1);
				return null;
			} else {
				$i = 1;
				foreach($this->standardPages as $page) {
					//$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `codeProject`) VALUES (NULL, 'Home', '', '1', '".$_SESSION['codeP']."');";
					$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `codeProject`) VALUES(NULL, '".$page."', '', '".$i."', '".$_SESSION['codeP']."')";
					$this->insert($req1);
					$i++;
				}
				return null;
			}
		} else {
			return $this->getPages();
		}
	}
	
	public function addPage($title, $idhtml) {
		if(isset($_SESSION['orderpage'])){
			$_SESSION['orderpage']++;
		} else $_SESSION['orderpage'] = 1;
		$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `id_html`, `codeProject`) VALUES (NULL, '".$title."', '', '".$_SESSION['orderpage']."', '$idhtml', '".$_SESSION['codeP']."');";
		//var_dump($req1);
		$this->insert($req1);
	}
	
	public function delPage($id) {
		$req = "DELETE FROM $this->table_pages WHERE id = '$id' LIMIT 1;";
		$this->sql($req);
	}
	
	public function getTypePages() {
		$req = "SELECT typePages FROM $this->table_projects WHERE code = '".$_SESSION['codeP']."' LIMIT 1";
		$res = $this->select($req);
		return $res[0]->typePages;
	}
	
	public function updatePageType($type) {
		if($this->getTypePages() != $type) {
			$req = "UPDATE $this->table_projects SET typePages = '$type' WHERE code = '".$_SESSION['codeP']."'";
			$this->update($req);
			$req1 = "DELETE FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."'";
			$this->sql($req1);
		}
	}
	
	public function updatePage($id, $title, $textarea = null, $type = null) {
		if(!is_null($textarea)) {
			$req = "UPDATE $this->table_pages SET title = '$title', content = '$textarea', type = '$type', modified = '1' WHERE id = '$id'";
			$this->update($req);
		} else {
			$req = "UPDATE $this->table_pages SET title = '$title' WHERE id_html = '$id'";
			$this->update($req);
		}
	}
	
	
	public function setDesiredDomain($domain) {
		$req = "UPDATE $this->table_projects SET desiredDomain = '$domain' WHERE code = '".$_SESSION['codeP']."';";
		$this->update($req);
	}
	
	public function getButtonInfod($idPage) {
		$req = "SELECT * FROM $this->table_pages WHERE id = '".$idPage."' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	
	public function getNextStep($idStep) {
		if($idStep == 0) {
			return true;
		} else {
			if($this->checkCurrentStep($idStep)) {
				$this->saveStep($idStep);
			}
		}
	}
	
	public function saveActivity($classe, $other = null) {
		switch($classe) {
			case 'activityPlumber': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityArchitect': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityCompany': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityRestaurant': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityInsurer': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activity': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '$other' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
		}
	}
	
	public function saveCompanyDetails($post) {
			$name = addslashes($post['name']);
			$desc = addslashes($post['description']);
			$f1 = addslashes($post['f1']);
			$f2 = addslashes($post['f2']);
			$f3 = addslashes($post['f3']);
		
		if(!isset($_SESSION['companyName'])) {
			$_SESSION['companyName'] = $name;
			$req = "INSERT INTO $this->table_infos(codeProject, name, description, force1, force2, force3) VALUES('".$_SESSION['codeP']."', '$name', '$desc', '$f1', '$f2', '$f3');";
			return $this->insert($req);
		} else {
			$_SESSION['companyName'] = $name;
			$req = "UPDATE $this->table_infos SET name = '$name', description = '$desc', force1 = '$f1', force2 = '$f2', force3 = '$f3' WHERE codeProject = '".$_SESSION['codeP']."'";
			return $this->update($req);
		}
	}
	
	public function getCompanyDetails($code) {
		$req = "SELECT * FROM $this->table_infos WHERE codeProject = '$code' LIMIT 1";
		//var_dump($req);
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	}
	
	public function saveColor($classe) {
		switch($classe) {
			case 'noPreference':
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req);
			case 'blue': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'red': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'orange': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'green': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'purple': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'grey': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'black': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
		}
	}
	
	public function getNetworksInfos() {
		$req = "SELECT t1.facebook, t1.twitter, t1.googleplus, t1.youtube, t1.pack1, t1.pack2 FROM $this->table_networks AS t1 WHERE t1.idProject = '".$_SESSION['codeP']."' LIMIT 1";
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	
	}
	
	public function saveNetworks($arr) {
		$facebook = addslashes($arr['f']);
		$twitter = addslashes($arr['t']);
		$youtube = addslashes($arr['y']);
		$googleplus = addslashes($arr['g']);
		$p1 = ($arr['p1'] == 'I want this pack') ? 0 : 1;
		$p2 = ($arr['p2'] == 'I want this pack') ? 0 : 1;
			
		if(!isset($_SESSION['networks'])) {
			$req = "INSERT INTO $this->table_networks(idProject, pack1, pack2, facebook, twitter, youtube, googleplus) VALUES('".$_SESSION['codeP']."', '$p1', '$p2', '$facebook', '$twitter', '$youtube', '$googleplus');";
			$this->insert($req);
			$_SESSION['networks'] = 1;
		} else {
			$req = "UPDATE $this->table_networks SET pack1 = '$p1', pack2 = '$p2', facebook = '$facebook', twitter = '$twitter', youtube = '$youtube', googleplus = '$googleplus' WHERE idProject = '".$_SESSION['codeP']."'";
			$this->update($req);
		}
	}
	
	public function pb() {
		// $req = "SELECT t1.idInfos, t2.name, t2.description, t2.force1, t2.force2, t2.force3 FROM $this->table_projects AS t1 INNER JOIN $this->table_infos AS t2 ON t1.idInfos = t2.codeProject WHERE t1.code = '$code' LIMIT 1";
		// $res = $this->select($req);
		// if(empty($res))
			// return null;
		// else
			// return $res[0];
	}
	
	private function getActivityId($cl) {
		$req = "SELECT id FROM $this->table_activities WHERE class = '$cl' LIMIT 1";
		$res = $this->select($req);
		return $res[0]->id;
	}
	
	public function getPages() {
		$req = "SELECT * FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."' ORDER BY `order` ASC";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	
	public function updatePagesOrder($idspages) {
		//$listingCounter = 1;
		foreach($idspages as $order => $idp) {
			$this->updatePageOrder($idp, $order);
		}
		//die;
	}
	
	public function updatePageOrder($id, $order) {
		$query = "UPDATE $this->table_pages SET `order` = '" . $order . "' WHERE id = '" . $id . "';";
		//var_dump($query);
		$this->sql($query);
	}

	public function getPageInfos($id) {
		$req = "SELECT * FROM $this->table_pages WHERE id = '$id' LIMIT 1";
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	}
	
	public function updatePageInfos($post) {
		$f1 = addslashes($post['f1']);
		$f2 = addslashes($post['f2']);
		$f3 = addslashes($post['f3']);
	
	}
	
	public function getPageType($d) {
		switch($d) {
			case 'text': return 'Texte'; break;
			case 'gallery': return 'Image Gallery'; break;
			case 'contact': return 'Contact'; break;
			case 'map': return 'Google Map'; break;
			default : return 'Unknown'; break;
		}
	}
	
	public function newUser() {
		$req = "INSERT INTO $this->table_users(id, email) VALUES('', '');";
		$this->insert($req);
		$this->idUser = $_SESSION['iduser'] = $this->lastId();
		//return $this->idUser;
	}
	
	public function checkCode($code) {
		$req = "SELECT code FROM $this->table_projects WHERE code = '$code' LIMIT 1";
		$res = $this->countResult($req);
		if($res == 1)
			return true;
		else
			return false;
	}
	
	//////////////////////////////////////////////// Projet WMISPORT //////////////////////////////////////////////
	public function saveNewMember($post) {
		
		$newmember = new membres;
		$post['password'] = md5($post['password']);
		$post['activationCode'] = $this->activationCode = md5($this->generateCode('6','1','1'));
		if($newmember->newRecord($post))
			return 1;
		
		return 0;
	}
	
	public function go($location) {
		//var_dump($location);
		header("location:$location");
		die;
	}
	
	public function sendActivationLink($post) {
		$html = "Hi,<br /><br />
		<strong>To complete your WMISPORTS registration and/or email address update, click the following link:</strong>
		<br /><br />
		<strong><a href='".$this->buildActivationLink($post['login'])."'>Activate me</a></strong>
		<br /><br />
		...then, next time you sign in to WMISPORTS, you'll be fully activated and able to send email invites to teams you captain. 
		<br /> 	<br />
		(Clicking the link confirms you own this email address. When registering for WMISPORTS, it also automatically links any existing teams you're on to your account.) 
		<br /><br />
		Thanks for using WMISPORTS! 
		<br /><br /><br /><br />
		NOTE: If you did not sign up this email address for WMISPORTS or don't know what this is all about, please delete this email and hunt down whoever's messing with you. If it keeps happening, please report the abuse as per the instructions below. 
		<br />
		- thanks for using WMISPORTS
		<hr />
		The fine print...
		<br /><br />
		Opt out: If you want no part in this team or WMISPORTS, you can opt out at any time. This will prevent any further WMISPORTS emails being sent to your email address. 
		<br /><br />
		Legal blather: By using WMISPORTS you agree to abide by our super-simple Terms of Service; here is our Privacy Policy. 
		<br /><br />
		<a href=''>More info</a>"; 
		$headers ='From: "no-reply@wmisports.com"<no-reply@wmisports.com>'."\n"; 
		$headers .='Reply-To: no-reply@wmisports.com'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 
		mail($post['login'], '[WMISPORT]: activate your account!', $html, $headers);
		//$newmail->send();
	}
	
	public function sendWelcomeMessage($email) {
		// $newmail = new mail();
		
		// $newmail->setPriority(4);
		// $newmail->addTo($post['login']);
		// $newmail->addCc('pollux1er@yahoo.fr');
		// $newmail->setFrom('noreply@camertic.com');
		// $newmail->setSubject("[WMISPORT]: activate your account!");
		$html = '<div style="font-family:verdana, arial;font-size:10pt;"><span style="font-size:10pt;"><br><br>Dear ' . $email . ',<br><br><br><br><h2>Welcome to WMISPORTS!</h2><br><br>WMISPORTS has proven very useful to the teams using it, and hopefully it will be useful for your teams as well.<br><br><br>Below are some tips. If you need any help at all, or have any suggestions, don\'t hesitate to contact us at <font color="blue">info@wmisports.com</font> and we\'ll get back to you asap.<br><br>Thanks for using WMISPORTS,<br><br><br>- WMISPORTS Customer Service Dept.<br><b><a href="http://wmisports.com/" target="_blank">wmisports.com</a></b><br><br><br><br><br><font color="#c0c0c0">P.S.<br>You\'re being sent this email because someone registered at WMISPORTS using your email address. If it wasn\'t you, simply ignore the activation email that will also have been sent to your address, and you won\'t receive any further emails.<br></font><br>If you received this email in error and wish to opt out of receiving any further WMISPORTS emails ever, please email "unsubscribe@wmisports.com".<br><hr><h3>Captain tips:</h3><br><ul><li><b>Click the <b><font color="red">"3. Invite players"</font></b> link to invite players</b> to your team\'s games. That sends a single email to each player you select, allowing them to indicate their attendance at ALL games.<br><br></li><li><b>Tell your players to expect emails from</b> <font color="blue">r2d2@wmisports.com</font>, and check bulk/junk mail folders, spam filter settings, and/or add that to their address book. (You could tell them via an email from your own address.)<br><br></li><li><b>Click the link in the activation email that is sent to you</b> (if you haven\'t already), in order to complete registration &amp; be able to contact your players from WMISPORTS. (Check your spam/junk folders.)<br><br></li><li>You can also invite players to individual games, or remind players who\'ve already been invited: click the "invite/remind" link next to each game. (When possible, it\'s better to invite to all games at once to reduce email to your players.)<br><br></li><li>Contact players with your own message (without inviting to games): click the "Contact players" link. (As with game invites, you can choose to contact all players, or a selection of regular players/subs.)<br><br></li><li>Delegate to your assistant captains so they can help run the team on your behalf: see FAQ #4 in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><hr><h3>Player tips:</h3><br><ul><li><b>Click the link in the activation email that is sent to you</b>: that will automatically add any teams you\'re on to your new account (teams where you\'re using the same email address). You DON\'T need to type in the name of the team you\'re on: that\'s for creating a brand new team.<br><br></li><li>If you\'re on other teams (e.g. using a different email address), open one of the team emails you\'ve received. Click your schedule link, and then click "Register/add team to account".<br><br></li><li>If you need another email with your schedule link, go to WMISPORTS.com and click "Get your sched link email".<br><br></li></ul><hr><h3>Tips for everyone:</h3><br><ul><li>Hovering your mouse over buttons/links/other things will show info explaining what they do.<br><br></li><li>Tick the "remember me" checkbox when signing in, and next time you visit WMISPORTS.com on the same computer you\'ll be signed in automatically: no need to type your password. (Not recommended on shared computers.)<br><br></li><li>More info is in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><br><br><font color="#c0c0c0">5817</font></span></div>';
		//$newmail->setHtmlBody($html);
		//echo "<pre>"; var_dump($html); 
		$headers ='From: "WMI Customer Service Dept. "<r2d2@wmisports.com>'."\n"; 
		$headers .='Reply-To: r2d2@wmisports.com'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 
		mail($email, 'Welcome to WMISPORTS!', $html, $headers);
		//$newmail->send();
	}
	
	public function contactPlayer($name, $email, $title, $message) {
		$html = '<div style="font-family:verdana, arial;font-size:10pt;"><span style="font-size:10pt;"><br><br>Dear ' . $email . ',<br><br><br><br><h2>Welcome to WMISPORTS!</h2><br><br>WMISPORTS has proven very useful to the teams using it, and hopefully it will be useful for your teams as well.<br><br><br>Below are some tips. If you need any help at all, or have any suggestions, don\'t hesitate to contact us at <font color="blue">info@wmisports.com</font> and we\'ll get back to you asap.<br><br>Thanks for using WMISPORTS,<br><br><br>- WMISPORTS Customer Service Dept.<br><b><a href="http://wmisports.com/" target="_blank">wmisports.com</a></b><br><br><br><br><br><font color="#c0c0c0">P.S.<br>You\'re being sent this email because someone registered at WMISPORTS using your email address. If it wasn\'t you, simply ignore the activation email that will also have been sent to your address, and you won\'t receive any further emails.<br></font><br>If you received this email in error and wish to opt out of receiving any further WMISPORTS emails ever, please email "unsubscribe@wmisports.com".<br><hr><h3>Captain tips:</h3><br><ul><li><b>Click the <b><font color="red">"3. Invite players"</font></b> link to invite players</b> to your team\'s games. That sends a single email to each player you select, allowing them to indicate their attendance at ALL games.<br><br></li><li><b>Tell your players to expect emails from</b> <font color="blue">r2d2@wmisports.com</font>, and check bulk/junk mail folders, spam filter settings, and/or add that to their address book. (You could tell them via an email from your own address.)<br><br></li><li><b>Click the link in the activation email that is sent to you</b> (if you haven\'t already), in order to complete registration &amp; be able to contact your players from WMISPORTS. (Check your spam/junk folders.)<br><br></li><li>You can also invite players to individual games, or remind players who\'ve already been invited: click the "invite/remind" link next to each game. (When possible, it\'s better to invite to all games at once to reduce email to your players.)<br><br></li><li>Contact players with your own message (without inviting to games): click the "Contact players" link. (As with game invites, you can choose to contact all players, or a selection of regular players/subs.)<br><br></li><li>Delegate to your assistant captains so they can help run the team on your behalf: see FAQ #4 in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><hr><h3>Player tips:</h3><br><ul><li><b>Click the link in the activation email that is sent to you</b>: that will automatically add any teams you\'re on to your new account (teams where you\'re using the same email address). You DON\'T need to type in the name of the team you\'re on: that\'s for creating a brand new team.<br><br></li><li>If you\'re on other teams (e.g. using a different email address), open one of the team emails you\'ve received. Click your schedule link, and then click "Register/add team to account".<br><br></li><li>If you need another email with your schedule link, go to WMISPORTS.com and click "Get your sched link email".<br><br></li></ul><hr><h3>Tips for everyone:</h3><br><ul><li>Hovering your mouse over buttons/links/other things will show info explaining what they do.<br><br></li><li>Tick the "remember me" checkbox when signing in, and next time you visit WMISPORTS.com on the same computer you\'ll be signed in automatically: no need to type your password. (Not recommended on shared computers.)<br><br></li><li>More info is in the <a href="http://info.wmisports.com/wtf#faqs" target="_blank">FAQs</a>.</li></ul><br><br><font color="#c0c0c0">5817</font></span></div>';
		//$newmail->setHtmlBody($html);
		//echo "<pre>"; var_dump($html);
		$teamName = "";
		$subject = "$title / $teamName";
		$headers ='From: "$email / WMISPORTS "<r2d2@wmisports.com>'."\n"; 
		$headers .='Reply-To: r2d2@wmisports.com'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 
		mail($email, $subject, $html, $headers);	
	}
	
	public function contactPlayers($players) {
	
	}
	
	protected function buildActivationLink($email) {
		$link = $this->rootUrl . "activation.php?uact=";
		$link .= $this->activationCode . "&email=" . $email;
		return $link;
	}
	
	public function checkActivationCode($codeAct) { // Verifier que le code d'activation existe bel et bien
		$req = "SELECT * FROM membres WHERE activationCode = '$codeAct' AND activated = '0' LIMIT 1";
		$res = $this->countResult($req);
		if($res == 1) {
			$this->activateMember($codeAct);
			return true;
		} else
			return false;
	}
	
	public function checkActivation($login) { // Verifier que le membre et deja actif
		$req = "SELECT * FROM membres WHERE login = '$login' AND activated = '0' LIMIT 1";
		//var_dump($req); 
		$res = $this->countResult($req);
		//var_dump($res); die;
		if($res == 1) {
			return true;
		} else
			return false;
	}
	
	private function activateMember($codeAct) {
		$query = "UPDATE membres SET `activated` = '1' WHERE activationCode = '" . $codeAct . "';";
		$this->sql($query);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>