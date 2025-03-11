<?php require_once("$_SERVER[DOCUMENT_ROOT]/resource/header.php"); ?>

<div class="grid-container">
	<div class="grid-item">
		<a href="/search.php">
			<img src="/resource/image/magnify.jpg" width="100%">
			<div class="grid-title">Search</div>
		</a>
	</div>

	<div class="grid-item">
		<a href="/zone.php">
			<img src="/resource/image/zone-map.jpg">
			<div class="grid-title">Zone</div>
		</a>
	</div>

	<div class="grid-item">
		<a href="/log.php">
			<img src="/resource/image/gpicon1.jpg">
			<div class="grid-title">Plant Log</div>
		</a>
	</div>

	<div class="grid-item">
		<a href="/account/signup.php">
			<img src="/resource/image/garden.jpg">
			<div class="grid-title">Create Account</div>
		</a>
	</div>
</div>


<?php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");