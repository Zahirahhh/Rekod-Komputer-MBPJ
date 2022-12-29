<?php
			include "db_mbpj.php"; 

            $siri = $_POST["No_siri"];
			$brand = $_POST["Brand_id"]; 
			$kom = $_POST["Nama_kom"]; 
			$jenis = $_POST["Jenis"]; 
			$sistem = $_POST["Sistem"];
            $pekerja = $_POST["No_pekerja"]; 
		
			
			    $sql = "INSERT INTO pc (Brand_id, No_siri, Nama_kom, Jenis, Sistem, No_pekerja) 
			    VALUES ('$brand', '$siri', '$kom', '$jenis', '$sistem', '$pekerja')";
                
                $sendsql = mysqli_query($connect, $sql); 


                if($sendsql){
                    mysqli_commit($connect);
                    Print '<script>alert("Pendaftaran Komputer MBPJ telah berjaya!");</script>';
                    Print '<script>window.location.assign("daftarMain.php");</script>';
                }
                else
                {
                    mysqli_rollback($connect);
                    Print '<script>alert("Pendaftaran Komputer MBPJ tidak berjaya!");</script>';
                    //Print '<script>window.location.assign("daftarM.php");</script>';
                }
			
?>