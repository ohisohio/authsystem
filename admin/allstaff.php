<?php
session_start();
?>


<div class="appname">SNG Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
		<div>
		<a href="superadmin_dashboard.php">Return to Dashboard</a></div>
		</div>
<div class="container">
<h3>TABLE OF PATIENT</h3>
<?php

$appointmentrecord = scandir("../db/users/");
$numofappoint = count($appointmentrecord);
$exactcount = $numofappoint - 2;
if ($exactcount == 0){
	echo("<h4>You have no patients</h4>");

}else{

	$temp = "<table class='table'>";
	$temp .= "<tr><th>ID</th>";
	$temp .= "<th>FIRST NAME</th>";
	$temp .= "<th>LAST NAME</th>";
	$temp .= "<th>EMAIL</th>";
	$temp .= "<th>GENDER</th>";
	$temp .= "<th>DEPARTMENT</th>";
	$temp .= "<th>REG DATE</th></tr>";
	




	for ($counter = 0; $counter < $numofappoint ; $counter++) {
   
		$Userfiles = $appointmentrecord[$counter];
	
		if($Userfiles != "." && $Userfiles != ".."){
		  //Retrieve Patients Appointment details
			$userString = file_get_contents("../db/users/".$Userfiles);
			$userDetails = json_decode($userString, TRUE);
		
			$id=$userDetails["id"];
			$first_name=$userDetails["first_name"];
			$last_name=$userDetails["last_name"];
			$email=$userDetails["email"];
			$gender=$userDetails["gender"];
			$designation=$userDetails["designation"];
			$reg_date=$userDetails["reg_date"];
			$dept = $userDetails["department"];
			

//Display only patient information for a department
		if($designation=="Medical Team (MT)"){
		//Display Patients Appointment details
					$temp .="<tr>";
					$temp .= "<td>".$id."</td>";
					$temp .= "<td>".$first_name."</td>";
					$temp .= "<td>".$last_name."</td>";
					$temp .= "<td>".$email."</td>";
					$temp .= "<td>".$gender."</td>";
					$temp .= "<td>".$dept."</td>";
					$temp .= "<td>".$reg_date."</td>";
								$temp .="</tr>";

		}

		
	
}
	}
	$temp .="</table>";

	echo $temp;
	


}


	
?>
