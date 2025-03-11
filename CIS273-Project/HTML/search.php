<?php //search.php
$page_title = "Search Plants";
require_once("$_SERVER[DOCUMENT_ROOT]/resource/header.php"); ?>

<div class="plantsearch">
	<form action="/search.php" method="get">
		<h1>Search for a Plant:</h1>
		
		<label for="name">Name
			<select name="name">
				<option></option>
				<?php 
				$result = array_column(query("SELECT name FROM Plant ORDER BY name"), "name"); 
				$selectedOption = $_GET["name"]??null; 
				foreach ($result as $plant) { ?>
					<option value="<?= $plant ?>" <?= $plant == $selectedOption ? "selected" : "" ?> ><?= $plant ?></option><?php
				} ?>
			</select>
		</label>
		
		<label for="type">Type
			<select name="type">
				<option></option>
				<?php 
				$result = query("SELECT id, value FROM Lookup WHERE Lookup.type = 'Plant.type' ORDER BY value"); 
				$selectedOption = $_GET["type"]??null; 
				foreach ($result as $type) { ?>
					<option value="<?= $type["id"] ?>" <?= $type["id"] == $selectedOption ? "selected" : "" ?>><?= $type["value"] ?></option><?php
				} ?>
			</select>
		</label>
		
		<label for="sun">Sun
			<select name="sun">
				<option></option>
				<?php 
				$result = array_column(query("SELECT DISTINCT sun FROM Plant ORDER BY sun"), "sun"); 
				$selectedOption = $_GET["sun"]??null; 
				foreach ($result as $plant) { ?>
					<option value="<?= $plant ?>" <?= $plant == $selectedOption ? "selected" : "" ?>><?= $plant ?></option><?php
				} ?>
			</select>
		</label>
		
		<label for="soil">Soil
			<select name="soil">
				<option></option>
				<?php 
				$result = array_column(query("SELECT DISTINCT soil FROM Plant ORDER BY soil"), "soil"); 
				$selectedOption = $_GET["soil"]??null; 
				foreach ($result as $plant) { ?>
					<option value="<?= $plant ?>" <?= $plant == $selectedOption ? "selected" : "" ?>><?= $plant ?></option><?php
				} ?>
			</select>
		</label>
		
		<label for="zone">Zone
			<select name="zone">
				<option></option>
				<?php 
				$result = query("
					SELECT 
						Zone.id,
						Zone.name,
						Plantzone.plant,
						Plantzone.zone
					FROM Zone
					LEFT JOIN Plantzone ON Zone.id = Plantzone.zone
					GROUP BY Plantzone.zone
					ORDER BY Zone.id"); 
				$selectedOption = $_GET["zone"]??null; 
				foreach ($result as $zone) { ?>
					<option value="<?= $zone["id"] ?>" <?= $zone["id"] == $selectedOption ? "selected" : "" ?>><?= $zone["name"] ?></option><?php
				} ?>
			</select>
		</label><br>
		
		<input type="submit">
	</form>
</div><?php
$where_string = "WHERE TRUE";
$type_string = "";
$args_list = [];

if (!empty($_GET["id"])) {
	$where_string.= " AND Plant.id = ?";
	$type_string.= "i";
	$args_list[] = $_GET["id"];
}
if (!empty($_GET["name"])) {
	$where_string.= " AND Plant.name = ?";
	$type_string.= "s";
	$args_list[] = $_GET["name"];
}
if (!empty($_GET["type"])) {
	$where_string.= " AND Plant.type = ?";
	$type_string.= "i";
	$args_list[] = $_GET["type"];
}
if (!empty($_GET["sun"])) {
	$where_string.= " AND Plant.sun = ?";
	$type_string.= "s";
	$args_list[] = $_GET["sun"];
}
if (!empty($_GET["soil"])) {
	$where_string.= " AND Plant.soil = ?";
	$type_string.= "s";
	$args_list[] = $_GET["soil"];
}
if (!empty($_GET["zone"])) {
	$where_string.= " AND Plantzone.zone = ?";
	$type_string.= "i";
	$args_list[] = $_GET["zone"];
}

$plantResult = query("
	SELECT
		Plant.id,
		Plant.name,
		PlantType.value type,
		Plant.sun,
		Plant.soil,
		Plant.image,
        Plantzone.zone
	FROM ((Plant
	INNER JOIN Lookup PlantType ON Plant.type = PlantType.id)
    INNER JOIN Plantzone ON Plant.id = Plantzone.plant)
	$where_string
	GROUP BY Plant.id",
	$type_string,
	...$args_list);
	
foreach ($plantResult as $plant) { ?>
	<div class="plantresult">
		<h1><?= $plant["name"] ?></h1>
		<img src="<?=$plant["image"]?>">
		<ul class="indented-list">
			<li><?= $plant["name"] ?></li>
			<li><?= $plant["type"] ?></li>
			<li>Prefers <?= $plant["sun"] ?> and <?= $plant["soil"] ?> soil</li><?php
			$allZones = query("
				SELECT
					Plantzone.zone
				FROM Plantzone
				LEFT JOIN Plant ON Plantzone.plant = Plant.id
				WHERE Plant.id = ?
				ORDER BY Plantzone.zone",
				"i", $plant["id"]);
				$last = array_pop($allZones); ?>
			<li>Grows in Zones: <?php foreach ($allZones as $zones) { 
			$str = $zones["zone"];
			$str .= ", "; ?>
			<?= $str ?><?php
			} echo "& " . $last["zone"]; ?></li>
		</ul>
	</div><?php
} ?>
<div class="clear">

</div>
<?php



require_once("$_SERVER[DOCUMENT_ROOT]/resource/footer.php");