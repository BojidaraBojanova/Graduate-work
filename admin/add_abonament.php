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
            <h1>Добавяне на нови абонаменти</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Добавяне</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="text" name="name" id="name">
                            </th>
                            <th>
                                <input type="text" name="price" id="price">
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
    $name = $_POST["name"];
    $price = $_POST["price"];
    try {
                    
                
        $conn = dbConnect();

        

        $sql = 'INSERT INTO tbl_abonnement (name, price) VALUES (?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $price]);
            

        if($stmt && $stmt->rowCount()){
            header('Location: couch.php');
            $expirationDate = $_SESSION['expirationDate'];
                    
        }else{
            echo 'Има проблем с добавянето на абонамент';
        }
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}
?>