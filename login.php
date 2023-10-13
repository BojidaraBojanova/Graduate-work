<?php
session_start();
include "connection.php";

// Check if the login form is submitted
if(isset($_POST['submitLogin'])){

    // Clean and ensure the validity of login input
    $name = strip_tags($_POST['loginName']);
    $password = strip_tags($_POST['loginPassword']);
    
    // Validate the email format
    if($name){
        $name = filter_var($name, FILTER_VALIDATE_EMAIL);
    }

    // Check if email and password are provided
    if(!$name){
        echo '<script>alert("Имейл адресът е задължителнен!")</script>';
    }

    if(!$password){
        echo  '<script>alert("Паролата е задължителна!")</script>';
    }

    try{
        $conn = dbConnect(); // Establish a database connection using the function from "connection.php"
        
        // Retrieve user data based on provided email
        $sql = "SELECT * FROM tbl_client WHERE email= ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$name]);

        if($stm && $stm->rowCount() > 0){ 
            // User found, verify the provided password
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if(!password_verify($password, $row['password'])){
                echo '<script>alert("Паролата и имейла не съвпадат!")</script>';
            }else{
                $_SESSION["logged_in"] = true; 
                echo 'Успешно влизане в профила си';
                $_SESSION['email'] = $row['email'];
                $_SESSION['client_id'] = $row['id_client'];
                $_SESSION['abonnament'] = $row['abonnament'];
                header('Location: areaClient.php');

            }
            
        }else{
            // No user found or password doesn't match
            echo '<script>alert("Паролата и имейла не съвпадат!")</script>';
        }

    }catch(Exception $e){
        echo $e->getMessage(); // Display any exception/error messages that occurred
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
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/ff8ec696f9.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <div class="topnav" id="myTopnav">

        <div class="cont-logo">
            <img src="picture/logo1.png" alt="Logo">
        </div>

        <div class="menu-items">
            <a href="home.php">Home</a>
            <a href="#aboutUs">За нас</a>
            <a href="#abonament">Абонаменти</a>
            <a href="#contact">Контакти</a>

            <div class="cont-login">

                <a href='login.php'>Вход</a>

            </div>
        </div>

        <a href="javascript:void(0);" class="icon" style="color:black;" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>

    <div class="login">
        <h1>Вход</h1>

        <div class="cont-log">
            <form method="POST" action="" id="loginForm">

                <div class="cont-log-column">
                    <label for="">Имейл:</label>
                    <br>
                    <input type="text" placeholder="Имейл" name="loginName">
                </div>
                <div class="cont-log-column">
                    <label for="">Парола:</label>
                    <br>
                    <input type="password" placeholder="Парола" name="loginPassword">
                </div>

                <div class="cont-log-btn">
                    <input type="submit" value="Влез" name="submitLogin">
                </div>

            </form>
        </div>

    </div>
    <footer>
        <img src="picture/logo1.png" alt="">
        <div class="footer-row">
            <div class="social-cont">
                <div class="social-cont-title">
                    <h2>Контакти</h2>
                </div>
                <div class="social-icon">
                    <div class="icon-text">
                        <i class="material-icons" style="font-size:36px">call</i>
                        <p>0894021178</p>
                    </div>

                    <div class="icon-text">
                        <a href="#" class="fa fa-facebook"></a>
                        <p>Facebook</p>
                    </div>

                    <div class="icon-text">
                        <a href="#" class="fa fa-instagram"></a>
                        <p>Instagram</p>
                    </div>


                </div>

            </div>



            <div class="footer-questions">

                <div class="social-cont-title">
                    <h2>въпроси и проблеми</h2>
                </div>

                <div class="cont-footer-questions">
                    <a href="#">Политика за поверителност</a>
                    <a href="#">Политика за бисквитки</a>
                    <a href="#">въпроси и проблеми</a>
                </div>

                <div class="bobi">
                    <h3>Designed by <span style="color: orange;"> Bojidara Bojanova</span> </h3>
                </div>

            </div>
        </div>

    </footer>

</body>

</html>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>