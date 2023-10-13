<?php
session_start();
include "../connection.php";
$conn = dbConnect();

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
            <h1>Добавяне на нови Тренировки</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ниво</th>
                            <th scope="col">Описание</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="number" min=0 max=3 name="nivo" id="nivo">
                            </th>
                            <th>
                                <textarea name="description" id="description" cols="20" rows="5"></textarea>
                            </th>
                            <th>
                                <button type="submit" name="submit" class='add-btn'>Добавяне</button>
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

        

        $sql = 'INSERT INTO tbl_inventar_training (nivo, description, abonament_id) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nivo, $description,2]);
            

        if($stmt && $stmt->rowCount()){
            header('Location: couch.php');
                    
        }else{
            echo 'Има проблем с добавянето на диета';
        }
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}
?>