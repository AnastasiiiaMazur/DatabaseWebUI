<?php
include("db.php");
if(isset($_POST['save']))
{	 
    $keys = array_keys($_POST);
	$fields = 2;
	// Create the query
	$sql="INSERT INTO " . $_POST["table_name"] . " (";
	for($i = 0; $i < count($keys) - $fields; $i++){
		$sql .= $keys[$i] . ",";
	}
	$sql = substr($sql, 0, -1) . " ) VALUES (";
	for($i = 0; $i < count($keys)-$fields; $i++){
		$sql .= "'" . $_POST[$keys[$i]] . "',";
	}
	$sql = substr($sql, 0, -1) . ")";
	$exeSQLquery=mysqli_query($conn, $sql) or die (mysqli_error($conn));

	header("Location: ".strtolower($_POST["table_name"]).".php");
	
}