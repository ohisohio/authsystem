<?php
session_start();

$errorCount = 0;

$department = $_POST['department'] != "" ? $_POST['department'] :  $errorCount++;
$narration = $_POST['narration'] != "" ? $_POST['narration'] :  $errorCount++;


$_SESSION['department'] = $department;
$_SESSION['narration'] = $narration;

$amount1 = $_POST['department'];
$email = $_POST['email'];
$name = $_POST['first_name'] . " " . $_POST['last_name'];
$transID = $_POST['transactionID'];
$narration = $_POST['narration'];
$date = date("Y-m-d, h:i:sa");

if($errorCount > 0){
$_SESSION['error'] . "Fill the fields below";
header("Location: payments.php");
}

else{
$paymentdetails = [
"name" => $name,
"email" => $email,
"transactionID" => $transID,
"narration" => $narration,
"amount" => $amount1,
"date" => $date
];

$detailsfile = json_encode($paymentdetails);
file_put_contents("db/payments_initiate/" . $transID . ".json" , $detailsfile);

$_SESSION['amount'] = $amount1;
$_SESSION['currency'] = "NGN";
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['narration'] = $narration;


}



$curl = curl_init();

$customer_email = $email;
$amount = $amount1;  
$currency = "NGN";
$txref = $transID; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-2f90d4ea53fd982df60e2ee655d9e2fe-X"; // get your public key from the dashboard.
$redirect_url = "http://localhost/snh/payrave.php";



curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url,
    
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);

?>