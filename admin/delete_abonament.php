<?php
include "../connection.php";
$conn = dbConnect();

$id_abonnement = $_GET['id']; 
// $sql = "DELETE * FROM tbl_abonnement WHERE id_abonnement = '$id_abonnement'"; 
// $result = $conn->query($sql);
// $row = $result->fetch(PDO::FETCH_ASSOC);

$step=$conn->prepare("DELETE FROM tbl_abonnement WHERE id_abonnement=:id_abonnement");
$step->bindParam(":id_abonnement",$id_abonnement,PDO::PARAM_INT);
$step->execute();
if($step){
    header('Location: couch.php');
}else{
    echo "greshka";
}
?>