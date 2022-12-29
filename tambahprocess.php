<?php
			include "db_mbpj.php"; 

			$brand = $_POST["brandID"]; 
			$model = $_POST["model"];
			$version = $_POST["version"]; 
		
			 $sql = "INSERT INTO brand (Brand_id, model, version) 
			 VALUES ('$brand', '$model','$version')";

             $sendsql = mysqli_query($connect, $sql); 


             if($sendsql){
                mysqli_commit($connect);
                Print '<script>alert("Telah berjaya!");</script>';
                Print '<script>window.location.assign("brand.php");</script>';
             }
             else
             {
                mysqli_rollback($connect);
                Print '<script>alert("Tidak berjaya!");</script>';
                Print '<script>window.location.assign("tambah.php");</script>';
             }

?>