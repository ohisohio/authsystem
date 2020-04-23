<?php session_start();

//Collecting the data

$errorCount = 0;

//Verifying the data, validation

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] :  $errorCount++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] :  $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
//$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] :  $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] :  $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] :  $errorCount++;
$date = date("Y-m-d, h:i:sa");
//$_SESSION['first_name'] = $first_name;
//$_SESSION['last_name'] = $last_name;
//$_SESSION['email'] = $email;
//$_SESSION['gender'] = $gender;
//$_SESSION['designation'] = $designation;
//$_SESSION['department'] = $department;

//$errorArray = [];
$fnerrorempty = $fnerrorlen = $fnerrorstring = "";
$lnerrorempty = $lnerrorlen = $lnerrorlenstr = "";
$emailerrempty = $emailerrlen = $emailerrfmt = "";
$depterr = $designitureerr = $gendererr = "";

if($first_name == " "){
	$fnerrorempty = "Firstname cannot be empty";
	$errorCount++;
}elseif(!empty($first_name) && strlen($first_name) < 3){
	$fnerrorlen = "Firstname must be greater than 2";
	$errorCount++;
}else
//if(!empty($first_name) && is_numeric($first_name) && ctype_alnum($first_name)){
if(!empty($first_name) && preg_match("/^[a-zA-Z]+$/", $first_name) === 0){
	$fnerrorstring = "Firstname requires letters  alone";
	$errorCount++;
}else{
	$_SESSION['first_name'] = $first_name;
}

if($last_name == " "){
	$lnerrorempty = "lasttname cannot be empty";
	$errorCount++;
}elseif(!empty($last_name) && strlen($last_name) < 3){
	$lnerrorlen = "lasttname must be greater than 2";
	$errorCount++;
}else
//if(!empty($last_name) && is_numeric($last_name)  && ctype_alnum($first_name)){
if(!empty($last_name) && preg_match("/^[a-zA-Z]+$/", $last_name) === 0){
	$lnerrorlenstr = "lasttname requires string alone";
	$errorCount++;
}else{
	$_SESSION['last_name'] = $last_name;
}

if($email == ""){
	$emailerrempty = "Email cannot be empty";
	$errorCount++;
}elseif(!empty($email) && strlen($email) < 5){
	$emailerrlen = "Email must be greater than 5";
	$errorCount++;
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  	$emailerrfmt = "Invalid email format";
	$errorCount++;
}else{
	$_SESSION['email'] = $email;
}

if(empty($password)){
	$passworderr = "Password cannot be empty";
	$errorCount++; 
}

if(empty($gender)){
	$gendererr = "Select a gender";
	$errorCount++;
}else{
	$_SESSION['gender'] = $gender;
}	

if(empty($designation)){
	$designitureerr = "Select a designation";
	$errorCount++;
}else{
	$_SESSION['designation'] = $designation;
}

if(empty($department)){
	$depterr = "Select a department";
	$errorCount++;
}else{
	$_SESSION['department'] = $department;
}

if($errorCount > 0){

    /* $session_error = "You have " . $errorCount . " error";
    
    if($errorCount > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    $_SESSION["error"] = $session_error ;*/
	$_SESSION["fnerrorempty"] = $fnerrorempty;
	$_SESSION["fnerrorlen"] = $fnerrorlen ;
	$_SESSION["fnerrorstring"] = $fnerrorstring;
	
	$_SESSION["lnerrorempty"] = $lnerrorempty;
	$_SESSION["lnerrorlen"] = $lnerrorlen;
	$_SESSION["lnerrorlenstr"] = $lnerrorlenstr;
	
	$_SESSION["emailerrempty"] = $emailerrempty;
	$_SESSION["emailerrlen"] = $emailerrlen;
	$_SESSION["emailerrfmt"] = $emailerrfmt;
	
	$_SESSION["passworderr"] = $passworderr;
	
	$_SESSION["gendererr"] = $gendererr;
	
	$_SESSION["designitureerr"] = $designitureerr;
	
	$_SESSION["depterr"] = $depterr;
    header("Location: register.php");

}else{

    //count all users
    $allUsers = scandir("db/users/"); //return @array (2 filled)

    $countAllUsers = count($allUsers);

    $newUserId = ($countAllUsers-1);

    $userObject = [
        'id'=>$newUserId,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=> password_hash($password, PASSWORD_DEFAULT), //password hashing
        'gender'=>$gender,
        'designation'=>$designation,
        'department'=>$department,
		'reg_date' => $date
    ];

    //Check if the user already exists.
 
    for ($counter = 0; $counter < $countAllUsers ; $counter++) {
        
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
            $_SESSION["error"] = "Registration Failed, User already exits ";
            header("Location: adduser.php");
            die();
        }
        
    }
    //save in the database;
    file_put_contents("db/users/". $email . ".json", json_encode($userObject));
    $_SESSION["message"] = "New User Successfully Registered by Admin " . $first_name;
    header("Location: admin/superadmin_dashboard.php");
}

