<?php
	require_once("db_login.inc.php");
	require_once("function.inc.php");
	$error_msg = "";
	if (isset($_POST["username"]) && isset($_POST['password'])) {
		$username = get_safe_value($connection, $_POST["username"]);
		$password = encrypt(get_safe_value( $connection, $_POST["password"]));
		$result = mysqli_query($connection,"select * from admin_user where username='".$username."' and password='".$password."';");
		$row_count = mysqli_num_rows($result);
		if ($row_count != 0) {
			$_SESSION['ADMIN_LOGIN'] = 'yes';
			$_SESSION['ADMIN_USERNAME'] = $username;
			if(isset($_GET['from'])){
				header("location:".$_GET["from"]);
			}else{
				header("location:analytics.php");
			}
			die();
		}else {
			$error_msg = "Your information is wrong!";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Login | Zelab</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/login-style.css">
</head>
<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      			<div class="icon d-flex align-items-center justify-content-center">
		      				<span class="fa fa-user-o"></span>
		      			</div>
		      			<h3 class="text-center mb-4">Sign In</h3>
						<form method="post" class="login-form">
		      				<div class="form-group">
		      					<input type="text" name="username" class="form-control rounded-left" placeholder="Username" required>
		      				</div>
	            			<div class="form-group d-flex">
	            			  	<input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
	            			</div>
	            			<div class="form-group">
	            				<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
	            			</div>
	          			</form>
	            		<p style="margin: 0; padding: 0; height: 1px; color: red;"><?php echo $error_msg; ?></p>
	        		</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php mysqli_close( $connection ); ?>