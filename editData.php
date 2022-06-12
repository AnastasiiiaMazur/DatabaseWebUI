<?php

include("db.php");
if(isset($_POST['update']))
{	 
    $keys = array_keys($_POST);
    $fields = 4;
	
	$sql="UPDATE " . $_POST["table_name"] . " SET ";
	for($i = 0; $i < count($keys) - $fields; $i++){
		$sql .= $keys[$i] . " = '" . $_POST[$keys[$i]] . "',";
	}
	$sql = substr($sql, 0, -1) . " WHERE " . $_POST["tableId"] . " = '" . $_POST["tableIdVal"] . "'";
    var_dump($sql);
	$exeSQLquery=mysqli_query($conn, $sql) or die (mysqli_error($conn));

	header("Location: ".strtolower($_POST["table_name"]).".php");
	
}