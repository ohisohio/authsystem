<?php session_start();

//Collecting the data

$errorCount = 0;

$token = $_POST['token'] != "" ? $_POST['token'] :  $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;

$_SESSION['token'] = $token;
$_SESSION['email'] = $email;


if($errorCount > 0){

    $session_error = "You have " . $errorCount . " error";
    
    if($errorCount > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    $_SESSION["error"] = $session_error;

    header("Location: reset.php");
}else{

    $allUserTokens = scandir("db/token/"); 
    $countAllUserTokens = count($allUserTokens);

    for ($counter = 0; $counter < $countAllUserTokens ; $counter++) {
        
        $currentTokenFile = $allUserTokens[$counter];

        if($currentTokenFile == $email . ".json"){
            $tokenContent = file_get_contents("db/users/".$currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            $tokenFromDB = $tokenObject->token;
            
            if ($tokenFromDB == $token){

                $allUsers = scandir("db/users/");
                $countAllUsers = count($allUsers);
                for ($counter = 0; $counter < $countAllUsers ; $counter++) {
       
                    $currentUser = $allUsers[$counter];
            
                    if($currentUser == $email . ".json"){
                      //check the user password.
                        $userString = file_get_contents("db/users/".$currentUser);
                        $userObject = json_decode($userString);
                        $userObject ->password = password_hash($password, PASSWORD_DEFAULT);

                        unlink("db/users/".$currentUser);

                        file_put_contents("db/users" . $email . ".json", json_encode($userObject));

                        $_SESSION["message"] = "Password Reset Successful, you can now login with your new password";

                        $subject = "Password Reset Successfull";
                        $message = "A password reset was been initiatiated from your SNH Account with us, and it was successful.";
                        $headers = "From: no-reply@snh.com" . "\r\n";
                        
                                    
                        $try = mail($email,$subject,$message,$headers);
            


                        header("Location:login.php");
                        die();
                        }
                      
                    }
                    
                }
            
            }

        }
    }

    $_SESSION["error"] = "Password Reset failed, token/email invalid or expired "; 
    header("Location: login.php");

?>