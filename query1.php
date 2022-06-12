<?php

include("db.php");
$SQLquery="SELECT S.servName, E.empName, E.empSalary,  S.servPrice, E.empEmail
FROM Employee E
JOIN ServEmp SE ON E.empId = SE.empId
JOIN Services S ON S.servId = SE.servId";
$exeSQLquery=mysqli_query($conn, $SQLquery) or die (mysqli_error($conn));
$list = array();
while($array=mysqli_fetch_array($exeSQLquery)){
    array_push($list, $array);
}
$newlist = $list;
$search_names = array("E.empName", "E.empEmail", "S.servName", "S.servPrice", "E.empEmail");
$search_label = array("Номер кімнати", "Назва номеру", "Опис номеру", "Корпус готелю", "Ціна кімнати", "Доступність");

$val_list = array(array(), array(), array(), array(), array(), array(), array());

for($i = 0; $i < sizeof($list); $i++){
    
    for($j = 0; $j < count(array_count_values($list[0])); $j++){
        array_push($val_list[$j], $list[$i][$j]);
    }

}

for($j = 0; $j < 6; $j++){
    $val_list[$j] = array_values(array_unique($val_list[$j]));
}

if(array_key_exists("id", $_GET)){
    $id = $_GET["id"];
}else{
    $id = "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newlist = array();
    $formvals = $_POST["servName"];
    
    
    for($k = 0; $k < count($list); $k++){//rows
        $val = $list[$k][0];
        $skip = 0;

        if(strcmp($formvals."", $val."") === 0){
            $skip = 0;
        }else{
            $skip = 1;
        }

        
        if($skip == 0){
            array_push($newlist, $list[$k]);
        }
    }
    
}


?>
<html>
    
    <header>
        <link rel=stylesheet type=text/css href=styles.css>
    </header>

    <body>
        <?php include ("header.html") ?>
        <div id="main">
        <h2>Готель</h2>

        <div>
            <form method="post">
            
                <select name="servName" id="">
                <option value=""></option>
            <?php 
            for ($i = 0; $i < count($list); $i++){
                ?>
                <option value="<?php echo $list[$i][0];?>"><?php echo $list[$i][0];?></option>
        
        
            <?php } ?>
            </select>
                <button type="submit">search</button>
            </form>

        </div>

        <div class="modal_window" id="modal_window">
            <div class="modal_content" >
            <span class="close">&times;</span>
                <form method="post" action="addData.php">
            <?php
                for ($j = 0; $j < 6; $j++) {
                ?>
                    <p class="label" ><?php echo $search_label[$j]; ?>:</p>
                    <input type="text" name="<?php echo $search_names[$j]; ?>">
                <br>
                <?php } ?>
                    <input type="hidden" name="table_name" value="Hotel" />
                    <input class="sub_btn" type="submit" name="save" value="submit">      
                </form>     
            </div>
        </div>

        <table style='border: 0px'>

            <tr>
            <td>Назва послуги</td>
            <td>Ціна послуги</td>
            <td>Зп</td>
            <td>ПІБ працівника</td>
            <td>Посада</td>
            <!-- <td></td> -->
            </tr>

            <?php for($i = 0; $i<count($newlist); $i++)
            { 
                $array = $newlist[$i];

            ?>
                <tr>
                    <td>
                        <p><?php echo $array[0] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[3] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[2] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[1] ?></p>
                    </td>
                    <td>
                        <p><?php echo $array[4] ?></p>
                    </td>
                    <!-- <td>
                    <a href="hotel.php?id=<?php echo $array["hotelId"]; ?>">Edit</a>
                        </td>
                    <td>
                    <a href="delete.php?id=<?php echo $array["hotelId"]; ?>&tableName=Hotel&nameId=hotelId">Delete</a>
                    </td> -->
                </tr>
            <?php } ?>

        </table>
      
        </div>
        <?php include ("footer.html") ?>
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