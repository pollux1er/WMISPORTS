<?php
@session_start();

require_once 'config.php';
GLOBAL $app;
$C = new CamerticConfig;
$app = new WMI;
if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['username']) && !empty($_POST['password'])) {
	//require_once('_connect_.php');
	$clean = array();
	$mysql = array();
	
	$now = time();
	$max = $now - 15;
	
	$salt = 'duo';

	if (ctype_alnum($_POST['username'])) {
		$clean['username'] = $_POST['username'];
	}
	else {
		//die('trou');
	}
	
	//$camertic = new CamerticConfig('../lib/library.php');
	
	$user = new utilisateur;//var_dump(session_id()); die();
	//;
	
	if($user->simpleLogin($_POST['username'], $_POST['password'])) {
		//
		
		$app->go($app->urlIndex);
	}
	else {
		//$badattempt = true;
		$app->urlLogin .= "?log=failure&ip=" . $_SERVER['REMOTE_ADDR'];
		$app->go($app->urlLogin);
	}
	
} else {
	$app->urlLogin .= "?log=failure&ip=" . $_SERVER['REMOTE_ADDR'];
	$app->go($app->urlLogin);
}
?>