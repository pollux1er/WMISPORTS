<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	require_once('../config.php');
	require_once('../lib/library.php');
	require_once('../lib/classes/entity.class.php');
	require_once('../lib/classes/WMI.class.php');
	require_once('../lib/classes/rencontres.class.php');
	require_once('../lib/classes/joueurs.class.php');
	require_once('../lib/classes/membres.class.php');

	$C = new CamerticConfig;
	
	$app = new WMI;
	$pathfolder = getcwd() . DS ;
	// echo "<pre>";var_dump($C);
	// var_dump($pathfolder);
	// die;
	// Check session
	if(!$app->checkSession()) {
		header('location:./index.html');
		die();
	}

	global $idcaptain;
	//  
	// var_dump($_POST); 
	// die;
	$r = new rencontres(); 
	$j = new joueurs(); 
	$joueur = $j->getRecord($_GET['player']);
	$game = $r->getRecord($_GET['game']);
	// Traitement des variables a exclure
	$url_invite_mail = "./";
	//$html = file_get_contents($url_invite_mail);	
	try {
		$r->invitePlayer($_GET['game'], $_GET['player'], $joueur->noms, $joueur->email, $_POST['subject'], $_POST['message']);
		$app->url = $app->rootUrl . 'dashboard/view/team/' . $_GET['idteam'];
		
		$app->go($app->url);
	} catch (Exception $e) {
		echo 'Error message : ' . $e->getMessage() . "\n";
	} 
}
?>