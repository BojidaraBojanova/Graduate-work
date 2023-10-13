<?php
include "../connection.php";
$conn = dbConnect();

$id_client = $_GET['id']; 

$step=$conn->prepare("DELETE FROM tbl_client WHERE id_client=:id_client");
$step->bindParam(":id_client",$id_client,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
} 
?>