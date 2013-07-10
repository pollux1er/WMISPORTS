<?php

// La seule methode dacces a cett page est le post
require_once 'config.php';
GLOBAL $app;

$C = new CamerticConfig;
// echo "<pre>";
// var_dump($_POST);
$app = new WMI;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	
	$_POST['login'] = $_POST['username'];
	//////// Destruction des variables inutile /////////
	unset($_POST['username']);
	unset($_POST['password2']);
	unset($_POST['terms']);
	////////////////////////////////////////////////////////
	// var_dump($_POST); die;
	if(!$app->saveNewMember($_POST)) { // Enregistrer le nouveau membre
		die('Impossible d enregistrer le nouveau membre!!! Erreur BD!');
	}
	$app->sendActivationLink($_POST); // Envoi du lien dactivation par email
	
	$user = new utilisateur;//var_dump(session_id()); die();
	//;
	
	$user->simpleLogin($_POST['login'], $_POST['password']);
	
	$app->go($app->urlIndex);  // Rediriger vers le dashboard

} else {

	$app->go($app->urlLogin);

}
?>