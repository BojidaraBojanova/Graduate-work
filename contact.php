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
        
        $errors ="Моля, въведете вашето име";
        echo $errors;
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

       $errors = "Моля, въведете валиден адрес";
       echo $errors;

    }

    if(empty($message)){
        
        $errors = "Моля, въведете съобщение";

    }

    if(!empty($errors)){
        foreach($errors as $error){
            echo"<script>alert('$error')</script>";
        }
        exit;
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