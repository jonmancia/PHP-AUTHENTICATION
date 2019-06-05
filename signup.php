<?php

$db = pg_connect("host=localhost dbname=myDb");
$errorPassword;
// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!isset($_POST['firstName']) && !isset($_POST['lastName']) && !isset($_POST['email']) && !isset($_POST['pass'])) {
		header("Location: index.php");
	} else {
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$userPassword = $_POST['pass'];
		$lengthOfPassword = strlen($userPassword);
		if (preg_match('/[a-zA-Z]*[0-9]+/', $userPassword) && $lengthOfPassword > 6) {
			$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			$usersInsertQuery = pg_query_params($db, "INSERT INTO users (user_fname, user_lname, user_email, user_password) VALUES ($1, $2, $3, $4)", array($firstName, $lastName, $email, $password));
			header("Location: index.php");
		} else {
			$errorPassword = "Password must be 7 characters long and must contain a number";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
	<script src="index.js"></script>
	<title>PHP Hackz - Login</title>
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<span class="login100-form-title p-b-26">
						Sign Up Here
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter a valid name">
						<input class="input100" type="text" name="firstName">
						<span class="focus-input100" data-placeholder="First Name"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter a valid name">
						<input class="input100" type="text" name="lastName">
						<span class="focus-input100" data-placeholder="Last Name"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" id="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Confirm password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="confirmpass" id="confirmPassInput">
						<span class="focus-input100" data-placeholder="Confirm Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<h6 style="color: red;"><?php echo "*$errorPassword" ?></h6>
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Sign Up
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Already have an account?
						</span>

						<a class="txt2" href="index.php">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>

</html>