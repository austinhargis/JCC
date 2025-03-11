<?php //account/signup.php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/init.php");



if ( !empty($_POST["firstname"]) and !empty($_POST["lastname"]) and !empty($_POST["email"]) and !empty($_POST["password"]) )  {
	$result = query("INSERT INTO Login (firstname, lastname, email, password)
	VALUES (?,?,?,?)", "ssss", $_POST["firstname"], $_POST["lastname"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
	header("Location:/account/signup.php" . ($result ? "?success=1" : "") );
	die;
}



require_once("$_SERVER[DOCUMENT_ROOT]/resource/header.php"); ?>
<div style="position:absolute;top:0;left:0;right:0;bottom:0;background-image:url('/resource/image/woodbg.jpg');background-size:100%;z-index:-1;">
	<form method="post" style="background-color:hsla(0,0%,98%, 90%);border:3px solid rgb(239,217,194);text-shadow:none;width:67.4%;margin:2% auto;padding:5%;color:black;text-align:center;">
		<h1>Create an account.</h1>
		<label>First Name
			<input type="text"	name="firstname"	autocomplete="firstname" autofocus required>
		</label>
		<label>Last Name
			<input type="text"	name="lastname"	autocomplete="lastname" required>
		</label>
		<br>
		<label>Email
				<input type="email"	name="email"	autocomplete="username" autofocus required>
			</label>
		<label>Password
			<input type="password"	name="password" required><br>
		</label>
		<br><br>
			<input type="submit"	id="signupbutton"    name="action"	value="Sign Up"><br>
	</form>
</div>
<div>
	<form method="post" id="signup"><br>
		<pre>
			<br>
		</pre>
	</form>
</div><?php

if ( !empty($_GET["success"]) ) {
	echo "Account successfully created. You may now log in. ";
}

require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");
