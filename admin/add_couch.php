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

    <div class="header-cont responCont" style="height:20vh; margin:2rem">
        <div class="title">
            <h1>Добавяне на треньори</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" >
            <div class="table responTable" style="width:50%;">
                <table>
                    <thead>
                        <tr>
                        <th scope="col">Име</th>
                        <th>
                            <input type="text" name="name" id="name">
                        </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Фамилия</th>
                            <th>
                                <input type="text" name="lastName" id="lastName">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Адрес</th>
                            <th>
                                <input type="text" name="address" id="address">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Парола</th>
                            <th>
                                <input type="password" name="password" id="password">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Имейл</th>
                            <th>
                                <input type="text" name="email" id="email">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Рожденна дата</th>
                            <th>
                                <input type="date" name="birth_date" id="birth_date">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="width:100%">
                                <button type="submit" name="submit" class='add-btn' style="width:100%">Добавяне</button>
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
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birth_date = $_POST["birth_date"];

    $uppercase = preg_match('@[A-Z]@',$password);
    $lowercase = preg_match('@[a-z]@',$password);
    $number = preg_match('@[0-9]@',$password);
    $specialChars = preg_match('@[^\w]@',$password);

    if(empty($_POST['name'])||empty($_POST['lastName'])||empty($_POST['address'])||empty($_POST['password'])||empty($_POST['email'])||empty($_POST["birth_date"])){

        echo"<script>alert('Моля попълнете полетата')</script>";

    }else if(strlen($password)<4){

        echo"<script>alert('Паролата трябва да е най-малко с 8 символа и трябва да съдържа поне една главна буква, една цифра и един специален символ')</script>";

    }/* else if(empty($_POST['name'])||empty($_POST['lastName'])||empty($_POST['date'])||empty($_POST['address'])||empty($_POST['gender'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['height'])||empty($_POST['weight'])||empty($_POST['abonnament']))
    {
    
        echo"<script>alert('Моля попълнете всички полета')</script>";
    
    } */else{

        try {
                        
                    
            $conn = dbConnect();

            $sql2 = 'SELECT * FROM tbl_coach WHERE email=?';
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$email]);

            $row = $stmt2->fetch(PDO::FETCH_ASSOC);
            if($stmt2->rowCount() > 0){
                echo '<script>alert("Съществува треньор с този имейл")</script>';
            }else{

                $sql = 'INSERT INTO tbl_coach (coach_name, coach_lastName, address, password, email, birth_date) VALUES (?, ?, ?, ?, ?, ?)';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $lastName, $address, $password, $email, $birth_date]);
                    

            if($stmt){

                $_SESSION["logged_in"] = true; 
                $_SESSION['email'] = $email;
                $_SESSION['id_coach'] = $row['id_coach'];
                header('Location: areaAdmin.php');
                        
            }else{
                echo 'Има проблем с добавянето на треньор';
            }
        }
                
        }catch(Exception $e){

            echo $e->getMessage();

        }
    }
}
?>
