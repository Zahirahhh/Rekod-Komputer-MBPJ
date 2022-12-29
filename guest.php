<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "db_mbpj.php" ; 
	session_start() ; ?>
	
	<title>Log Masuk</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-30 p-b-20">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-20">
						Rekod Komputer MBPJ
					</span>
					<span class="login100-form-title p-b-20">
						Pelawat
					</span>
					<span class="login100-form-avatar">
						<img src="images/logo.png" alt="AVATAR" >
					</span><br><br>
					<center><p>Masukkan guest untuk No.Pekerja dan guest untuk password.</p></center>
					<div class="wrap-input100 validate-input m-t-10 m-b-35" data-validate = "Masukkan 'guest'">
						<input class="input100" type="text" name="pekerja" required="required">
						<span class="focus-input100" data-placeholder="No. Pekerja"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate="Masukkan 'guest'">
						<input class="input100" type="password" name="password" required="required">
						<span class="focus-input100" data-placeholder="Kata Laluan"></span>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name = "submit" value="Log Masuk">
					</div>
				
	<?php
		if (isset($_POST['submit']))
		{
			$count = 0 ; 
			$res = mysqli_query($connect, "SELECT * FROM staff WHERE No_pekerja = 'guest' AND password = 'guest';") ; 
			$count=mysqli_num_rows($res) ; 
			
			if($count>0)
			{
				$_SESSION ['login_user'] = $_POST['pekerja'] ; 
				?> 
					<script type ="text/javascript">
						window.location = "main.php" ; 
					</script>
		
				<?php
			}
			
			else
				?>
					<!--<script type = "text/javascript"> 
						alert ("The username and password doesn't match.") ; 
						window.location = "loginStaff.php" ; 
					</script> -->
			<br>
					<div class = "alert alert-danger">
						<strong> The username and password doesn't match</strong>
					</div>
		<?php
		}
	?>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>