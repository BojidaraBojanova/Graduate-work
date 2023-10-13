<?php
session_start();
include "../connection.php";
$conn = dbConnect();

$id_diet = $_GET['id']; 
$sql = "SELECT * FROM tbl_inventar_dieti WHERE id = '$id_diet'"; 
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
            <h1>Редактиране на <?=$row['name']?></h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                        <th scope="col">Ниво на трудност</th>
                            <th scope="col">Закуска</th>
                            <th scope="col">Обяд</th>
                            <th scope="col">Вечеря</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="number" min=1 max=3 name="nivo" id="nivo" value="<?php echo $row["nivo"] ?>">
                            </th>
                            <th>
                                <textarea name="zakuska" id="zakuska" cols="30" rows="10"><?php echo $row["zakuska"] ?></textarea>
                            </th>
                            <th>
                                <textarea name="obqd" id="obqd" cols="30" rows="10"><?php echo $row["obqd"] ?></textarea>
                            </th>
                            <th>
                                <textarea name="vecheriq" id="vecheriq" cols="30" rows="10"><?php echo $row["vecheriq"] ?></textarea>
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
    // Retrieve form data
    $id_diet = $_GET['id']; 
    $nivo = $_POST["nivo"];
    $zakuska = $_POST["zakuska"];
    $obqd = $_POST["obqd"];
    $vecheriq = $_POST["vecheriq"];

    try {
                
        $conn = dbConnect();
        
        // Update diet details in the database
        $sql = "UPDATE tbl_inventar_dieti SET nivo = ?, zakuska = ?, obqd = ?, vecheriq = ?,abonament_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nivo, $zakuska, $obqd, $vecheriq, 1, $id_diet]);

        // Redirect to the coach page upon successful update
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