<?php session_start();

$errorCount = 0;

//TODO Fix error display message

$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;
$lastlog = date("Y-m-d, h:i:sa");

$_SESSION['email'] = $email;
$emailerr = $emailerrfmt = $passworderr = "";
if(empty($email)){
	$emailerr = "Email cannot be empty";
	$errorCount++;
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$emailerrfmt = "Invalid email format";
	$errorCount++;
}else{
	$_SESSION['email'] = $email;
}

if(empty($password)){
	$passworderr = "Password cannot be empty";
	$errorCount++;
}

if($errorCount > 0){
	$_SESSION["emailerr"] = $emailerr; 
	$_SESSION["emailerrfmt"] = $emailerrfmt;
	$_SESSION["passworderr"] = $passworderr;
    $_SESSION["error"] = $session_error ;
    
      
    header("Location: login.php");

}else{
    
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers ; $counter++) {
       
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
          //check the user password.
            $userString = file_get_contents("db/users/".$currentUser);
            $userObject = json_decode($userString);
            $passwordFromDB = $userObject->password;

            $passwrodFromUser = password_verify($password, $passwordFromDB);
            
            if($passwordFromDB == $passwrodFromUser){
				//last login capture
				file_put_contents("db/login/". $email . ".json", json_encode(['last_login' => $lastlog]));

                //redirect to dashboard
                $_SESSION['first_name'] = $userObject->first_name;
                $_SESSION['last_name'] = $userObject->last_name;
                $_SESSION['department'] = $userObject->department;
                $_SESSION['email'] = $userObject->email;
                $_SESSION['reg_date'] = $userObject->reg_date;
                $_SESSION['loggedIn'] = $userObject->id;
                $_SESSION['designation'] = $userObject->designation;

                if ($_SESSION['designation'] == "Patient"){
                    header("Location: dashboard.php");
                }else{
                    header("Location: staffboard.php");
                }
                
                die();
            }
          
        }        
        
    }

    $_SESSION["error"] = "Invalid Email or Password";
    header("Location: login.php");
    die();

}
