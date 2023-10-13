<?php
require_once 'config.php';// Include configuration file  
include_once 'connection.php';// Include database connection 

$payment_id = $statusMsg = '';// Initialize variables for payment details
$status = 'error';
$conn = dbConnect();


// Check whether stripe checkout session is not empty 
if(!empty($_GET['session_id'])){
    $session_id = $_GET['session_id'];

    // Fetch transaction data from the database if already exists 
    $sql = "SELECT * FROM payments WHERE stripe_checkout_session_id = :session_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":session_id",$session_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0){
        // Transaction details 
        $transData = $stmt->fetch(PDO::FETCH_ASSOC);
        $payment_id = $transData['id'];
        $transactionId = $transData['txn_id'];
        $paidAmount = $transData['paid_amount'];
        $paidCurrency = $transData['paid_amount_currency'];
        $payment_status = $transData['payment_status'];

        $customer_name = $transData['customer_name'];
        $customer_email = $transData['customer_email'];

        $status = 'success';
        $statusMsg = 'Вашето плащане е успешно!';

       
    }else{
        // Include the Stripe PHP library
        require_once 'stripe/init.php';

        // Set API key
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

        // Fetch the Checkout Session to display the JSON result on the success page 
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
        } catch (Exception $e) {
            $api_error = $e -> getMessage();
        }

        if(empty($api_error) && $checkout_session){
            // Get customer details
            $customer_details = $checkout_session->customer_details;

            // Retrieve the details of a PaymentIntent
            try{
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
            }catch(\Stripe\Exception\ApiErrorException $e){
                $api_error = $e->getMessage();
            }
            if(empty($api_error) && $paymentIntent){ 
            // Check whether the payment was successful 
            if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){
                // Transaction details
                $transactionID = $paymentIntent->id;
                $paidAmount = $paymentIntent->amount;
                $paidAmount = ($paidAmount/100);
                $paidCurrency = $paymentIntent->currency;
                $payment_status = $paymentIntent->status;

                // Customer info
                $customer_name = $customer_email = '';
                if(!empty($customer_details)){
                    $customer_name = !empty($customer_details->name)?$customer_details->name:'';
                    $customer_email = !empty($customer_details->email)?$customer_details->email:'';
                }

                // Check if any transaction data is exists already with the same TXN ID 
                $sql = "SELECT id FROM payments WHERE txn_id = :transactionID";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":transactionID",$transactionID);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $prevRow = $result;

                if(!empty($prevRow)){
                    $payment_id = $prevRow['id'];
                }else{
                    // Insert transaction data into the database 
                    $sql = "INSERT INTO payments (id_customer,customer_name, customer_email, item_name,
                item_number, item_price, item_price_currency, paid_amount, paid_amount_currency, txn_id,
                payment_status, stripe_checkout_session_id, date) VALUES
                (:id_client, :customer_name, :customer_email, :item_name, :item_number, :item_price, :item_price_currency,
                :paid_amount, :paid_amount_currency, :txn_id, :payment_status, :stripe_checkout_session_id, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(":id_client", $id_client);
                    $stmt->bindValue(":customer_name", $customer_name);
                    $stmt->bindValue(":customer_email", $customer_email);
                    $stmt->bindValue(":item_name", $productName);
                    $stmt->bindValue(":item_number", $productID);
                    $stmt->bindValue(":item_price", $productPrice);
                    $stmt->bindValue(":item_price_currency", $currency);
                    $stmt->bindValue(":paid_amount", $paidAmount);
                    $stmt->bindValue(":paid_amount_currency", $paidCurrency);
                    $stmt->bindValue(":txn_id", $transactionID);
                    $stmt->bindValue(":payment_status", $payment_status);
                    $stmt->bindValue(":stripe_checkout_session_id", $session_id);

                    $insert = $stmt->execute();

                    if($insert){
                        $payment_id = $conn->lastInsertId();

                        $sql = "UPDATE tbl_client SET state = ? WHERE id_client = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([1, $id_client]);
                    }
                    

                }
                $status = 'success'; 
                    $statusMsg = 'Вашето плащане е успешно!'; 
                }else{ 
                    $statusMsg = "Транзакцията е неуспешна!"; 
                } 
            }else{ 
                $statusMsg = "Не могат да бъдат извлечени подробностите за транзакцията! $api_error";  
            } 
        }else{ 
            $statusMsg = "Невалидна транзакция! $api_error";  
        } 
    } 
}else{ 
    $statusMsg = "Невалидна заявка!"; 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/ff8ec696f9.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="topnav" id="myTopnav">
            
            <div class="cont-logo">
                <img src="picture/logo1.png" alt="Logo">
            </div>
    
            <div class="menu-items">
                <a href="home.php">Home</a>
                <a href="#aboutUs">За нас</a>
                <a href="#abonament">Абонаменти</a>
                <a href="#contact">Контакти</a>
    
                <div class="cont-login">
                    
                   <a href='login.php'>Вход</a>

                </div>
            </div>
    
            <a href="javascript:void(0);" class="icon" style="color:black;" onclick = "myFunction()">
                <i class="fa fa-bars"></i>
            </a>              
    
        

    </div>
    <div class="container-successPayment">
        <div class="status">
            <?php if(!empty($payment_id)){?>
                <h1 class="<?php echo $status?>"><?php echo $statusMsg; ?></h1>
                
                <h4>Информация за плащането:</h4>
                <p><b>Номер за справка:</b> <?php echo $payment_id; ?></p>
                <p><b>Номер на транзакцията:</b> <?php echo $transactionID; ?></p>
                <p><b>Платена сума:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
                <p><b>Статус на плащането:</b> <?php echo $payment_status; ?></p>
                
                <h4>Информация за клиента</h4>
                <p><b>Име:</b> <?php echo $customer_name; ?></p>
                <p><b>Електронна поща:</b> <?php echo $customer_email; ?></p>
                
                <h4>Информация за абонамента</h4>
                <p><b>Име:</b> <?php echo $productName; ?></p>
                <p><b>Цена:</b> <?php echo $productPrice.' '.$currency; ?></p>
            <?php }else{ ?>

                <h1 class="error">Вашето плащане е неуспешно!</h1>
                <p class="error"><?php echo $statusMsg; ?></p>

            <?php } ?>
        </div>
        <a href="login.php" class="btn-link">Влезте в профила си!</a>
    </div>

    
    <footer>
        <img src="picture/logo1.png" alt="">
        <div class="footer-row">
            <div class="social-cont">
                <div class="social-cont-title">
                    <h2>Контакти</h2>
                </div>
                <div class="social-icon">
                    <div class="icon-text">
                        <i class="material-icons" style="font-size:36px">call</i>
                        <p>0894021178</p>
                    </div>

                    <div class="icon-text">
                        <a href="#" class="fa fa-facebook"></a>
                        <p>Facebook</p>
                    </div>

                    <div class="icon-text">
                        <a href="#" class="fa fa-instagram"></a>
                        <p>Instagram</p>
                    </div>


                </div>

            </div>

 

            <div class="footer-questions">

                <div class="social-cont-title">
                    <h2>въпроси и проблеми</h2>
                </div>

                <div class="cont-footer-questions">
                    <a href="#">Политика за поверителност</a>
                    <a href="#">Политика за бисквитки</a>
                    <a href="#">въпроси и проблеми</a>
                </div>

                <div class="bobi">
                    <h3>Designed by <span style="color: orange;"> Bojidara Bojanova</span> </h3>
                </div>

            </div>
        </div>

    </footer>
</body>
</html>
<script>
    function myFunction(){
        var x = document.getElementById("myTopnav");
        if(x.className === "topnav"){
            x.className += " responsive";
        }else{
            x.className = "topnav";
        }
    }
</script>