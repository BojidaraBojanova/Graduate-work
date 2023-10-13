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
            <h1>Добавяне на нови диети</h1>
        </div>
    </div>
    <form action="" method="post" name="client_form" class="client_form" style="margin-top:-10rem;">
            <div class="table responTable">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ниво</th>
                            <th scope="col">Име</th>
                            <th scope="col">Закуска</th>
                            <th scope="col">Обяд</th>
                            <th scope="col">Вечеря</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="number" min=0 max=3 name="nivo" id="nivo">
                            </th>
                            <th>
                                <input type="text" name="name" id="name">
                            </th>
                            <th>
                                <textarea name="zakuska" id="zakuska" cols="15" rows="5"></textarea>
                            </th>
                            <th>
                                <textarea name="obqd" id="obqd" cols="15" rows="5"></textarea>
                            </th>
                            <th>
                                <textarea name="vecheriq" id="vecheriq" cols="15" rows="5"></textarea>
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
    // Get input values from the form
    $nivo = $_POST["nivo"];
    $name = $_POST["name"];
    $zakuska = $_POST["zakuska"];
    $obqd = $_POST["obqd"];
    $vecheriq = $_POST["vecheriq"];

    try {
                     
        $conn = dbConnect();

        // SQL query to insert data into the database
        $sql = 'INSERT INTO tbl_inventar_dieti (nivo, name, zakuska, obqd, vecheriq, abonament_id) VALUES (?, ?, ?, ?, ?, ?)';
        // Set up the SQL statement for execution
        $stmt = $conn->prepare($sql);
        // Execute the statement with provided values
        $stmt->execute([$nivo, $name, $zakuska, $obqd, $vecheriq,1]);
            
        // Check if the statement executed successfully and has affected rows
        if($stmt && $stmt->rowCount()){
            
            // Redirect to the specified page after successful insertion
            header('Location: couch.php');
                    
        }else{
            // Display error message if insertion failed
            echo 'Има проблем с добавянето на диета';
        }
            
    }catch(Exception $e){

        // Display any exceptions or errors that occurred
        echo $e->getMessage();

    }
}
?>