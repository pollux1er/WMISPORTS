<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	require_once('../config.php');
	require_once('../lib/library.php');
	require_once('../lib/classes/entity.class.php');
	require_once('../lib/classes/WMI.class.php');
	require_once('../lib/classes/joueurs.class.php');
	require_once('../lib/classes/equipes_joueurs.class.php');
	require_once('../lib/classes/rencontres.class.php');

	$C = new CamerticConfig;
	
	$app = new WMI;

	// Check session
	if(!$app->checkSession()) {
		header('location:./index.html');
		die();
	}
	
	global $idcaptain;

	$captain = new utilisateur(); 
	$j = new joueurs();
	
	// Traitement des variables
	$nbjoueurs = count($_POST['player']);
	
	$i = 1;
	$joueurs = array();
	for($i; $i <= $nbjoueurs; $i++) {
		if(empty($_POST['player'][$i])) {
			unset( $_POST['player'][$i]);
			unset( $_POST['email'][$i]);
		}
	}
	$i = 1;
	for($i; $i <= count($_POST['player']); $i++) {
		if($_POST['player'][$i]) {
			$joueur = array();
			$joueur['noms'] = $_POST['player'][$i];
			$joueur['email'] = $_POST['email'][$i];
			isset($_POST['sub'][$i]) ? $joueur['remplacant'] = $_POST['sub'][$i] : $joueur['remplacant'] = 'n';
			isset($_POST['capass'][$i]) ? $joueur['assistant'] = $_POST['capass'][$i] : $joueur['assistant'] = 'n';
			isset($_POST['position']) ? $joueur['position'] = $_POST['position'][$i] : $joueur['position'] = 'n'; 
			$joueur['notes'] = $_POST['notes'][$i];
			$joueur['equipes'] = $_GET['idteam'];
			$j->saveTeamPlayer($joueur, $_GET['idteam']);
		}
	}
	$app->url = $app->rootUrl . 'dashboard/team/'. $_GET['idteam'] . '/addplayers?success';
	$app->go($app->url);
	
	/* try {
		$app->url = $app->rootUrl . 'dashboard/team/'. $eq->lastId();
		//var_dump($app->url); die;
		$app->go($app->url);
	} catch (Exception $e) {
		echo 'Error message : ' . $e->getMessage() . "\n";
	} */
}
?>