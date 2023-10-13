<?php
session_start();
include "../connection.php";
$conn = dbConnect();

// Initialize counters for different types of clients
$count = 0;
$countDiet = 0;
$countTraning = 0;
$countDietTraning = 0;

// Count total clients
$sql = "SELECT * FROM tbl_client";
$result = $conn->query($sql);
if($result->rowCount() > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $count++;
    }
}

// Count clients with subscription type diet
$sql1 = "SELECT * FROM tbl_client WHERE abonnament = 1";
$result1 = $conn->query($sql1);
if($result1->rowCount() > 0){
    while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
        $countDiet++;
    }
}

// Count clients with subscription type exersice
$sql2 = "SELECT * FROM tbl_client WHERE abonnament = 2";
$result2 = $conn->query($sql2);
if($result2->rowCount() > 0){
    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
        $countTraning++;
    }
}

// Count clients with subscription type diet and exersice
$sql3 = "SELECT * FROM tbl_client WHERE abonnament = 3";
$result3 = $conn->query($sql3);
if($result3->rowCount() > 0){
    while($row3 = $result3->fetch(PDO::FETCH_ASSOC)){
        $countDietTraning++;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminCss/dashStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
        <div class="nav-bar" id="myNav">
            

            <div class="menu-items">
                <a href="#nachalo">Начало</a>
                <a href="#clients">Клиенти</a>
                <a href="#abonaments">Абонаменти</a>
                <a href="#diets">Диети</a>
                <a href="#exersice">Тренировки</a>
                <a href="#message">Съобщения</a>

                <div class="cont-login">
                    <?php 
                        if (isset($_SESSION["logged_in"])){
                            echo "<a href='couchLogout.php'>Излез</a>";
                        }else{
                            echo "<a href='login.php'>Вход</a>";
                        }
                    ?>
                </div>
            </div>

            <a href="javascript:void(0);" class="icon" onclick = "myFunction()">
                <i class="fa fa-bars"></i>
            </a>              

        </div>
    
    <div class="header-contHome" id="nachalo">
        <div class="title">
        <h1 style="text-align:center;">Административно табло на <?php echo $_SESSION['name'] ;echo " " ;echo $_SESSION['lastName'];?></h1>
        </div>
        <div class="progress">
 
            <div class="countClients">
                <h2><?php echo $count; ?></h2>
                <h3>Клиента</h3>
            </div>
            <div class="countClientsDiets">
                <h2><?php echo $countDiet ?></h2>
                <h3>Клиента са избрали „Диета“</h3>
            </div>
            <div class="countClientsTraining">
                <h2><?php echo $countTraning ?></h2>
                <h3>Клиента са избрали „Тренировка“</h3>
            </div>
            <div class="countClientsDietsTraining" >
                <h2><?php echo $countDietTraning ?></h2>
                <h3>Клиента са избрали „Диета и Тренировка“</h3>
            </div>
        </div>
    </div>

    <!-- Client Management-->
    <div class="client" id="clients">
        <!-- Form for managing client information -->
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Клиенти</h2>
            <div class="table">
                <!-- Table for displaying client details -->
                <table>
                    <thead>
                        <!-- Table header with column labels -->
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Име</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Имейл</th>
                            <th scope="col">Рожденна дата</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Пол</th>
                            <th scope="col">Височина</th>
                            <th scope="col">Килограми</th>
                            <th scope="col">Абонамент</th>
                            <th scope="col">Добавяне на диета/тренировка</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Query to retrieve client information and associated subscription
                            $sql = "SELECT * FROM tbl_client INNER JOIN tbl_abonnement ON abonnament = id_abonnement ORDER BY `tbl_client`.`id_client` ASC";
                            $result = $conn->query($sql);

                            // Check if there are clients to display
                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    // Display client details in table cells
                                    echo "<th>";
                                    echo $row['id_client'];
                                    echo "</th>";
                                    echo"<th>";
                                    echo $row["client_name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["client_lastName"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["email"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["birth_date"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["client_address"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["gender"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["height"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["weight"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["name"];
                                    echo"</th>";
                                    ?>
                                    <!-- Add buttons for adding diet/training and deleting client -->
                                    <th><a href="add_diet_training.php?id=<?php echo $row["id_client"];?>" class='add-btn' style="padding:0.4rem; text-decoration:none; font-size:1rem;" >Добавяне</a></th>
                                    <th><a href="delete_client.php?id=<?php echo $row["id_client"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";
                                    

                                }
                            }else{
                                // Display a message if there are no clients
                                echo"Няма клиенти";
                            }
                        ?>
                                
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <!--------------------------------------------------- PAYMENTS ------------------------------------------>
    <div class="client" id="clients">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Плащания</h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Име</th>
                            <th scope="col">Имейл</th>
                            <th scope="col">Абонамент</th>
                            <th scope="col">Номер на абонамента</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Платена сума</th>
                            <th scope="col">Номер на транзакцията</th>
                            <th scope="col">Статус на плащането</th>
                            <th scope="col">Дата на плащането</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM payments ";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo "<th>";
                                    echo $row['id_customer'];
                                    echo "</th>";
                                    echo"<th>";
                                    echo $row["customer_name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["customer_email"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["item_name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["item_number"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["item_price"].$row["item_price_currency"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["paid_amount"].$row["paid_amount_currency"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["txn_id"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["payment_status"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["date"];
                                    echo"</th>";

                                    ?>
                                    <th><a href="delete_payments.php?id=<?php echo $row["id_customer"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";
                                    

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                                
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!------------------------------------------------------- END-PAYMENTS -->

    <div class="client-diet-training" >
        <form action="" method="post" name="client_form" class="client_form" >
            <h2 style="text-align:center">Диети и Тренировки на всеки клиент</h2>
            <div class="table">
                <table >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Понеделник</th>
                            <th scope="col">Вторник</th>
                            <th scope="col">Сряда</th>
                            <th scope="col">Четвъртък</th>
                            <th scope="col">Петък</th>
                            <th scope="col">Събота</th>
                            <th scope="col">Неделя</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM tbl_client_inventar";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["id_client"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["monday_training"];
                                    echo"</br>";
                                    echo $row["monday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["tuesday_training"];
                                    echo"</br>";
                                    echo $row["tuesday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["wednesday_training"];
                                    echo"</br>";
                                    echo $row["wednesday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["thursday_training"];
                                    echo"</br>";
                                    echo $row["thursday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["friday_training"];
                                    echo"</br>";
                                    echo $row["friday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["saturday_training"];
                                    echo"</br>";
                                    echo $row["saturday_dieta"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo "Почивен ден";
                                    echo"</th>";
      
                                    ?>
                                    <th><a href="delete_clientDT.php?id=<?php echo $row["id_client"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";
                                    

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                                
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <div class="abonament" id="abonaments">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Абонаменти <a href="add_abonament.php" style="color:green;text-decoration:none;">+</a></h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Редактиране</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_abonnement";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["id_abonnement"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["price"];
                                    echo"</th>";
                                    ?>
                                    <th><a href="edit_abonament.php?id=<?php echo $row["id_abonnement"];?>" class='edit-btn' style="padding:0.4rem; text-decoration:none; font-size:1rem;" >Редактиране</a></th>
                                    <th><a href="delete_abonament.php?id=<?php echo $row["id_abonnement"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </form>
    </div>
    <div class="diets" id="diets">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Диети <a href="add_diet.php" style="color:green;text-decoration:none;">+</a></h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ниво на трудност</th>
                            <th scope="col">Име</th>
                            <th scope="col">Закуска</th>
                            <th scope="col">Обяд</th>
                            <th scope="col">Вечеря</th>
                            <th scope="col">Редактиране</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_inventar_dieti";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["nivo"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["zakuska"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["obqd"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["vecheriq"];
                                    echo"</th>";

                                    ?>
                                    <th><a href="edit_diet.php?id=<?php echo $row["id"];?>" class='edit-btn' style="padding:0.4rem; text-decoration:none; font-size:1rem;" >Редактиране</a></th>
                                    <th><a href="delete_diet.php?id=<?php echo $row["id"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th>  
                                    <?php
                                    echo "</tr>";

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </from>
    </div>
    <div class="exersice" id="exersice">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Тренировки <a href="add_training.php" style="color:green;text-decoration:none;">+</a></h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ниво на трудност</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Редактиране</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_inventar_training";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["nivo"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["description"];
                                    echo"</th>";

                                    ?>
                                    <th><a href="edit_training.php?id=<?php echo $row["id"];?>" class='edit-btn' style="padding:0.4rem; text-decoration:none; font-size:1rem;" >Редактиране</a></th>
                                    <th><a href="delete_training.php?id=<?php echo $row["id"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </from>
    </div>

    <div class="message" id="message">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Съобщения</h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Име</th>
                            <th scope="col">Имейл</th>
                            <th scope="col">Съобщение</th>
                            <th scope="col">Изтриване</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_contact";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["email"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["message"];
                                    echo"</th>";
                                    ?>
                                        <th><a href="delete_message.php?id=<?php echo $row["id_contact"];?>" class='delete-btn'style="padding:0.4rem; text-decoration:none; font-size:1rem;"">Изтриване</a></th>  
                                    <?php
                                    echo "</tr>";

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </from>
    </div>
</body>
</html>
<script>
    
    function myFunction(){
        var x = document.getElementById("myNav");
        if(x.className === "nav-bar"){
            x.className += " responsive";
        }else{
            x.className = "nav-bar";
        }
    }

    function DeleteConfirm() {
      confirm("Are you sure to delete the record");
     }
 </script>