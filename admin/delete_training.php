<?php
include "../connection.php";
$conn = dbConnect();

$id_training = $_GET['id']; 

$step=$conn->prepare("DELETE FROM tbl_inventar_training WHERE id=:id");
$step->bindParam(":id",$id_training,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
}
?>