<?php
session_start(); // Start a new session or resume the existing one
include "connection.php"; // Include the file that handles the database connection
$conn = dbConnect(); // Establish a database connection using the function from "connection.php"

if(isset($_POST['submit']))
{ 
    // Extract data from POST request
    $name = strip_tags($_POST['name']);
    $lastName = strip_tags($_POST['lastName']);
    $date = strip_tags($_POST['date']);
    $address = strip_tags($_POST['address']);
    $gender = strip_tags($_POST['gender']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $height = strip_tags($_POST['height']);
    $weight = strip_tags($_POST['weight']);
    $abonnament = strip_tags($_POST['abonnament']);

    // Check password complexity requirements
    $uppercase = preg_match('@[A-Z]@',$password);
    $lowercase = preg_match('@[a-z]@',$password);
    $number = preg_match('@[0-9]@',$password);
    $specialChars = preg_match('@[^\w]@',$password);

    // Check if any required fields are empty
    if(empty($_POST['name'])||empty($_POST['lastName'])||empty($_POST['date'])||empty($_POST['address'])||
    empty($_POST['gender'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['height'])||empty($_POST['weight'])||empty($_POST['abonnament']))
    {
        echo"<script>alert('Моля попълнете всички полета')</script>";
    }else if(strlen($password)<4 || !$uppercase || !$lowercase || !$number || !$specialChars){
        echo"<script>alert('Паролата трябва да е най-малко с 8 символа и трябва да съдържа поне една главна буква, една цифра и един специален символ')</script>";

    }else{
    
        try {
        // Check if a user with the given email already exists in the database
        $sql2 = 'SELECT * FROM tbl_client WHERE email=?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$email]);

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        if($stmt2->rowCount() > 0){
            echo '<script>alert("Съществува потребител с този имейл")</script>';
        }else{
            // Insert new user data into the database
            $sql = 'INSERT INTO tbl_client (client_name, client_lastName, birth_date, client_address, gender, email, password, height, weight, abonnament) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password before storing it in the database
            $stmt->execute([$name, $lastName, $date, $address, $gender, $email, $password, $height, $weight, $abonnament]);


            if($stmt){
                // Retrieve the newly created user's ID
                $sql3 = 'SELECT id_client FROM tbl_client WHERE email = ?';
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute([$email]);

                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                
                // Store user information in the session
                $_SESSION["logged_in"] = true; 
                $_SESSION['email'] = $email;
                $_SESSION['client_id'] = $row3['id_client'];
                $_SESSION['abonnament'] = $abonnament; 
                

                echo '<script>alert("Създаден е нов акаунт.")</script>';
                echo '<script>window.location.replace("pay.php")</script>';
                
            }else{
                echo '<script>alert("Грешка!")</script>';
            }
        }


        }catch(Exception $e){
        
            echo $e->getMessage();

        }
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
                <?php 
                    if (isset($_SESSION["logged_in"])){
                        echo "<a href='logout.php'>Излез</a>";
                    }else{
                        echo "<a href='login.php'>Вход</a>";
                    }
                ?>
            </div>
        </div>

        <a href="javascript:void(0);" class="icon" style="color:black;" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>

    <div class="registration">
        <h1>Регистрация</h1>

        <div class="cont-reg">

            <div class="cont-registration">

                <div class="first_column-reg">

                    <form method="POST" action="" id="signupForm">

                        <div class="label_input">
                            <label for="">Име</label>
                            <br>
                            <input type="text" name="name" placeholder="Име">
                        </div>

                        <div class="label_input">
                            <br>
                            <label for="">Фамилия</label>
                            <br>
                            <input type="text" name="lastName" placeholder="Фамилия">
                        </div>

                        <div class="label_input">
                            <br>
                            <label for="">Имейл</label>
                            <br>
                            <input type="text" name="email">

                        </div>

                        <div class="label_input">
                            <br>
                            <label for="">Парола</label>
                            <br>
                            <input type="password" name="password">
                            <br>
                        </div>

                        <div class="label_input">
                            <label for="">Дата на раждане</label>
                            <br>
                            <input type="date" name="date">
                            <br>
                        </div>

                </div>
                <div class="second-column-reg">

                    <div class="label_input">
                        <label for="">Адрес</label>
                        <br>
                        <input type="text" name="address"
                            placeholder="обл.Варна, гр.Варна, кв.„....“, ул.„.....“, бл. , н.">
                        <br>
                    </div>


                    <div class="label_input_row">
                        <label for="">Пол</label>
                        <br>
                        <select name="gender" id="">
                            <option value="female">жена</option>
                            <option value="male">мъж</option>
                        </select>

                    </div>
                    <div class="label_input">
                        <label for="">Ръст в сантиметри</label>
                        <br>
                        <input type="number" name="height" min="50" max="260">
                        <br>
                    </div>
                    <div class="label_input">
                        <label for="">Килограми</label>
                        <br>
                        <input type="number" name="weight" min="40" max="500">
                        <br>
                    </div>
                    <div class="label_input">
                        <br>
                        <label for="abonnament">Абонамент</label>
                        <br>
                        <select name="abonnament" id="abonnement">
                            <option value="1">пакет Диета</option>
                            <option value="2">Пакет Тренировка</option>
                            <option value="3">Пакет Диета и тренировка</option>
                        </select>
                    </div>

                </div>


            </div>
            <div class="reg-btn">
                <button type="submit" id="SignUpBtn" name="submit">Създай нов профил</button>
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