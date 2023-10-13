<?php
include "../connection.php";
$conn = dbConnect();

$id_couch = $_GET['id']; 

$step=$conn->prepare("DELETE FROM tbl_coach WHERE id_coach=:id");
$step->bindParam(":id",$id_couch,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: areaAdmin.php');
}else{
    echo "greshka";
}
?>