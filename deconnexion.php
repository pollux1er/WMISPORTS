<?php
	session_start();
	unset($_SESSION);
	session_destroy();
	require_once 'config.php';
	GLOBAL $app;
	$C = new CamerticConfig;
	$app = new WMI;
	$app->urlLogin = $C->rootUrl . $app->urlLogin;
	$app->go($app->urlLogin);
?>