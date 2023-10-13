<?php
session_start();
include "../connection.php";
$conn = dbConnect();

$id_training = $_GET['id']; 
$sql = "SELECT * FROM tbl_inventar_training WHERE id = '$id_training'"; 
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminCss/dashStyle.css">
</head>
<body>

    <div class="header-cont responCont">
        <div class="title">
            <h1>Редактиране на тренировка</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ниво на трудност</th>
                            <th scope="col">Описание</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="number" min=1 max=3 name="nivo" id="nivo" value="<?php echo $row["nivo"] ?>">
                            </th>
                            <th>
                                <textarea name="description" id="description" cols="30" rows="10"><?php echo $row["description"] ?></textarea>
                            </th>
                            <th>
                                <button type="submit" name="submit" class='edit-btn'>Редактиране</button>
                            </th>
                        </tr>
                    </tbody>

                </table>
            </div>
        </from>
    </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){ 

    $nivo = $_POST["nivo"];
    $description = $_POST["description"];

    try {
                
        $conn = dbConnect();
        

        $sql = "UPDATE tbl_inventar_training SET nivo = ?, description = ?, abonament_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nivo, $description,2, $id_training]);


        if($stmt && $stmt->rowCount()){
            header('Location: couch.php');
                    
        }else{
            echo 'Има проблем с добавянето на абонамент';
        }
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}
?>