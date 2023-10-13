<?php
session_start();
include "../connection.php";

if(isset($_POST['submitLog'])){

    try {

        $conn = dbConnect();
        if(empty($_POST["name"]) || empty($_POST["password"]))  
           {  
                echo '<script>alert("Всички полета са задължителни!")</script>';  
           }else{
            $query = "SELECT * FROM tbl_admin WHERE name = :name AND password = :password";
            $stm = $conn->prepare($query);
            $stm->execute(
                array(
                    'name' => $_POST['name'],
                    'password' => $_POST['password']
                )
                );
                $count = $stm->rowCount();
                if($count > 0){
                    $_SESSION["adminName"] = $_POST["name"];
                    header("location:areaAdmin.php");
                }else{
                    echo '<script>alert("Потребителското име и паролата не съвпадат!")</script>';    
                }
           }  
    }catch(PDOException $error){
        $message = $error->getMessage();
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="adminCss/dashStyle.css">
    <script src="https://kit.fontawesome.com/ff8ec696f9.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="admin-body">
        <div class="cont-log">
            <form method="POST" action="" id="loginForm">
                <h1>Админ</h1>
                <div class="cont-log-column">
                    <label for="">Потребителско име:</label>
                    <br>
                    <input type="text" placeholder="Потребителско име" name="name">
                </div>
                <div class="cont-log-column">
                    <label for="">Парола:</label>
                    <br>
                    <input type="password" placeholder="Парола" name="password">
                </div>

                <div class="cont-log-btn">
                    <button type="submit" name="submitLog" >Вход</button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>