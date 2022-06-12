<?php

include("db.php");

$service_name = "";
$SQLquery="SELECT E.empName, E.empEmail, E.empSalary, S.servName, S.servPrice FROM Employee E JOIN ServEmp SE ON E.empId = SE.empId JOIN Services S ON S.servId = SE.servId";
$exeSQLquery=mysqli_query($conn, $SQLquery) or die (mysqli_error($conn));
$list = array();
while($array=mysqli_fetch_array($exeSQLquery)){
    array_push($list, $array["empName"]);
}

?>


<html>
<body>
<?php include ("header.html") ?>
    <div class="container" >
    <select name="" id="">
        <option value=""></option>
    <?php 
    for ($i = 0; $i < count($list); $i++){
        ?>
        <option value="<?php echo $list[$i];?>"><?php echo $list[$i];?></option>


    <?php } ?>
    </select>
    </div>


</body>
</html>




<?php include ("footer.html") ?>
