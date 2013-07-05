<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	require_once('../config.php');
	require_once('../lib/library.php');
	require_once('../lib/classes/entity.class.php');
	require_once('../lib/classes/WMI.class.php');
	require_once('../lib/classes/rencontres.class.php');
	require_once('../lib/classes/joueurs.class.php');

	$C = new CamerticConfig;
	
	$app = new WMI;

	// Check session
	if(!$app->checkSession()) {
		header('location:./index.html');
		die();
	}

	global $idcaptain;

	$captain = new utilisateur(); 
	
	// Traitement des variables a exclure
	
	// Exclusion des variables 
	//if(isset($_POST['sport'])) unset($_POST['sport']);
	
	// Ajout des variables necessaires
	$_POST['capitaine'] = $_SESSION['iduser'];
	
	$games = new rencontres;
	// echo "<pre>";
	// var_dump($_POST['date']); 
	// var_dump(implode($_POST['date'])); 
	// var_dump(strlen(implode($_POST['date']))); 
	if(strlen(implode($_POST['date'])) != 0) {
		$games->saveDates($_POST['date'], $_POST['status'], $_POST['notes'], $_GET['idteam']);
	}
	$app->url = $app->rootUrl . 'dashboard/team/'. $_GET['idteam'] . '/addgames?success';
	$app->go($app->url);
	//die;
	 
	
	
	
}
?>