<?php //account/logout.php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/init.php");

$_SESSION["login"] = null;
unset($_SESSION["login"]);

session_unset();
session_destroy();

if ( isset($_SERVER['HTTP_COOKIE']) ) {
	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
	foreach($cookies as $cookie) {
		$parts = explode('=', $cookie);
		$name = trim($parts[0]);
		setcookie($name, '', time()-1000);
		setcookie($name, '', time()-1000, '/');
	}
}

header("Location: /");
die; ?>
