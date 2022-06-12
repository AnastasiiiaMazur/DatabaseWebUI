<?php
include("db.php");
$sql = "DELETE FROM " . $_GET["tableName"] . " WHERE " . $_GET["nameId"] . "='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
header("Location: ".strtolower($_GET["tableName"]).".php");

?>