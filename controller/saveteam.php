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

	global $idcaptain;

	$captain = new utilisateur(); 
	
	// Traitement des variables a exclure
	
	// Exclusion des variables 
	if(isset($_POST['sport'])) unset($_POST['sport']);
	//if(isset($_POST['sport'])) unset($_POST['sport']);
	
	// Ajout des variables necessaires
	$_POST['capitaine'] = $_SESSION['iduser'];
	
	
	// echo "<pre>";
	// var_dump($_POST); die;
	require_once('../lib/classes/WMI.class.php');
	$eq = new equipes; 
	
	
	try {
		$eq->saveRecord($_POST);
		$app->url = $app->rootUrl . 'dashboard/view/team/'. $eq->lastId();
		//var_dump($app->url); die;
		$app->go($app->url);
	} catch (Exception $e) {
		echo 'Error message : ' . $e->getMessage() . "\n";
	}
}
?>