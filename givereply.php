<?php

require_once 'config.php';
GLOBAL $app;
$C = new CamerticConfig;
$app = new WMI;

if(isset($_GET['uact'])) {
	if($app->checkActivationCode($_GET['uact'])) { // Si le code d'activation existe on valide une fois l'activation du gars
		$app->urlIndex .= "?log=first";
		$app->sendWelcomeMessage($_GET['email']);
		//var_dump($app->urlIndex); die;
		$app->go($app->urlIndex);
	} else
		$app->go($app->urlLogin);
	
} else {
	$app->go($app->urlLogin);
}
?>