<?php session_start();

//Collecting the data

$errorCount = 0;

//Verifying the data, validation

$department = $_POST['department'] != "" ? $_POST['department'] :  $errorCount++;
$appdate = $_POST['appdate'] != "" ? $_POST['appdate'] :  $errorCount++;
$time = $_POST['time'] != "" ? $_POST['time'] :  $errorCount++;
$appointmentnature = $_POST['appointmentnature'] != "" ? $_POST['appointmentnature'] :  $errorCount++;
$initialcomplaint = $_POST['initialcomplaint'] != "" ? $_POST['initialcomplaint'] :  $errorCount++;



$_SESSION['appdate'] = $appdate;
$_SESSION['department'] = $department;
$_SESSION['time'] = $time;
$_SESSION['appointmentnature'] = $appointmentnature;
$_SESSION['initialcomplaint'] = $initialcomplaint;
$email = $_POST["email"];
$name = $_POST["first_name"] . " " . $_POST["last_name"];



$appointmentDetails = [
    'name'=>$name,
    'email'=>$email,
    'department'=>$department,
    'appdate' => $appdate,
    'appointmentnature'=>$appointmentnature,
    'time'=>$time,
    'initialcomplaint'=>$initialcomplaint,
    ];

if($errorCount>0){
    $_SESSION["error"] = "You did not fill " .$errorCount. " fields";
    header("Location: bookappointment.php");
}else{
    file_put_contents("db/appointment/". $email . ".json", json_encode($appointmentDetails));
    $_SESSION["message"] = "Appointment Booking Successful ";
    header("Location: dashboard.php");

}

?>