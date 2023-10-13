<?php
session_start();
include "connection.php";

// Retrieve client information from the session
$email = $_SESSION['email'];
$id_client = $_SESSION['client_id'];
$abonnament = $_SESSION['abonnament'];

try {
    $conn = dbConnect();

    // Retrieve client's name information from the database
    $sql1 = "SELECT * FROM tbl_client WHERE email = ?";
    $stm = $conn->prepare($sql1);
    $stm->execute([$email]);
    if ($stm && $stm->rowCount() > 0) {
        $rowC = $stm->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nameClient'] = $rowC['client_name'];
    }

    // Retrieve information about client's inventory (diets and workouts) from the database
    $sql = "SELECT * FROM tbl_client_inventar WHERE id_client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_client]);

    // Check if there is inventory information available for the client
    if ($stmt && $stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retrieve and store information about diets and workouts for each day
        $monday_dieta_id = $row['monday_dieta'];
        $tuesday_dieta_id = $row['tuesday_dieta'];
        $wednesday_dieta_id = $row['wednesday_dieta'];
        $thursday_dieta_id = $row['thursday_dieta'];
        $friday_dieta_id = $row['friday_dieta'];
        $saturday_dieta_id = $row['saturday_dieta'];

        $monday_training_id = $row['monday_training'];
        $tuesday_training_id = $row['tuesday_training'];
        $wednesday_training_id = $row['wednesday_training'];
        $thursday_training_id = $row['thursday_training'];
        $friday_training_id = $row['friday_training'];
        $saturday_training_id = $row['saturday_training'];




        ////////////////////////////////////////DIETS//////////////////////////////////////////////////////////


        if ($abonnament == 1) {

            //MONDAY 

            $stmt1 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt1->execute([$monday_dieta_id]);


            if ($stmt1 && $stmt1->rowCount() > 0) {
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $monday_zakuska = $row1['zakuska'];
                $monday_obqd = $row1['obqd'];
                $monday_vecheriq = $row1['vecheriq'];
                $monday_name = $row1['name'];
            } 

            //TUESDAY
            $stmt2 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt2->execute([$tuesday_dieta_id]);


            if ($stmt2 && $stmt2->rowCount() > 0) {
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                $tuesday_zakuska = $row2['zakuska'];
                $tuesday_obqd = $row2['obqd'];
                $tuesday_vecheriq = $row2['vecheriq'];
                $tuesday_name = $row2['name'];
            }

            //WEDNESDAY

            $stmt3 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt3->execute([$wednesday_dieta_id]);

            if ($stmt3 && $stmt3->rowCount() > 0) {
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                $wednesday_zakuska = $row3['zakuska'];
                $wednesday_obqd = $row3['obqd'];
                $wednesday_vecheriq = $row3['vecheriq'];
                $wednesday_name = $row3['name'];
            } 

            //THURSDAY

            $stmt4 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt4->execute([$thursday_dieta_id]);

            if ($stmt4 && $stmt4->rowCount() > 0) {
                $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

                $thursday_zakuska = $row4['zakuska'];
                $thursday_obqd = $row4['obqd'];
                $thursday_vecheriq = $row4['vecheriq'];
                $thursday_name = $row4['name'];
            } 

            //FRIDAY

            $stmt5 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt5->execute([$friday_dieta_id]);

            if ($stmt5 && $stmt5->rowCount() > 0) {
                $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);

                $friday_zakuska = $row5['zakuska'];
                $friday_obqd = $row5['obqd'];
                $friday_vecheriq = $row5['vecheriq'];
                $friday_name = $row5['name'];
            }

            //SATURDAY

            $stmt6 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt6->execute([$saturday_dieta_id]);

            if ($stmt6 && $stmt6->rowCount() > 0) {
                $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);

                $saturday_zakuska = $row6['zakuska'];
                $saturday_obqd = $row6['obqd'];
                $saturday_vecheriq = $row6['vecheriq'];
                $saturday_name = $row6['name'];
            } 
        }

        ////////////////////////////////////////TRAINING//////////////////////////////////////////////////////////


        if ($abonnament == 2) {

            //MONDAY 

            $stmt1 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt1->execute([$monday_training_id]);

            if ($stmt1 && $stmt1->rowCount() > 0) {
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $monday_description = $row1['description'];
                $monday_nivo = $row1['nivo'];
            }

            //TUESDAY
            $stmt2 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt2->execute([$tuesday_training_id]);

            if ($stmt2 && $stmt2->rowCount() > 0) {
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                $tuesday_description = $row2['description'];
                $tuesday_nivo = $row2['nivo'];
            }

            //WEDNESDAY

            $stmt3 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt3->execute([$wednesday_training_id]);

            if ($stmt3 && $stmt3->rowCount() > 0) {
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                $wednesday_description = $row3['description'];
                $wednesday_nivo = $row3['nivo'];
            }

            //THURSDAY

            $stmt4 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt4->execute([$thursday_training_id]);

            if ($stmt4 && $stmt4->rowCount() > 0) {
                $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

                $thursday_description = $row4['description'];
                $thursday_nivo = $row4['nivo'];
            }

            //FRIDAY

            $stmt5 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt5->execute([$friday_training_id]);

            if ($stmt5 && $stmt5->rowCount() > 0) {
                $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);

                $friday_description = $row5['description'];
                $friday_nivo = $row5['nivo'];
            }

            //SATURDAY

            $stmt6 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt6->execute([$saturday_training_id]);

            if ($stmt6 && $stmt6->rowCount() > 0) {
                $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);

                $saturday_description = $row6['description'];
                $saturday_nivo = $row6['nivo'];
            }
        }
        ////////////////////////////////////////TRAINING AND DIETS//////////////////////////////////////////////////////////
        if ($abonnament == 3) {

            //MONDAY 

            $stmt1 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt1->execute([$monday_training_id]);

            if ($stmt1 && $stmt1->rowCount() > 0) {
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $monday_description = $row1['description'];
                $monday_nivo = $row1['nivo'];
            }

            //TUESDAY
            $stmt2 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt2->execute([$tuesday_training_id]);

            if ($stmt2 && $stmt2->rowCount() > 0) {
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                $tuesday_description = $row2['description'];
                $tuesday_nivo = $row2['nivo'];
            }

            //WEDNESDAY

            $stmt3 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt3->execute([$wednesday_training_id]);

            if ($stmt3 && $stmt3->rowCount() > 0) {
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                $wednesday_description = $row3['description'];
                $wednesday_nivo = $row3['nivo'];
            }

            //THURSDAY

            $stmt4 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt4->execute([$thursday_training_id]);

            if ($stmt4 && $stmt4->rowCount() > 0) {
                $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

                $thursday_description = $row4['description'];
                $thursday_nivo = $row4['nivo'];
            }

            //FRIDAY

            $stmt5 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt5->execute([$friday_training_id]);

            if ($stmt5 && $stmt5->rowCount() > 0) {
                $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);

                $friday_description = $row5['description'];
                $friday_nivo = $row5['nivo'];
            }

            //SATURDAY

            $stmt6 = $conn->prepare("SELECT * FROM tbl_inventar_training WHERE id = ?");
            $stmt6->execute([$saturday_training_id]);

            if ($stmt6 && $stmt6->rowCount() > 0) {
                $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);

                $saturday_description = $row6['description'];
                $saturday_nivo = $row6['nivo'];
            }
            //////////////////////////////////////////DIETS//////////////////////////////////////////////////////////////////////////

            //MONDAY 

            $stmt1 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt1->execute([$monday_dieta_id]);

            if ($stmt1 && $stmt1->rowCount() > 0) {
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $monday_zakuska = $row1['zakuska'];
                $monday_obqd = $row1['obqd'];
                $monday_vecheriq = $row1['vecheriq'];
                $monday_name = $row1['name'];
            }

            //TUESDAY
            $stmt2 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt2->execute([$tuesday_dieta_id]);

            if ($stmt2 && $stmt2->rowCount() > 0) {
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                $tuesday_zakuska = $row2['zakuska'];
                $tuesday_obqd = $row2['obqd'];
                $tuesday_vecheriq = $row2['vecheriq'];
                $tuesday_name = $row2['name'];
            }

            //WEDNESDAY

            $stmt3 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt3->execute([$wednesday_dieta_id]);

            if ($stmt3 && $stmt3->rowCount() > 0) {
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                $wednesday_zakuska = $row3['zakuska'];
                $wednesday_obqd = $row3['obqd'];
                $wednesday_vecheriq = $row3['vecheriq'];
                $wednesday_name = $row3['name'];
            }

            //THURSDAY

            $stmt4 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt4->execute([$thursday_dieta_id]);

            if ($stmt4 && $stmt4->rowCount() > 0) {
                $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

                $thursday_zakuska = $row4['zakuska'];
                $thursday_obqd = $row4['obqd'];
                $thursday_vecheriq = $row4['vecheriq'];
                $thursday_name = $row4['name'];
            }

            //FRIDAY

            $stmt5 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt5->execute([$friday_dieta_id]);

            if ($stmt5 && $stmt5->rowCount() > 0) {
                $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);

                $friday_zakuska = $row5['zakuska'];
                $friday_obqd = $row5['obqd'];
                $friday_vecheriq = $row5['vecheriq'];
                $friday_name = $row5['name'];
            }

            //SATURDAY

            $stmt6 = $conn->prepare("SELECT * FROM tbl_inventar_dieti WHERE id = ?");
            $stmt6->execute([$saturday_dieta_id]);

            if ($stmt6 && $stmt6->rowCount() > 0) {
                $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);

                $saturday_zakuska = $row6['zakuska'];
                $saturday_obqd = $row6['obqd'];
                $saturday_vecheriq = $row6['vecheriq'];
                $saturday_name = $row6['name'];
            }
        }
    }else{
        echo '<script>alert("Все още не е изготвена праграмата за Вас!")</script>';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// Function to check if the client's subscription has expired
function isAbonnementExpired($conn, $id_client){

    // Get the current date and time
    $currentDate = new DateTime();

    // Retrieve the payment date from the database
    $sql = "SELECT date FROM payments WHERE id_customer = :id_client";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id_client' => $id_client]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql2 = "SELECT state FROM tbl_client WHERE id_client = :id_client";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute(['id_client' => $id_client]);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    // Check if the client's subscription is inactive (not paid)
    if($row2['state'] == 0){
        redirectToDidntPayPage();
    }

    // If a payment date is available in the database
    if($row){
        // Calculate the expiration date of the subscription (30 days after payment date)
        $createdDate = new DateTime($row['date']);
        $abonnamentDuration = new DateInterval('P1D');
        $expiration_date = $createdDate->add($abonnamentDuration);

        // Check if the current date is after the expiration date
        return $currentDate > $expiration_date;
    }
    else{
        return false; // No payment date, subscription not expired
    }
}

// Function to redirect to a page for clients who haven't paid
function redirectToDidntPayPage(){
    header("Location: didntPayPage.php");
    exit();
}

// Function to redirect to the payment page
function redirectToPaymentPage() {
    header("Location: recurringPayments.php");
    exit();
}

// Check if the subscription has expired, and if so, redirect to the payment page
if (isAbonnementExpired($conn, $id_client)) {
    redirectToPaymentPage();
}


?>


<body>
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://kit.fontawesome.com/ff8ec696f9.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/script.js"></script>


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


            <!----------------------------------------------------------------------------------------------->
            <div class="header">

                <div class="header-title">

                    <div class="titles">
                        <h1 class="black-title">You</h1>
                        <h1 class="orn-title">Gym</h1>
                    </div>

                    <h2>Добре дошли <span style="color:#F79327"><?=ucfirst($_SESSION['nameClient'])?></span>
                        в твоята нова, домашна фитнес зала!
                    </h2>
                </div>

                <div class="buttons">
                    
                    <button type="button" class="orn-btn"><a class="whiteColor" href="areaClient.php">Моя план</a></button>
                    <button type="button" class="white-btn"><a class="orangeColor" href="home.php#contact">Контакти</a></button>
                </div>

            </div>


        </div>


        <!------------------------------------------КАЛЕНДАР------------------------------------------------------>
        <!-------------------------------------------------------------------------------------------------------->

        <div id="response"></div>
        <div class="contPrograma">
            <h1>Календар за седмицата</h1>
            <div class="table center-table">
                <table>

                    <thead>
                        <tr>
                            <th scope="col">Абонамент</th>
                            <th scope="col">Понеделник</th>
                            <th scope="col">Вторник</th>
                            <th scope="col">Сряда</th>
                            <th scope="col">Четвъртък</th>
                            <th scope="col">Петък</th>
                            <th scope="col">Събота</th>
                            <th scope="col">Неделя</th>
                        </tr>
                    </thead>

                    <!------------------------------------------Диета--------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->

                    <tbody>

                        <tr>



                            <th>
                                <?php
                                $stm7 = $conn->query("SELECT * FROM `tbl_abonnement` WHERE id_abonnement = $abonnament;");
                                if ($stm7 && $stm7->rowCount() > 0) {
                                    $row7 = $stm7->fetch(PDO::FETCH_ASSOC);
                                    $_SESSION['abName'] = $row7['name'];
                                }

                                echo ucfirst($_SESSION['abName']);

                                ?>
                            </th>

                            <th>
                                <button id="mondayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>
                            <th>
                                <button id="tuesdayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>

                            <th>
                                <button id="wednesdayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>

                            <th>
                                <button id="thursdayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>

                            <th>
                                <button id="fridayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>

                            <th>
                                <button id="saturdayBtn" class="btnWeek">
                                    <span class="btnPlus"><i class="fa-solid fa-angle-down"></i></span>
                                </button>
                            </th>

                            <th>Почивен ден</th>

                        </tr>

                    </tbody>
                </table>
                 
            </div>
        </div>

        <div class="center-table">

            <?php if ($abonnament === 1) {
            ?>

                <div class="disciption-container mondayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $monday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $monday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $monday_vecheriq ?></p>


                    </div>

                </div>

                <div class="disciption-container tuesdayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $tuesday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $tuesday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $tuesday_vecheriq ?></p>


                    </div>
                </div>

                <div class="disciption-container wednesdayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $wednesday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $wednesday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $wednesday_vecheriq ?></p>


                    </div>
                </div>
                <div class="disciption-container thursdayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $thursday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $thursday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $thursday_vecheriq ?></p>


                    </div>
                </div>
                <div class="disciption-container fridayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $friday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $friday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $friday_vecheriq ?></p>


                    </div>
                </div>
                <div class="disciption-container saturdayBtn">

                    <div class="diet">

                        <h3>Закуска:</h3>
                        <p><?= $saturday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $saturday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $saturday_vecheriq ?></p>


                    </div>
                </div>
                <!------------------------------------------Тренировка---------------------------------------------------->
                <!-------------------------------------------------------------------------------------------------------->


            <?php
            } else if ($abonnament === 2) {
            ?>

                <div class="disciption-container mondayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $monday_nivo ?></h2>
                        <p><?= $monday_description; ?></p>

                    </div>
                </div>


                <div class="disciption-container tuesdayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $tuesday_nivo ?></h2>
                        <p><?= $tuesday_description; ?></p>

                    </div>
                </div>


                <div class="disciption-container wednesdayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $wednesday_nivo ?></h2>
                        <p><?= $wednesday_description ?></p>

                    </div>
                </div>


                <div class="disciption-container thursdayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $thursday_nivo ?></h2>
                        <p><?= $thursday_description ?></p>

                    </div>
                </div>


                <div class="disciption-container fridayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $friday_nivo ?></h2>
                        <p><?= $friday_description ?></p>

                    </div>
                </div>


                <div class="disciption-container saturdayBtn">

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $saturday_nivo ?></h2>
                        <p><?= $saturday_description ?></p>

                    </div>
                </div>

                    <!------------------------------------------Диета и Тренировка-------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->

            <?php
            } else if ($abonnament === 3) {
            ?>

                <div class="disciption-container mondayBtn">

                    <div class="diet">

                        <h2>Диетa</h2>

                        <h3>Закуска:</h3>
                        <p><?= $monday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $monday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $monday_vecheriq ?></p>

                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $monday_nivo ?></h2>
                        <p><?= $monday_description; ?></p>
                    </div>
                </div>


                <div class="disciption-container tuesdayBtn">

                    <div class="diet">

                        <h2>Диетa</h2>

                        <h3>Закуска:</h3>
                        <p><?= $tuesday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $tuesday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $tuesday_vecheriq ?></p>

                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $tuesday_nivo ?></h2>
                        <p><?= $tuesday_description; ?></p>

                    </div>
                </div>


                <div class="disciption-container wednesdayBtn">

                    <div class="diet">

                        <h2>Диетa</h2>

                        <h3>Закуска:</h3>
                        <p><?= $wednesday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $wednesday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $wednesday_vecheriq ?></p>

                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $wednesday_nivo ?>:</h2>
                        <p><?= $wednesday_description; ?></p>

                    </div>

                </div>


                <div class="disciption-container thursdayBtn">

                    <div class="diet">

                        <h2>Диетa</h2>

                        <h3>Закуска:</h3>
                        <p><?= $thursday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $thursday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $thursday_vecheriq ?></p>

                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $thursday_nivo ?></h2>
                        <p><?= $thursday_description; ?></p>

                    </div>

                </div>


                <div class="disciption-container fridayBtn">

                    <div class="diet">
                        <h2>Диетa</h2>

                        <h3>Закуска:</h3>
                        <p><?= $friday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $friday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $friday_vecheriq ?></p>

                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $friday_nivo ?></h2>
                        <p><?= $friday_description; ?></p>

                    </div>

                </div>


                <div class="disciption-container saturdayBtn">
                    <div class="diet">

                        <h2>Диетa</h2>


                        <h3>Закуска:</h3>
                        <p><?= $saturday_zakuska ?></p>

                        <h3>Обяд:</h3>
                        <p><?= $saturday_obqd ?></p>

                        <h3>Вечеря:</h3>
                        <p><?= $saturday_vecheriq ?></p>
                    </div>

                    <div class="traning">

                        <h2>Тренировка ниво: <?= $saturday_nivo ?></h2>
                        <p><?= $saturday_description; ?></p>

                    </div>
                </div>

            <?php
            }
            ?>


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
                        <h2>Въпроси и проблеми</h2>
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
        $(".btnWeek").on("click", function() {

            $('.disciption-container').css("display", "none");

            $(".btnWeek").removeClass("orange");

            $(this, ".btnPLus").addClass("orange");
            var id = $(this).attr("id");
            var clas = '.' + id;

            $(clas).css("display", "block");

        });

// Responsive menu
        function myFunction(){
        var x = document.getElementById("myTopnav");
        if(x.className === "topnav"){
            x.className += " responsive";
        }else{
            x.className = "topnav";
        }
    }


</script>