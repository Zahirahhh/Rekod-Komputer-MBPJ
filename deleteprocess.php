<?php 
$siri = $_GET['siri'] ; 
$dbc = mysqli_connect ("localhost","root","","MBPJ") ; 
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: ".mysqli_connect_error() ;
}

$sqldel = "DELETE FROM pc WHERE No_siri = '$siri' " ;
$result = mysqli_query ($dbc,$sqldel) ; 


if ($result)
{
	mysqli_commit($dbc);
	
		Print '<script>alert("Rekod telah berjaya dilupuskan!");</script>';
		Print '<script>window.location.assign("homepage.php");</script>';
}
else
	{
		mysqli_rollback($dbc);
		Print '<script>alert("Rekod tidak berjaya dulupuskan!");</script>';
		Print '<script>window.location.assign("homepage.php");</script>';
	}
