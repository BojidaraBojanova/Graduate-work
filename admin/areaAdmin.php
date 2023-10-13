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
    
    <div class="header-cont" style="height:50vh;">
        <div class="title">
            <h1>Административно табло на <?php echo $_SESSION['adminName'] ?><a href="adminLogout.php" style="color:red;margin-left:1rem;text-decoration:none;">x</a></h1>
        </div>
    </div>
    <div class="couch">
        <form action="" method="post" name="client_form" class="client_form">
            <h2>Треньори <a href="add_couch.php" style="color:green;text-decoration:none;">+</a></h2>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Име</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Парола</th>
                            <th scope="col">Имейл</th>
                            <th scope="col">Рожденна дата</th>
                            <th scope="col">Редактиране</th>
                            <th scope="col">Изтриване</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_coach";
                            $result = $conn->query($sql);

                            if($result->rowCount() > 0){
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                    echo"<tr>";
                                    echo"<th>";
                                    echo $row["coach_name"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["coach_lastName"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["address"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["password"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["email"];
                                    echo"</th>";
                                    echo"<th>";
                                    echo $row["birth_date"];
                                    echo"</th>";
                                    ?>
                                    <th><a href="edit_coach.php?id=<?php echo $row["id_coach"];?>" class='edit-btn' style="padding:0.4rem; text-decoration:none; font-size:1rem;" >Редактиране</a></th>
                                    <th><a href="delete_coach.php?id=<?php echo $row["id_coach"];?>" class='delete-btn' onclick="DeleteConfirm()" style="padding:0.4rem; text-decoration:none; font-size:1rem;">Изтриване</a></th> 
                                    <?php
                                    echo "</tr>";

                                }
                            }else{
                                echo"Няма клиенти";
                            }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </form>
    </div>
</body>
</html>
<script>
    function DeleteConfirm() {
      confirm("Are you sure to delete the record");
     }
 </script>