<div class="container">
<h3>TABLE OF PATIENT</h3>
<?php

$appointmentrecord = scandir("db/appointment/");
$numofappoint = count($appointmentrecord);
$exactcount = $numofappoint - 2;
if ($exactcount == 0){
	echo("<h4>You have no pending appointments</h4>");

}else{

	$temp = "<table class='table'>";
	$temp .= "<tr><th>NAME</th>";
	$temp .= "<th>EMAIL</th>";
	$temp .= "<th>DATE</th>";
	$temp .= "<th>TIME</th>";
	$temp .= "<th>NATURE OF APPOINTMENT</th>";
	$temp .= "<th>INITIAL COMPLAINT</th>";
	$temp .= "<th>DEPARTMENT</th></tr>";




	for ($counter = 0; $counter < $numofappoint ; $counter++) {
   
		$Userfiles = $appointmentrecord[$counter];
	
		if($Userfiles != "." && $Userfiles != ".."){
		  //Retrieve Patients Appointment details
			$userString = file_get_contents("db/appointment/".$Userfiles);
			$userDetails = json_decode($userString, TRUE);
		
		
			$name=$userDetails["name"];
			$email=$userDetails["email"];
			$dept=$userDetails["department"];
			$date=$userDetails["appdate"];
			$nature=$userDetails["appointmentnature"];
			$time=$userDetails["time"];
			$comp=$userDetails["initialcomplaint"];

//Display only patient information for a department
		if($_SESSION['department'] == $dept){
//Display Patients Appointment details
			$temp .="<tr>";
			$temp .= "<td>".$name."</td>";
			$temp .= "<td>".$email."</td>";
			$temp .= "<td>".$date."</td>";
			$temp .= "<td>".$time."</td>";
			$temp .= "<td>".$nature."</td>";
			$temp .= "<td>".$comp."</td>";
			$temp .= "<td>".$dept."</td>";
			$temp .="</tr>";
		
	}
}
	}
	$temp .="</table>";

	echo $temp;
	


}


	
?>
