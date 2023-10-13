<?php
include "../connection.php";
$conn = dbConnect();

$id_clientDT = $_GET['id']; 

$step=$conn->prepare("DELETE FROM tbl_client_inventar WHERE id_client=:id_client");
$step->bindParam(":id_client",$id_clientDT,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
} 
?>