<?php include_once('../lib/header.php'); ?>
<?php 

	// check for form submission
	if (isset($_POST['submit'])) {

		$errors = array();

		
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}

		if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
			$errors[] = 'Password is Missing / Invalid';
		}

		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];

			if ($email == 'admin' && $password == 'admin') {
				// valid user found
				$user = mysqli_fetch_assoc($result_set);
				//$_SESSION['id'] = 100;
				$_SESSION['first_name'] = 'Super Admin';
				// redirect to users.php
				header('Location: superadmin_dashboard.php');
			} else {
				// user name and password invalid
				$errors[] = 'Invalid Username / Password';
			}
		}
	}
?>

	<div class="login">
<h2><a href="../">User area</a></h2>
		<form action="index.php" method="post">
			
			<fieldset>
				<legend><h1>SUPER ADMIN ACCESS ONLY</h1></legend>

				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">Invalid Username / Password</p>';
					}
				?>

				<?php 
					if (isset($_GET['logout'])) {
						echo '<p class="info">You have successfully logged out from the system</p>';
					}
				?>

				<p>
					<label for="">Username:</label>
					<input type="text" name="email" id="" placeholder="Email Address">
				</p>

				<p>
					<label for="">Password:</label>
					<input type="password" name="password" id="" placeholder="Password">
				</p>

				<p>
					<button type="submit" name="submit">Log In</button>
				</p>

			</fieldset>

		</form>		

	</div> <!-- .login -->
</body>
</html>
