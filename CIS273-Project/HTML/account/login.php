<?php //account/login.php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/init.php");

if ( !empty($_SESSION["login"]) ) {
	if ( empty($_GET["return_uri"]) ) 
		header("Location: /");
	else 
		header("Location: ".$_GET["return_uri"]);
	die;
}



if ( !empty($_POST["email"]) and !empty($_POST["password"]) ) {
	$login = query("
		SELECT
			Login.*
		FROM		Login
		WHERE Login.email = ?",
		"s", $_POST["email"]);
	if ( !$login ) {
		header("Location: /account/login.php");
		die;
	}
	$login = $login[0];

	if ( !password_verify($_POST["password"], $login["password"]) ) {
		header("Location: /account/login.php");
		die;
	}

	if ( password_needs_rehash($login["password"], PASSWORD_DEFAULT) ) query("
		UPDATE Login
		SET	password = ?
		WHERE id = ?",
		"si", password_hash($_POST["password"], PASSWORD_DEFAULT), $login["id"]);
	unset($login["password"]);

	$_SESSION["login"] = $login;
	if ( empty($_GET["return_uri"]) ) 
		header("Location: /");
	else 
		header("Location: ".$_GET["return_uri"]);
	die;
}



require_once("$_SERVER[DOCUMENT_ROOT]/resource/header.php"); ?>
<div style="position:absolute;top:0;left:0;right:0;bottom:0; background-image:url('/resource/image/woodbg.jpg');background-size:100%;z-index:-1;">
	<form method="post" style="background-color:hsla(0,0%,98%, 90%);border:3px solid rgb(239,217,194);text-shadow:none;width:67.4%;margin:2% auto;padding:5%;color:black;text-align:center;">
		<h1>Log in to access your account.</h1>
		<p><i>Don't have an account? <a href="/account/signup.php">Sign up here!</a></i></p><br>
		<label>Email
			<input type="email"		name="email"	autocomplete="username" autofocus>
		</label>
		<label>Password
			<input type="password"	name="password"	autocomplete="current-password">
		</label>
		<br><br>
		<input type="submit"	id="loginbutton"    name="action"	value="Login">
	</form>
</div><?php

require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");
