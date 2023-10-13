<?php
session_start();
include "../connection.php";
$conn = dbConnect();

$id_client = $_GET['id']; 
$sql = "SELECT * FROM tbl_client INNER JOIN tbl_abonnement ON abonnament = id_abonnement WHERE id_client = '$id_client'"; 
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

$_SESSION['id_client'] = $id_client;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminCss/dashStyle.css">
</head>
<body>
    <?php
        if($row["abonnament"] === 1){
    ?>
    <div class="header-cont responCont">
        <div class="title">
            <h1>Добавяне на диета за седмицата за <?php echo $row["client_name"] ?></h1>
        </div>
    </div>
    <form action="setting_day_controller.php" method="post" name="client_form" class="client_form" >
            <div class="table responTable">
                
                <table>
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $row["client_name"] ?></th>
                            <th scope="col">Понеделник</th>
                            <th scope="col">Вторник</th>
                            <th scope="col">Сряда</th>
                            <th scope="col">Четвъртък</th>
                            <th scope="col">Петък</th>
                            <th scope="col">Събота</th>
                            <th scope="col">Неделя</th>
                        </tr>
                    </thead>
                    <tbody>
  
                        <tr>
                            <th>
                            <?=ucwords($row['name'])?>
                            

                            </th>
                           
                            <th>
                                
                                <select name="monday_dieta" id="monday_dieta">
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                        $result2 = $conn->query($sql2);  

                                        $sql3 = 'SELECT id_client FROM tbl_client_inventar WHERE id_client=?';
                                        $stmt3 = $conn->prepare($sql3);
                                        $stmt3->execute([$_SESSION['id_client']]);
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='monday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>

                                    <?php
                                        echo $row['id'];
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="tuesday_dieta" id="tuesday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='tuesday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="wednesday_dieta" id="wednesday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='wednesday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="thursday_dieta" id="thursday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='thursday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="friday_dieta" id="friday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='friday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="saturday_dieta" id="saturday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='saturday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>Почивен ден</th>
                        </tr>
                        
                        <tr>
                            <th colspan="8"><button type="submit" name="submitD" class='add-btn'>Добавяне</button></th>
                        </tr>
                    </tbody>
                </table>
            </div>
    </form>
           
           
    <?php
        }
        else if($row["abonnament"]===2){
    ?>
    <div class="header-cont" style="display: flex;align-items:center;">
        <div class="title">
            <h1>Добавяне на тренировки за седмицата за <?php echo $row["client_name"] ?></h1>
        </div>
    </div>
    <form action="setting_day_controller.php" method="post" name="client_form" class="client_form" >
            <div class="table">
                
                <table>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Понеделник</th>
                            <th scope="col">Вторник</th>
                            <th scope="col">Сряда</th>
                            <th scope="col">Четвъртък</th>
                            <th scope="col">Петък</th>
                            <th scope="col">Събота</th>
                            <th scope="col">Неделя</th>
                        </tr>
                    </thead>
                    <tbody>
  
                        <tr>
                            <th>
                            Ниво на трудност
                            </th>
                           
                            <th>
                                
                                <select name="monday_training" id="monday_training">
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_inventar_training";
                                        $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='monday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="tuesday_training" id="tuesday_training">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_training";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='tuesday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="wednesday_training" id="wednesday_training">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_training";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='wednesday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="thursday_training" id="thursday_training">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_training";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='thursday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="friday_training" id="friday_training">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_training";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='friday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="saturday_training" id="saturday_training">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_training";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='saturday_training' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['nivo'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>Почивен ден</th>
                        </tr>
                        
                        <tr>
                            <th colspan="8"><button type="submit" name="submitT" class='add-btn'>Добавяне</button></th>
                        </tr>
                    </tbody>
                </table>
            </div>
    </form>
           

    <?php
        }else if($row["abonnament"]===3){
            ?>
            <div class="header-cont" style="display: flex;align-items:center;">
                <div class="title" style="width:90%;text-align:center;">
                    <h1>Добавяне на тренировки и диети за седмицата за <?php echo $row["client_name"] ?></h1>
                </div>
            </div>
            <form action="setting_day_controller.php" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">

                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Понеделник</th>
                                    <th scope="col">Вторник</th>
                                    <th scope="col">Сряда</th>
                                    <th scope="col">Четвъртък</th>
                                    <th scope="col">Петък</th>
                                    <th scope="col">Събота</th>
                                    <th scope="col">Неделя</th>
                                </tr>
                            </thead>
                            <tbody>
          
                                <tr>
                                    <th>
                                        Тренировка
                                    </th>
                                   
                                    <th>
                                        
                                        <select name="monday_training" id="monday_training">
                                            <?php
                                                $sql2 = "SELECT * FROM tbl_inventar_training";
                                                $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='monday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        
                                        <select name="tuesday_training" id="tuesday_training">
                                            <?php
                                            $sql2 = "SELECT * FROM tbl_inventar_training";
                                            $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='tuesday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        
                                        <select name="wednesday_training" id="wednesday_training">
                                            <?php
                                            $sql2 = "SELECT * FROM tbl_inventar_training";
                                            $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='wednesday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        
                                        <select name="thursday_training" id="thursday_training">
                                            <?php
                                            $sql2 = "SELECT * FROM tbl_inventar_training";
                                            $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='thursday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        
                                        <select name="friday_training" id="friday_training">
                                            <?php
                                            $sql2 = "SELECT * FROM tbl_inventar_training";
                                            $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='friday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        
                                        <select name="saturday_training" id="saturday_training">
                                            <?php
                                            $sql2 = "SELECT * FROM tbl_inventar_training";
                                            $result2 = $conn->query($sql2);  
                                                if($result2->rowCount() > 0){
                                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <option name='saturday_training' value='<?=$row2['id']?>'>
                                                    <?php
                                                        echo $row2['nivo'];
                                                    ?>
                                                </option>
                                            <?php
                                                }}
                                            ?>
                                        </select>
                                    </th>
                                    <th>Почивен ден</th>
                                
  
                        <tr>
                            <th>
                                Диета
                            </th>
                           
                            <th>
                                
                                <select name="monday_dieta" id="monday_dieta">
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                        $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='monday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="tuesday_dieta" id="tuesday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='tuesday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="wednesday_dieta" id="wednesday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='wednesday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="thursday_dieta" id="thursday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='thursday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="friday_dieta" id="friday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='friday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>
                                
                                <select name="saturday_dieta" id="saturday_dieta">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_inventar_dieti";
                                    $result2 = $conn->query($sql2);  
                                        if($result2->rowCount() > 0){
                                        while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option name='saturday_dieta' value='<?=$row2['id']?>'>
                                            <?php
                                                echo $row2['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </th>
                            <th>Почивен ден</th>
                        </tr>
        
                        <tr>
                            <th colspan="8"><button type="submit" name="submitTD" class='add-btn'>Добавяне</button></th>
                        </tr>
                    </tbody>
                </table>
            </div>
    </form>
                   
        
            <?php
        }
    ?>

    </body>
</html>
