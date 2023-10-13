<?php
require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/ff8ec696f9.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container">

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
                <?php 
                    if (isset($_SESSION["logged_in"])){
                        echo "<a href='logout.php'>Излез</a>";
                    }else{
                        echo "<a href='login.php'>Вход</a>";
                    }
                ?>
            </div>
        </div>

        <a href="javascript:void(0);" class="icon" style="color:black;" onclick = "myFunction()">
            <i class="fa fa-bars"></i>
        </a>              

    </div>

    <div class="container-pay">
        <div class="payment-cont">

            <!-- Показване на грешки, върнати от сесията за плащане -->
            <div id="paymentResponse" class="hidden"></div>
            
            <h2>Вие избрахте абонамент <h1 style="color:orange;"><?php echo $productName; ?></h1></h2>
            <p>За да продължите, трябва първо да платите!</p>
            <p>Цена: <b style="color:orange;"><?php echo $productPrice.'.лв '.strtoupper($currency); ?></b></p>
            <button class="stripe-button" id="payButton">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Плати чрез <i class="fa-brands fa-stripe fa-2xl" style="margin-top:1.5rem"></i></span>
            </button>
            
        </div>
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
const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

const payBtn = document.querySelector("#payButton");

// Handle payment button click
payBtn.addEventListener("click", function (evt) {
    setLoading(true);

    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            // Redirect to Stripe Checkout
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
    
// Create a checkout session for the selected subscription
const createCheckoutSession = function (stripe) {
    return fetch("payment_init.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            createCheckoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle payment result and errors
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
    
    setLoading(false);
};

// Show a spinner on payment processing
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Display payment response message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
	
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
	
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    },5000);
}


function myFunction(){
        var x = document.getElementById("myTopnav");
        if(x.className === "topnav"){
            x.className += " responsive";
        }else{
            x.className = "topnav";
        }
}
</script>