<?php

include("db.php");

echo "<link rel=stylesheet type=text/css href=styles.css>"; 

echo "<body>";

include ("header.html"); 

$service_name = "дитяча кімната";

$SQLquery="SELECT E.empName, E.empEmail, E.empSalary, S.servName, S.servPrice 
FROM Employee E
JOIN ServEmp SE ON E.empId = SE.empId
JOIN Services S ON S.servId = SE.servId
WHERE S.servName = '".$service_name."'";
$exeSQLquery=mysqli_query($conn, $SQLquery) or die (mysqli_error($conn));

//echo "<h2>Клієнти</h2>";
echo"<h1>Запит</h1>";

echo "<table style='border: 0px'>";

echo "<tr>";
echo "<td><b>ПІБ працівника</b></td>";
echo "<td><b>Посада</b></td>";
echo "<td>Заробітна плата</td>";
echo "<td>Назва послуги</td>";
echo "<td>Ціна послуги</td>";
echo "</tr>";

while ($array=mysqli_fetch_array($exeSQLquery))
{
    echo "<tr>";

    echo "<td>";
    echo "<p>".$array['empName']."</p>"; 
    echo "</td>";
    echo "<td>";
    echo "<p>".$array['empEmail']."</p>"; 
    echo "</td>";
    echo "<td>";
    echo "<p>".$array['empSalary']."</p>"; 
    echo "</td>";
    echo "<td>";
    echo "<p>".$array['servName']."</p>"; 
    echo "</td>";
    echo "<td>";
    echo "<p>".$array['servPrice']."</p>"; 
    echo "</td>";

    echo "</tr>";
}
echo "</table>";

include("footer.html"); 

echo "</body>";
?>