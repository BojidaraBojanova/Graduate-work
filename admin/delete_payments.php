<?php
include "../connection.php";
$conn = dbConnect();

$id_payments = $_GET['id']; 

$step=$conn->prepare("DELETE FROM payments WHERE id_customer=:id");
$step->bindParam(":id",$id_payments,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
}
?>