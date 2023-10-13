<?php 
 
require_once 'config.php'; // Include configuration settings
 
// Include Stripe PHP library
require_once 'stripe/init.php'; 
 
// Set API key
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY); // Initialize Stripe with API key
 
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Невалидна заявка!'    
    ) 
); 
 
// Check for POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
// Check for invalid JSON
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
// Check for request to create a checkout session
if(!empty($request->createCheckoutSession)){ 
     
    $stripeAmount = round($productPrice*100, 2); 
 
    // Create a new payment session for the subscription
    try { 
        $checkout_session = $stripe->checkout->sessions->create([ 
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => $productName, 
                        'metadata' => [ 
                            'pro_id' => $productID 
                        ] 
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => $currency, 
                ], 
                'quantity' => 1 
            ]], 
            'mode' => 'payment', 
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}', 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    // Check for successful creation of payment session
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Сесията за плащане е създадена успешно!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Неуспешно създаване на сесия за плащане! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Output the result in JSON format
echo json_encode($response); 
 
?>