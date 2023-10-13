<?php

include "../connection.php";
session_start();


if(isset($_POST['submitD'])){ 

    $monday_dieta = $_POST['monday_dieta'];
    $tuesday_dieta = $_POST['tuesday_dieta'];
    $wednesday_dieta  = $_POST['wednesday_dieta'];
    $thursday_dieta = $_POST['thursday_dieta'];
    $friday_dieta = $_POST['friday_dieta'];
    $saturday_dieta = $_POST['saturday_dieta'];

    

    try {
                    
                
        $conn = dbConnect();

        $sql2 = 'SELECT id_client FROM tbl_client_inventar WHERE id_client=?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$_SESSION['id_client']]);

        if($stmt2){
            if( $stmt2->rowCount() > 0){
            
                $sql3 = "UPDATE `tbl_client_inventar` SET `monday_training`= NULL,`monday_dieta`= ?,";
                $sql3 .="`tuesday_training`= NULL,`tuesday_dieta`= ?,`wednesday_training`= NULL,`wednesday_dieta`= ?,";
                $sql3 .="`thursday_training`= NULL,`thursday_dieta`= ?,`friday_training`= NULL,`friday_dieta`= ?,";
                $sql3 .= "`saturday_training`= NULL,`saturday_dieta`= ? WHERE id_client = ?";

                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute([$monday_dieta, $tuesday_dieta, $wednesday_dieta, $thursday_dieta, $friday_dieta, $saturday_dieta,$_SESSION['id_client']]);

            
                if($stmt3 && $stmt3->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с редактирането';
                }
            }else{
                $sql = "INSERT INTO `tbl_client_inventar` (`id_client`, `monday_training`,";
                $sql .= " `monday_dieta`, `tuesday_training`, `tuesday_dieta`, `wednesday_training`,";
                $sql .= " `wednesday_dieta`, `thursday_training`, `thursday_dieta`, `friday_training`, `friday_dieta`,";
                $sql .= " `saturday_training`, `saturday_dieta`) VALUES ( :id_client, NULL, :monday_dieta, NULL, :tuesday_dieta, NULL, :wednesday_dieta, NULL, :thursday_dieta,";
                $sql .= "NULL, :friday_dieta, NULL, :saturday_dieta)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_client' => $_SESSION['id_client'],':monday_dieta' => $monday_dieta, ':tuesday_dieta' => $tuesday_dieta, ':wednesday_dieta' => $wednesday_dieta, ':thursday_dieta' => $thursday_dieta, ':friday_dieta' => $friday_dieta, ':saturday_dieta' => $saturday_dieta]);
            
                if($stmt){
                    echo "<script>
                            alert ('okk');
                        </script>";
                }
        
                if($stmt && $stmt->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с добавянето';
                }
            }
        
        }
        
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}

if(isset($_POST['submitT'])){ 

    $monday_training = $_POST['monday_training'];
    $tuesday_training = $_POST['tuesday_training'];
    $wednesday_training  = $_POST['wednesday_training'];
    $thursday_training = $_POST['thursday_training'];
    $friday_training = $_POST['friday_training'];
    $saturday_training = $_POST['saturday_training'];

    

    try {
                    
                
        $conn = dbConnect();

        $sql2 = 'SELECT id_client FROM tbl_client_inventar WHERE id_client=?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$_SESSION['id_client']]);

        if($stmt2){
            if( $stmt2->rowCount() > 0){
            
                $sql3 = "UPDATE `tbl_client_inventar` SET `monday_training`= ?,`monday_dieta`= NULL,";
                $sql3 .="`tuesday_training`= ?,`tuesday_dieta`= NULL,`wednesday_training`= ?,`wednesday_dieta`= NULL,";
                $sql3 .="`thursday_training`= ?,`thursday_dieta`= NULL,`friday_training`= ?,`friday_dieta`= NULL,";
                $sql3 .= "`saturday_training`= ?,`saturday_dieta`= NULL WHERE id_client = ?";

                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute([$monday_training, $tuesday_training, $wednesday_training, $thursday_training, $friday_training, $saturday_training,$_SESSION['id_client']]);

            
                if($stmt3 && $stmt3->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с редактирането';
                }
            }else{
                $sql = "INSERT INTO `tbl_client_inventar` (`id_client`, `monday_training`,";
                $sql .= " `monday_dieta`, `tuesday_training`, `tuesday_dieta`, `wednesday_training`,";
                $sql .= " `wednesday_dieta`, `thursday_training`, `thursday_dieta`, `friday_training`, `friday_dieta`,";
                $sql .= " `saturday_training`, `saturday_dieta`) VALUES ( :id_client, :monday_training, NULL, :tuesday_training, NULL, :wednesday_training, NULL, :thursday_training, NULL,";
                $sql .= ":friday_training, NULL, :saturday_training, NULL)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_client' => $_SESSION['id_client'],':monday_training' => $monday_training, ':tuesday_training' => $tuesday_training, ':wednesday_training' => $wednesday_training, ':thursday_training' => $thursday_training, ':friday_training' => $friday_training, ':saturday_training' => $saturday_training]);
            
                if($stmt){
                    echo "<script>
                            alert ('okk');
                        </script>";
                }
        
                if($stmt && $stmt->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с добавянето';
                }
            }
        
        }
        
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}
if(isset($_POST['submitTD'])){ 
    $monday_dieta = $_POST['monday_dieta'];
    $tuesday_dieta = $_POST['tuesday_dieta'];
    $wednesday_dieta  = $_POST['wednesday_dieta'];
    $thursday_dieta = $_POST['thursday_dieta'];
    $friday_dieta = $_POST['friday_dieta'];
    $saturday_dieta = $_POST['saturday_dieta'];

    $monday_training = $_POST['monday_training'];
    $tuesday_training = $_POST['tuesday_training'];
    $wednesday_training  = $_POST['wednesday_training'];
    $thursday_training = $_POST['thursday_training'];
    $friday_training = $_POST['friday_training'];
    $saturday_training = $_POST['saturday_training'];

    try {
                    
                
        $conn = dbConnect();

        $sql2 = 'SELECT id_client FROM tbl_client_inventar WHERE id_client=?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$_SESSION['id_client']]);

        if($stmt2){
            if( $stmt2->rowCount() > 0){
            
                $sql3 = "UPDATE `tbl_client_inventar` SET `monday_training`= ?,`monday_dieta`= ?,";
                $sql3 .="`tuesday_training`= ?,`tuesday_dieta`= ?,`wednesday_training`= ?,`wednesday_dieta`= ?,";
                $sql3 .="`thursday_training`= ?,`thursday_dieta`= ?,`friday_training`= ?,`friday_dieta`= ?,";
                $sql3 .= "`saturday_training`= ?,`saturday_dieta`= ? WHERE id_client = ?";

                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute([$monday_training, $monday_dieta, $tuesday_training, $tuesday_dieta, $wednesday_training, $wednesday_dieta, $thursday_training, $thursday_dieta, $friday_training, $friday_dieta, $saturday_training, $saturday_dieta, $_SESSION['id_client']]);

            
                if($stmt3 && $stmt3->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с редактирането';
                }
            }else{
                $sql = "INSERT INTO `tbl_client_inventar` (`id_client`, `monday_training`,";
                $sql .= " `monday_dieta`, `tuesday_training`, `tuesday_dieta`, `wednesday_training`,";
                $sql .= " `wednesday_dieta`, `thursday_training`, `thursday_dieta`, `friday_training`, `friday_dieta`,";
                $sql .= " `saturday_training`, `saturday_dieta`) VALUES ( :id_client, :monday_training, :monday_dieta, :tuesday_training, :tuesday_dieta, :wednesday_training, :wednesday_dieta, :thursday_training, :thursday_dieta,";
                $sql .= ":friday_training, :friday_dieta, :saturday_training, :saturday_dieta)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_client' => $_SESSION['id_client'],':monday_training' => $monday_training, ':monday_dieta'=>$monday_dieta, ':tuesday_training' => $tuesday_training,
                ':tuesday_dieta'=>$tuesday_dieta,':wednesday_training' => $wednesday_training, ':wednesday_dieta' => $wednesday_dieta, ':thursday_training' => $thursday_training,
                ':thursday_dieta'=>$thursday_dieta,':friday_training' => $friday_training,':friday_dieta' => $friday_dieta, ':saturday_training' => $saturday_training, ':saturday_dieta'=>$saturday_dieta]);
            
                if($stmt){
                    echo "<script>
                            alert ('okk');
                        </script>";
                }
        
                if($stmt && $stmt->rowCount()){
                    header('Location: couch.php');
                            
                }else{
                    echo 'Има проблем с добавянето на диета';
                }
            }
        
        }
        
            
    }catch(Exception $e){

        echo $e->getMessage();

    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <h1>hey bro

    <?php
        echo $monday_dieta;
        echo " ".$tuesday_dieta;
        echo " ".$wednesday_dieta;
        echo " ".$thursday_dieta;
        echo " ".$friday_dieta;
        echo " ".$saturday_dieta;
    ?>

    </h1>
    </body>
</html>