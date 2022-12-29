<?php
		include "db_connect.php";
	
		//create connection with sql
	
		$StudId = $_GET["StudId"];
		$name = $_GET["name"];
		$email = $_GET["email"];
		$phone = $_GET["phone"];
		$ref = $_GET["ref"];
		$server = $_GET["server"];
	
		$sql = "INSERT INTO student (StudId, name, email, phone, ref, server)
			VALUES ('$StudId', '$name', '$email', '$phone', '$ref', '$server')";
			
		//send sql command to mysql using db connection
		$sendsql = mysqli_query($connect, $sql);
	
		//check if sql command has been succesfully sent
		if($sendsql)
		{
			echo "Your form has been submitted.";
			echo "Thank you for participating!";
			echo "<a href=student_info2.php>CLICK HERE</a>";
		}
		else
			echo "Query failed";
?>
