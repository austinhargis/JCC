<?php //log.php
require_once("$_SERVER[DOCUMENT_ROOT]/resource/init.php");
$page_title = "Plant Log";

if ( empty($_SESSION["login"]) ) {
	header("Location:/account/login.php?return_uri=".$_SERVER["REQUEST_URI"]);
	die;
}


$user = $_SESSION["login"]["id"];

$log = query("
	SELECT *
	FROM Log
	WHERE Log.id = ?",
	"i", $_GET["id"]??null)[0]??[];

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) switch ( $_POST["action"] ?? "upload" ) {
	case "submit":
		if ( $log ) {
			query("
				INSERT INTO Log
				SET	name			= ?,
					datesewn		= ?,
					notes			= ?,
					userid			= $user",
				"sss",
				$_POST["name"],
				$_POST["datesewn"],
				$_POST["notes"]);
			header("Location: /log.php");
			die;
		}
		else {
			$log["id"] = query("
				INSERT INTO Log
				SET	name			= ?,
					datesewn		= ?,
					notes			= ?,
					userid 			= $user",
				"sss",
				$_POST["name"],
				$_POST["datesewn"],
				$_POST["notes"]);
			header("Location: /log.php");
			die;
		}
	case "delete":
		if ( !$log ) {
			http_response_code(404);
			die;
		}
		$id = query("
			DELETE
			FROM Log
			WHERE id = ?",
			"i", $log["id"]);
		die($id);
}



require_once("$_SERVER[DOCUMENT_ROOT]/resource/header.php"); ?>


<div class="addplant">
	<form method="post">
		<h1>Add a Plant</h1>
		
		<input type="hidden" name="action" value="submit">
		
		<label for="name">Name
			<input type="text" name="name" placeholder="e.x. Basil">
		</label><br>
		
		<label for="datesewn">Date Sewn
			<input type="date" name="datesewn" min="2000-01-02">
		</label><br>
		
		<label for="notes">Notes
			<textarea name="notes" rows="4" cols="25"></textarea>
		</label><br>
		
		<input type="submit" value="submit">
	</form>

</div>

<div class="plantlog">
		<h1>My Plants</h1>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Date Sewn</th>
					<th>Notes</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody><?php
				$userLog = query("
					SELECT
						Log.id,
						Log.name,
						Log.datesewn,
						Log.notes,
						Log.userid
					FROM Log
					LEFT JOIN Login ON Log.userid = Login.id");
				foreach ($userLog as $log) { ?>
					<tr>
						<td><?= $log["name"] ?></td>
						<td><?= $log["datesewn"] ?></td>
						<td><?= $log["notes"] ?></td>
						<td onclick="delete_plant(<?= $log["id"] ?>)"style="padding: 0;">
							<center><img src="/resource/image/delete.png"width="35px;"style="margin-top: 0.4rem;"></center>
						</td>
					</tr><?php
				} ?>
			</tbody>
		</table>
		
		<script>
			function delete_plant(id) {
				if ( !confirm("Are you sure you want to delete this plant?") )
					return;
				var ajax = new XMLHttpRequest();
				ajax.open("POST", "/log.php?id=" + id, false);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send("action=delete");
				if ( ajax.status == 200)
					window.location.reload();
				window.location="/log.php";
			}
		</script><?php
		
		if ( !$log ) { ?>
		</div><?php
		require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");
		die;
	} ?>
	</div>
	
<div class="clear">
	
</div>


<?php



require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");