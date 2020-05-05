<?php
session_start();
    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $amount = $_SESSION['amount']; //Correct Amount from Server
        $currency = $_SESSION['currency']; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK_TEST-50f22fffb5fec59f35cf51804e3b40be-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
           
            $paydetails = [
                "name" => $_SESSION['name'],
                "email" => $_SESSION['email'],
                "transactionID" => $ref,
                "narration" => $_SESSION['narration'],
                "amount" => $_SESSION['amount'],
                "date" => date("Y-m-d, h:i:sa"),
                "paymentstatus" => $paymentStatus
                ];
                
                $detailsfile = json_encode($paydetails);
                file_put_contents("db/payment_success/" . $ref . ".json" , $detailsfile);

                $subject = "Payment Successful";
                $message = "Your payment of " . $_SESSION['amount']. " Naira has been received for the purpose you specified - " . $_SESSION['narration'] . " Thank you";
                $headers = "From: no-reply@snh.com" . "\r\n";		   

                $try = mail($_SESSION['email'],$subject,$message,$headers);
            //TODO send an email to user on successful payment
             //TODO Store successful payment details
            header("Location: paysuccess.php");
          // transaction was successful...
             // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          //Give Value and return to Success page
        } else {
             //TODO send an email to user on failed payment
            header("Location: payfailed.php");
            //Dont Give Value and return to Failure page
        }
    }
        else {
      die('No reference supplied');
    }

?>
