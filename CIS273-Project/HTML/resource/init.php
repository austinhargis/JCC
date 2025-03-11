<?php //resource/init.php

session_start();

// Connect to database
$db = new mysqli("localhost", "gardenplanner", "{*(E/y7zTu@fZy4^", "gardenplanner");
if ( !$db or $db -> connect_error )
	throw new Exception("Could not connect to database");


// Query Wapper
function query(string $sql, string $type_list = "", ...$values) {
	global $db;
	if ( empty($db) )
		throw new Exception("Database connection does not exist");
	$query = $db->prepare($sql);
	if ( !$query or $db->errno )
		throw new Exception("Could not prepare query " . $db->error);
	if ( $type_list or $query->param_count )
		$query->bind_param($type_list, ...$values);
	if ( !$query->execute() or $db->errno )
		die("Failed to execute query " . $query->error);
	if ( $query->field_count ) {
		$res = $query->get_result();
		if ( !$res or $db->errno )
			throw new Exception("Query execution failed " . $db->error);
		$ret = $res->fetch_all(MYSQLI_ASSOC);
		$query->close();
		$res->free();
		return $ret;
	}
	elseif ( $query->affected_rows == 1 and $query->insert_id )
		return $query->insert_id;
	else
		return $query->affected_rows;
}
