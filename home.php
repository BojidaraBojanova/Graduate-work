<?php
session_start();
include "connection.php";

$conn = dbConnect();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["fullName"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $errors = [];

    if(empty($name)){
        
        $errors ="<script>alert('Моля, въведете вашето име')</script>";
        echo $errors;
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

       $errors = "<script>alert('Моля, въведете валиден адрес')</script>";
       echo $errors;

    }

    if(empty($message)){
        
        $errors = "<script>alert('Моля, въведете съобщение')</script>";

    }

    if(!empty($errors)){
        echo $errors;
    }else{
        $sql = 'INSERT INTO tbl_contact (name, email, message) VALUES (?,?,?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name,$email,$message]);

        if($stmt){
            echo '<script>alert("Успешно пратене съобщение!")</script>';
            echo '<script>window.location.replace("home.php")</script>';
        }else{
            echo '<script>alert("Грешка при изпращане на съобщение!")</script>';
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

    <div class="container">

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

            <a href="javascript:void(0);" class="icon" style="color:black;" onclick = "myFunction()">
                <i class="fa fa-bars"></i>
            </a>              

        </div>

        <div class="header">

            <div class="header-title">

                <div class="titles">
                    <h1 class="black-title">You</h1>
                    <h1 class="orn-title">Gym</h1>
                </div>

                <h2>Добре дошъл в твоята нова, домашна фитнес зала!</h2>
                <h3></h3>
            </div>

            <div class="buttons">
                <?php 
                    if (isset($_SESSION["logged_in"])){
                        echo "<button type='button' class='orn-btn' ><a  class='whiteColor' href='areaClient.php'>Моя план</a></button>";
                    }else{
                        echo "<button type='button' class='orn-btn' ><a  class='whiteColor' href='registration.php'>Регистрация</a></button>";
                    }


                ?>

                
                <button type="button" class="white-btn" ><a class="orangeColor" href="#contact">Контакти</a></button>
            </div>

        </div>

    </div>
    <!-- About us  -->
    <div class="aboutus-container" id="aboutUs">
        <h1 style="margin-top: 3rem;" >За нас:</h1>

        <div class="cont-zanas">

            <div class="text-container">
                <p>Добре дошли в нашия уебсайт за домашен фитнес! Ние сме екип от фитнес ентусиасти, които са запалени
                    да помагат на хората да постигнат своите фитнес цели от комфорта на домовете си. Ние разбираме, че
                    ходенето на фитнес може да отнеме много време и понякога плашещо, поради което създадохме този
                    уебсайт, за да ви предоставим всички ресурси, от които се нуждаете, за да създадете своя собствена
                    домашна фитнес зала.</p>
            </div>

            <div class="img-container">
                <div class="img">
                </div>

            </div>

        </div>
    </div>
        <h1 style="font-size: 3rem;text-align:center;">Какво предлагаме:</h1>
        <div class="services">

            <div class="services-box">

                <div class="serv-img"><img src="picture/diet.png" alt=""></div>

                <div class="serv-text">
                    <p>Ние предлагаме персонализирани диетични планове, разработени от нашия диетолог.
                        Нашият диетолог ще работи с вас, за да създадете диетичен план, който отговаря на вашия начин на
                        живот и ви помага да постигнете вашите фитнес цели.
                        Вярваме, че правилното хранене е от съществено значение за постигане на оптимално
                        здраве и фитнес.</p>
                </div>

            </div>

            <div class="services-box">

                <div class="serv-img"><img src="picture/exers.png" alt=""></div>

                <div class="serv-text">
                    <p>Нашите тренировъчни планове са проектирани от нашия опитен фитнес треньор,
                        който е разработил програми за хора с различни фитнес цели и нива на опит.
                        Независимо дали сте начинаещ или напреднал фитнес ентусиаст, ние имаме план за тренировка,
                        който ще ви помогне да постигнете целите си.</p>
                </div>

            </div>

            <div class="services-box">

                <div class="serv-img"><img src="picture/dietandexers.png" alt=""></div>

                <div class="serv-text">
                    <p>Изборът на план за фитнес, който включва както здравословна диета, така и тренировъчна
                        програма, е най-добрият начин да постигнете вашите фитнес цели и да подобрите цялостното
                        си здраве.</p>
                </div>

            </div>

        </div>


        <div class="cont-project" >
            <div class="title">
                <h1>Проект </h1>
                <h1 class="black-title" style="color: black; margin-left:1rem">You</h1>
                <h1 class="orn-title">Gym:</h1>
            </div>
            <div class="project-row">
                <div class="img-container-project">

                    <div class="img"></div>

                </div>
                <div class="text-container-project">
                    <p>Ние се ангажираме да ви помогнем да постигнете вашите фитнес цели и да водите здравословен
                        и активен начин на живот. Надяваме се, че нашият уебсайт ще бъде ценен ресурс за вас и
                        приветстваме всяка обратна връзка или предложения, които може да имате. Благодарим ви,
                        че избрахте нашия уебсайт за домашен фитнес като ваш основен ресурс за всичко свързано
                        с фитнес и хранене!</p>
                </div>
            </div>

        </div>

   

    <!-- Abonamenti  -->
    <div class="abonament" id="abonament">
        <h1>Искаш ли да си във форма и да се чувстваш добре?</h1>
        <h2>Присъединете се към нашата фитнес общност и постигнете своите фитнес цели в подкрепяща и мотивираща среда.
        </h2>

        <div class="cont-abonament">

            <div class="cont-abonament-box">
                <h1>Диета</h1>

                <div class="cont-abonament-box-img">
                    <img src="picture/cont-diet1.jpg">
                </div>

                <div class="cont-abonament-box-descr">
                    <p>Открийте силата на здравословното хранене и отключете
                        пълния си потенциал с нашата цялостна диета и
                        хранителни програми.</p>
                </div>

                <p>40лв/на месец</p>
                <!-- <input type="button" value="Избери" class="choose-btn"> -->
            </div>

            <div class="cont-abonament-box">

                <h1>Тренировка</h1>

                <div class="cont-abonament-box-img">
                    <img src="picture/cont-exers2.jpg">
                </div>

                <div class="cont-abonament-box-descr">
                    <p>Открийте радостта от упражненията и тръпката от постигането на вашите фитнес цели
                        с нашите забавни и увлекателни планове за упражнения.</p>
                </div>

                <p>40лв/на месец</p>
                <!-- <input type="button" value="Избери" class="choose-btn"> -->

            </div>

            <div class="cont-abonament-box">

                <h1>Диета&Тренировка</h1>

                <div class="cont-abonament-box-img">
                    <img src="picture/diets+exers1.jpg">
                </div>

                <div class="cont-abonament-box-descr">
                    <p>Присъединете се към нашата фитнес общност и преобразете тялото и здравето си с нашите планове за
                        упражнения и диета.</p>
                </div>

                <p>70лв/на месец</p>
                <!-- <input type="button" value="Избери" class="choose-btn"> -->

            </div>

        </div>

    </div>

    <!-- Contact  -->
    <div class="contact" id="contact">
        <h1>Контакти</h1>

        <div class="cont-contact">
            <p>Чувствай се свободен да се свържиш с нас!</p>
            <form action="" method="POST">

                <div class="cont-contact-row">
                    <input type="text" name="fullName" placeholder="Име/Фамилия">
                    <input type="text" name="email" placeholder="Имейл">
                </div>

                <div class="cont-contact-column">
                    <textarea name="message" id="message" cols="100" rows="10"></textarea>
                </div>

                <div class="cont-contact-btn">
                    <button type="submit" name="submit" class='orn-btn' style="font-size:2rem;border:1px solid orange;padding:1rem;border-radius:2rem;margin-bottom:1rem">Изпрати</button>
                    <!-- <input type="button" value="Изпрати"> -->
                </div>

            </form>
        </div>

    </div>

    <footer>
        <img src="picture/logo1.png" alt="">
        <div class="footer-row">
            <div class="social-cont">
                <div class="social-cont-title">
                    <h2>Контакти:</h2>
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
                        <h2>Въпроси и проблеми:</h2>
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
    function myFunction(){
        var x = document.getElementById("myTopnav");
        if(x.className === "topnav"){
            x.className += " responsive";
        }else{
            x.className = "topnav";
        }
    }
</script>