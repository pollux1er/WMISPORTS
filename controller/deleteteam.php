<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	require_once('../config.php');
	require_once('../lib/library.php');
	require_once('../lib/classes/entity.class.php');
	require_once('../lib/classes/WMI.class.php');
	require_once('../lib/classes/equipes.class.php');

	$C = new CamerticConfig;
	$app = new WMI;

	// Check session
	if(!$app->checkSession()) {
		header('location:./index.html');
		die();
	}
	
	$captain = new utilisateur(); 
	$j = new equipes();
	$j->delRecord($_GET['idteam']);
		
	$app->url = $app->rootUrl . "dashboard/view/newteam/" . $_SESSION['iduser'];
	$app->go($app->url);
	
	
}
?>