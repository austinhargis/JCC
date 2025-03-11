<?php //resource/header.php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/init.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/resource/main.css?<?= filemtime("$_SERVER[DOCUMENT_ROOT]/resource/main.css") ?>" />
		<link rel="stylesheet" href="/resource/screen.css?<?= filemtime("$_SERVER[DOCUMENT_ROOT]/resource/screen.css") ?>"		media="screen" />
		<link rel="stylesheet" href="/resource/desktop.css?<?= filemtime("$_SERVER[DOCUMENT_ROOT]/resource/desktop.css") ?>"	media="screen and (min-width: 801px)" />
		<title><?= $page_title ?? "Garden Planner" ?></title>
	</head>
	
	<body>
		<header>
			<nav>
				<ul>
					<li><a class="<?= $_SERVER["SCRIPT_NAME"] == "/index.php"	? "current" : "" ?>" href="/">HOME</a></li>
					<li><a class="<?= $_SERVER["SCRIPT_NAME"] == "/search.php"	? "current" : "" ?>" href="/search.php">SEARCH</a></li>
					<li><a class="<?= $_SERVER["SCRIPT_NAME"] == "/zone.php"	? "current" : "" ?>" href="/zone.php">ZONE</a></li>
					<li><a class="<?= $_SERVER["SCRIPT_NAME"] == "/log.php"	? "current" : "" ?>" href="/log.php">PLANT LOG</a></li><?php
					if ( empty($_SESSION["login"]) ) { ?>
						<li><a href="/account/login.php">LOG IN</a></li><?php
					}
					else { ?>
						<li><a href="/account/logout.php">LOG OUT</a></li><?php
					} ?>
				</ul>
			</nav>
		</header>
		
		<main>