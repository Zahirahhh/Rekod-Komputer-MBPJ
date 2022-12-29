<?php
 $siri = $_POST['siri'] ; 
 $jenama = $_POST['jenama']; 
 $com = $_POST['com'];
 $jenis = $_POST['jenis'];
 $sistem = $_POST['sistem'];
 $noPekerja = $_POST['pekerja'];
 $dbc = mysqli_connect ("localhost", "root", "","MBPJ");
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
$sql = "UPDATE `pc` SET `Brand_id`='$jenama',`No_siri`='$siri',`Sistem`='$sistem',`Jenis`='$jenis',`Nama_kom`='$com', `No_pekerja`='$noPekerja' WHERE `No_pekerja`='$noPekerja' ";
 $result = mysqli_query($dbc, $sql);
 if($result)
 {
 mysqli_commit($dbc);
 Print '<script>alert("Data telah berjaya dikemas kini.");</script>';
 Print '<script>window.location.assign("homepage.php");</script>';
 }
 else
 {
 mysqli_rollback($dbc);
 Print '<script>alert("Data tidak berjaya dikemas kini.");</script>';
 Print '<script>window.location.assign("homepage.php");</script>';
 }
?>