<?php
session_start();
include "../connection.php";
$conn = dbConnect();

$id_abonnement = $_GET['id']; 
$sql = "SELECT * FROM tbl_abonnement WHERE id_abonnement = '$id_abonnement'"; 
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
            <h1>Редактиране на абонамент</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цена</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="text" name="name" id="name" value="<?php echo $row["name"] ?>">
                            </th>
                            <th>
                                <input type="text" name="price" id="price" value="<?php echo $row["price"] ?>">
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
    
    $name = $_POST["name"];
    $price = $_POST["price"];
    try {
                
        $conn = dbConnect();
        

        $sql = "UPDATE tbl_abonnement SET name = ?, price = ? WHERE id_abonnement = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $price, $id_abonnement]);

            

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