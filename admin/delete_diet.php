<?php
include "../connection.php";
$conn = dbConnect();

$id_diet = $_GET['id']; 

$step=$conn->prepare("DELETE FROM tbl_inventar_dieti WHERE id=:id");
$step->bindParam(":id",$id_diet,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
}
?>