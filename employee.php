<?php

include("db.php");
$SQLquery = "select empName, empEmail, empPosition, empSalary, empDep, empId from Employee";
$exeSQLquery = mysqli_query($conn, $SQLquery) or die(mysqli_error($conn));
$list = array();
while ($array = mysqli_fetch_array($exeSQLquery)) {
    array_push($list, $array);
}
$newlist = $list;
$search_names = array("empName", "empEmail", "empPosition", "empSalary", "empDep", "empId");
$search_label = array("ПІБ працівника", "Контактні дані", "Посада", "Заробітня плата", "Відділ");

$val_list = array(array(), array(), array(), array(), array(), array());

for ($i = 0; $i < sizeof($list); $i++) {

    for ($j = 0; $j < count(array_count_values($list[0])); $j++) {
        array_push($val_list[$j], $list[$i][$j]);
    }
}

for ($j = 0; $j < 5; $j++) {
    $val_list[$j] = array_values(array_unique($val_list[$j]));
}

if(array_key_exists("id", $_GET)){
    $id = $_GET["id"];
}else{
    $id = "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newlist = array();
    $formvals = array($_POST["empName"], $_POST["empEmail"], $_POST["empPosition"], $_POST["empSalary"], $_POST["empDep"]);


    for ($k = 0; $k < count($list); $k++) { //rows
        $val = $list[$k];
        $skip = 0;
        for ($t = 0; $t < 5; $t++) { //columns

            if (empty($formvals[$t])) {
                continue;
            }

            if (strcmp($formvals[$t] . "", $val[$t] . "") === 0) {
                $skip = 0;
            } else {
                $skip = 1;
                break;
            }
        }

        if ($skip == 0) {
            array_push($newlist, $val);
        }
    }
}


?>
<html>

<header>
    <link rel=stylesheet type=text/css href=styles.css>
</header>

<body>
    <?php include("header.html") ?>
    <div id="main">
        <h2>Працівники</h2>

        <div>
            <form method="post">
                <?php
                for ($j = 0; $j < 5; $j++) {
                ?>
                    <select name="<?php echo $search_names[$j]; ?>">
                        <option value=''></option>
                        <?php for ($i = 0; $i < sizeof($val_list[$j]); $i++) {
                        ?>
                            <option value="<?php echo $val_list[$j][$i]; ?>"><?php echo $val_list[$j][$i]; ?></option>
                        <?php } ?>
                    </select>

                <?php } ?>
                <button type="submit">search</button>
            </form>

        </div>

        <div class="modal_window" id="modal_window">
            <div class="modal_content" >
            <span class="close">&times;</span>
                <form method="post" action="addData.php">
            <?php
                for ($j = 0; $j < 5; $j++) {
                ?>
                    <p class="label" ><?php echo $search_label[$j]; ?>:</p>
                    <input type="text" name="<?php echo $search_names[$j]; ?>">
                <br>
                <?php } ?>
                    <input type="hidden" name="table_name" value="Employee" />
                    <input class="sub_btn" type="submit" name="save" value="submit">      
                </form>     
            </div>
        </div>

        <table style='border: 0px'>

            <tr>
                <td>ПІБ працівника</td>
                <td>Контактні дані</td>
                <td>Посада</td>
                <td>Заробітня плата</td>
                <td>Відділ</td>
                <td></td>
                <td></td>
            </tr>

            <?php for ($i = 0; $i < count($newlist); $i++) {
                $array = $newlist[$i]
            ?>
                <tr>
                <?php 
                        if(strcmp($id, $array[5]) == 0){
                    ?>
                        <form method="post" action="editData.php">
                            <td>
                                <input type="text" name="empName" value="<?php echo $array[0] ?>" />
                            </td>
                            <td>
                                <input type="text" name="empEmail" value="<?php echo $array[1] ?>" />
                            </td>
                            <td>
                                <input type="text" name="empPosition" value="<?php echo $array[2] ?>" />
                            </td>
                            <td>
                                <input type="text" name="empSalary" value="<?php echo $array[3] ?>" />
                            </td>
                            <td>
                                <input type="text" name="empDep" value="<?php echo $array[4] ?>" />
                            </td>
                            <input type="hidden" name="table_name" value="Employee"/>
                            <input type="hidden" name="tableId" value="empId"/>
                            <input type="hidden" name="tableIdVal" value="<?php echo $array[5];?>"/>
                            <td>
                                <input type="submit" name="update" value="edit"> 
                            </td>
                        </form>
                    <?php        
                        }else{
                    ?>  
                    <td>
                        <p><?php echo $array[0] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[1] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[2] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[3] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[4] ?></p>
                    </td>
                    <td>
                            <a href="employee.php?id=<?php echo $array["empId"]; ?>">Edit</a>
                        </td>
                    <?php } ?>
                    <td>
                    <a href="delete.php?id=<?php echo $array["empId"]; ?>&tableName=Employee&nameId=empId">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <div class="modal_button_wrapper">
            <button id="modalBtn" >Add data</button>
        </div>
    </div>
    <?php include("footer.html") ?>

    <script>
        // Get the modal
        var modal = document.getElementById("modal_window");

        // Get the button that opens the modal
        var btn = document.getElementById("modalBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>