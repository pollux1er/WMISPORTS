<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	require_once('../config.php');
	require_once('../lib/library.php');
	require_once('../lib/classes/entity.class.php');
	require_once('../lib/classes/WMI.class.php');
	require_once('../lib/classes/joueurs.class.php');

	$C = new CamerticConfig;
	$app = new WMI;

	// Check session
	if(!$app->checkSession()) {
		header('location:./index.html');
		die();
	}
	
	$captain = new utilisateur(); 
	$j = new joueurs();
	$j->delRecord($_GET['idplayer']);
		
	$app->url = $app->rootUrl . 'dashboard/team/'. $_GET['idteam'] . '/addplayers';
	$app->go($app->url);
	
	
}
?>