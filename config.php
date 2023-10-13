<?php
session_start();
include "connection.php";


$email = $_SESSION['email'];
$id_client = $_SESSION['client_id'];
$abonnament = $_SESSION['abonnament'];


try{
    $conn = dbConnect();   

    $conn1 = dbConnect();   
    $sql1 = "SELECT * FROM tbl_client WHERE email = ?"; 
    $stm = $conn->prepare($sql1);
    $stm->execute([$email]);
    if($stm && $stm->rowCount() > 0){
        $rowC = $stm->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nameClient'] = $rowC['client_name'];

    }

    $sql = "SELECT * FROM tbl_abonnement WHERE id_abonnement = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute([$abonnament]);

    if($stmt && $stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $abonnament_price = $row['price'];
        $abonnament_name = $row['name'];
        $abonnament_id = $row['id_abonnement'];
    }
}catch(Exception $e){
    echo $e->getMessage();
}

$productName = $abonnament_name;
$productID = $abonnament_id;
$productPrice = $abonnament_price;
$currency = "bgn";



define('STRIPE_API_KEY','sk_test_51NLrnkEN535Uia0A7ItVsiQ3LBEAld2tgxFA1Hot080qY8IUrC5AM1cf7Fn4CvnE0acfLJfnsnE5Tvq6v5TRDqA300tp47SSOp');
define('STRIPE_PUBLISHABLE_KEY','pk_test_51NLrnkEN535Uia0AfoEdq5H46pWbnqu9kIe3XuWFeits2iI4xN9xvVrW5mNt49mzbjgZrrSxwznaYUJ007223V5l00iO1x90qS');
define('STRIPE_SUCCESS_URL','http://localhost/gym/gym1.9/payment-success.php');
define('STRIPE_CANCEL_URL','http://localhost/gym/gym1.9/payment-cancel.php');
define('STRIPE_SUCCESS2_URL','http://localhost/gym/gym1.9/payment-success2.php');



//Database configuraation
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','gym');

?>