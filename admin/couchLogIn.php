<?php
session_start();
include "../connection.php";

if(isset($_POST['submit'])){

    $email = strip_tags($_POST['loginEmail']);
    $password = strip_tags($_POST['loginPassword']);

    if($email){
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if(!$email){
        echo '<script>alert("Имейл адресът е задължителнен!")</script>';
    }

    if(!$password){
        echo  '<script>alert("Паролата е задължителна!")</script>';
    }

    try{
        $conn = dbConnect();
        $sql = "SELECT * FROM tbl_coach WHERE email= ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);

        if($stm && $stm->rowCount() > 0){ 
            
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])){
                echo '<script>alert("Паролата и имейла не съвпадат!")</script>';
            }else{
                $_SESSION["logged_in"] = true; 
                $_SESSION['email'] = $row['email'];
                $_SESSION['id_coach'] = $row['id_coach'];
                $_SESSION['name'] = $row['coach_name'];
                $_SESSION['lastName'] = $row['coach_lastName'];

                echo 'Успешно влизане в профила си';
                header('Location:couch.php');

            }
            
        }else{
            echo '<script>alert("Паролата и имейла не съвпадат!")</script>';
        }


    }catch(Exception $e){
        echo $e->getMessage();
    }

    /* try {

        $conn = dbConnect();
        if(empty($_POST["name"]) || empty($_POST["lastName"]) || empty($_POST["email"]) || empty($_POST["password"]))  
           {  
                echo '<script>alert("Всички полета са задължителни!")</script>';  
           }else{
            $query = "SELECT * FROM tbl_coach WHERE coach_name = :name AND coach_lastName = :lastName AND email = :email AND password = :password";
            $stm = $conn->prepare($query);
            $stm->execute(
                array(
                    'name' => $_POST["name"],
                    'lastName' => $_POST["lastName"],
                    'email' => $_POST["email"],
                    'password' => $_POST['password']
                )
                );
                $count = $stm->rowCount();
                if($count > 0){
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["lastName"] = $_POST["lastName"];
                    header("location:couch.php");
                }else{
                    echo '<script>alert("Потребителското име и паролата не съвпадат!")</script>';    
                }
           }  
    }catch(PDOException $error){
        $message = $error->getMessage();
    } */
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
        <div class="cont-log" >
            <form method="POST" action="" id="loginForm">
                <h1>Треньор</h1>
                
                <div class="cont-log-column">
                    <label for="">Имейл:</label>
                    <br>
                    <input type="text" placeholder="Имейл" name="loginEmail">
                </div>
                <div class="cont-log-column">
                    <label for="">Парола:</label>
                    <br>
                    <input type="password" placeholder="Парола" name="loginPassword">
                </div>

                <div class="cont-log-btn">
                    <button type="submit" name="submit" >Вход</button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>