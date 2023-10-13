<?php
session_start();
include "../connection.php";
$conn = dbConnect();

$id_couch = $_GET['id']; 
$sql = "SELECT * FROM tbl_coach WHERE id_coach = '$id_couch'"; 
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
            <h1>Редактиране на треньор</h1>
        </div>
    </div>
        <form action="" method="post" name="client_form" class="couch_form" style="margin-top:-10rem;" >
            <div class="table responTable">
                <table>
                        <tr>
                            <th scope="col">Име</th>
                            <th>
                                <input readonly type="text" name="name" id="name" style="width:90%" value="<?php echo $row["coach_name"] ?>">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Фамилия</th>
                            <th>
                                <input readonly type="text" name="lastName" id="lastName" style="width:90%" value="<?php echo $row["coach_lastName"] ?>">               
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Адрес</th>
                            <th>
                                <input type="text" name="address" id="address" style="width:90%" value="<?php echo $row["address"] ?>">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Парола</th>
                            <th>
                                <input type="text" name="password" id="password" style="width:90%" value="<?php echo $row["password"] ?>">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Имейл</th>
                            <th>
                                <input type="text" name="email" id="email" style="width:90%" value="<?php echo $row["email"] ?>">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Рожденна дата</th>
                            <th>
                                <input readonly type="date" name="birth_date" style="width:90%" id="birth_date" value="<?php echo $row["birth_date"] ?>">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <button type="submit" name="submit" class='edit-btn'>Редактиране</button>
                            </th>
                        </tr>

                </table>
            </div>
        </from>


</body>
</html>
<?php
if(isset($_POST['submit'])){ 
    $name = $_POST["name"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birth_date = $_POST["birth_date"];

    try {
                
        $conn = dbConnect();
        

        $sql = "UPDATE tbl_coach SET coach_name = ?, coach_lastName = ?, address = ?, password = ?,email = ?, birth_date = ?  WHERE id_coach = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $lastName, $address, $password, $email, $birth_date,$id_couch]);


        if($stmt && $stmt->rowCount()){
            header('Location: areaAdmin.php');
                    
        }else{
            echo 'Има проблем с редактирането на треньор';
        }
            
    }catch(Exception $e){

        echo $e->getMessage();

    }
}
?>