<!doctype html>
<html>
<head>
    <?php include "navbarstaff.php" ; 
include "db_mbpj.php" ; ?>
    
<meta charset="utf-8">
<title>Rekod Komputer MBPJ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="home.css">
    
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    
	
</head>

<body>

	<style type="text/css">
		html {
			scroll-behavior: smooth ; 
		}

		a:hover{
			text-decoration: none ; 
		}

		th, td {
			text-align: center;
		}

	</style>

	<div class="container">
		<br><br>
		<h1><p id="main" align="center"><a href="home.php"><font color = #0b7dda size="20" style="font-family: 'Arial Black'">REKOD KOMPUTER MBPJ</font></a></p></h1>
		<br>
     
          	<form class="form-horizontal" action="#" method="post">
			  <div class="form-group row">
			    <label for="lokasi" class="col-sm-10 col-form-label">Lokasi: </label>
			    <div class="col-sm-10">
			      <select id="lokasi" name="lokasi" class="form-control">
			           <option value="0">Lokasi:</option>
			           <option value="Bangunan">Bangunan Annex</option>
			           <option value="Cawangan">Cawangan</option>
			           <option value="HQ">HQ MBPJ</option>
			            <option value="Menara">Menara MBPJ</option>
			           </select>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="bahagian" class="col-sm-10 col-form-label">Jabatan / Bahagian  /Unit:</label>
			    <div class="col-sm-10">
			      <select id="bahagian" name="bahagian" class="form-control">
                    		<option value="0">Jabatan/Bahagian/Unit</option>
                  	</select>
			    </div>
			  </div>

			  <div class="form-group row">
			       <label for="search" class="col-sm-10 col-form-label"> No. Jenama / No. Siri / Nama Komputer / Jenis Perkakasan / Sistem Operasi / No. Pekerja: </label>
			        <div class="col-sm-10">
			          	<input type="text" name="search" class="form-control" id="search" placeholder="Cari...."> <br>
			          	<button type="submit" name="submit" class="btn btn-primary">CARI</button>
			        </div>
			  </div>      		
			</form>


				
	  <?php 
              if (isset($_POST["search"]))
              {
              	$lokasi = $_POST["lokasi"] ; 
              	$bahagian = $_POST["bahagian"] ;
              	$search = $_POST["search"] ;
              		
              	if ($_POST["lokasi"] == '0')
              	{
		            $sql = mysqli_query ($connect, "Select DISTINCT * FROM (SELECT * FROM pc WHERE Brand_id like '%$_POST[search]%' UNION ALL SELECT * FROM pc WHERE No_siri like '%$_POST[search]%' UNION ALL SELECT * FROM pc WHERE Nama_kom like '%$_POST[search]%' UNION ALL SELECT * FROM pc WHERE Jenis like '%$_POST[search]%' UNION ALL SELECT * FROM pc WHERE Sistem like '%$_POST[search]%' UNION ALL SELECT * FROM pc WHERE No_pekerja like '%$_POST[search]%') carian ORDER BY carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>

		                	<div class="row">
		                		<table class = "table table-striped table-hover">
		                			<thead>
					                	<tr>
					               		<td></td>
					               		<td></td>
					                	<td></td>
						                <td>Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
						                <td></td> 
						                <td></td>
						                <td></td>
						                <td></td>
								        </tr>
								    </thead>
								</table>
							</div>
		              		
		          <?php }

		              else { ?>

		              <div class="row"> 
		                <table class = "table table-striped table-hover">
		                  <thead>
			                  <tr>
			                  <th> No. Jenama</th>
			                  <th> No. Siri</th>
			                  <th> Nama Komputer </th>
			                  <th> Jenis Perkakasan</th>
			                  <th> Sistem Operasi</th>
			                  <th> No. Pekerja </th>
			                  <th> Tindakan </th>
			                  </tr>  
			              </thead>
		   				<tbody>	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
				        </tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
                        <?php } ?>
		     <?php } ?>

		     		     </tbody>
		                </table>
		                <div class = "alert alert-info" style="position:relative; left:950px; top:2px">
								    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
								</div>
								<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
								<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
		            </div>
            <?php }
            else if ($_POST["lokasi"] == 'HQ')
              	{
                
              		if ($_POST["bahagian"] == '0')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' 
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' 
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' 
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' 
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
								                 	
						              <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>							              		
				          <?php }

				              else { ?>	

		              <div class="row"> 
		                <table class = "table table-striped table-hover">
		                  <thead>
			                  <tr>
			                  <th> No. Jenama</th>
			                  <th> No. Siri</th>
			                  <th> Nama Komputer </th>
			                  <th> Jenis Perkakasan</th>
			                  <th> Sistem Operasi</th>
			                  <th> No. Pekerja </th>
			                  <th> Tindakan </th>
			                  </tr>  
			              </thead>
		   				<tbody>	 

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
				              	$pekerja = $row["No_pekerja"] ;
				              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
				        </tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

		                           </tbody>
									</table>
									<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
									    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
									</div>
									<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
									<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
								</div>

				     <?php }  ?>
				  
              		<?php }

              		else if ($_POST["bahagian"] == 'HQ01')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ01'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ01'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ01'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ01'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ01'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ01') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
				              		
				          <?php }

				              else { ?>

				               <div class="row"> 
		                		<table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
				              	$pekerja = $row["No_pekerja"] ;
				              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
				        </tr>
		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>		                 
		                        <?php } ?>

		                        </tbody>
						</table>
						<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
						    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
						</div>
						<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
						<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
					</div>
 
				     <?php }    ?>
              <?php }

              		else if ($_POST["bahagian"] == 'HQ02')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ02'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ02'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ02'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ02'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ02'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ02') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>				              		
				          <?php }

				              else { ?>
    
				               <div class="row"> 
		                <table class = "table table-striped table-hover">
		                  <thead>
			                  <tr>
			                  <th> No. Jenama</th>
			                  <th> No. Siri</th>
			                  <th> Nama Komputer </th>
			                  <th> Jenis Perkakasan</th>
			                  <th> Sistem Operasi</th>
			                  <th> No. Pekerja </th>
			                  <th> Tindakan </th>
			                  </tr>  
			              </thead>
		   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>			      
              <?php }

              		else if ($_POST["bahagian"] == 'HQ03')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ03'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ03'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ03'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ03'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ03'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ03') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
				              		
				          <?php }

				              else { ?>	

				               <div class="row"> 
		                		<table class = "table table-striped table-hover">
		                 		 <thead>
				                  <tr>
				                  <th> No. Jenama</th>
				                  <th> No. Siri</th>
				                  <th> Nama Komputer </th>
				                  <th> Jenis Perkakasan</th>
				                  <th> Sistem Operasi</th>
				                  <th> No. Pekerja </th>
				                  <th> Tindakan </th>
				                  </tr>  
				              </thead>
			   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>
              	<?php	}

              		else if ($_POST["bahagian"] == 'HQ04')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ04'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ04'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ04'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ04'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ04'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ04') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


				              		
				          <?php }

				              else { ?>	  

				               <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>       

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>
            
				<?php	}

						else if ($_POST["bahagian"] == 'HQ05')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ05'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ05'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ05'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ05'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ05'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ05') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


				              		
				          <?php }

				              else { ?>	

				               <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>
              		<?php }

              		else if ($_POST["bahagian"] == 'HQ06')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ06'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ06'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ06'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ06'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ06'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ06') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
	 								<div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
				          <?php }

				              else { ?>	 

						     <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>   
				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
					             
				     <?php } ?>
                    		<?php }

					              		else if ($_POST["bahagian"] == 'HQ07')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ07'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ07'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ07'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ07'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ07'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ07') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
				              		
				          <?php }

				              else { ?>

				               <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>

				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>

              		<?php }

              		else if ($_POST["bahagian"] == 'HQ08') 
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ08'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ08'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ08'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ08'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ08'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ08') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


				          <?php }

				              else { ?>

				                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>        
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>             
				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="rssight"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>
              		<?php }

              		else if ($_POST["bahagian"] == 'HQ09')
              		{
              				$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ09'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ09'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'HQ MBPJ'  AND dept.DeptID = 'HQ09'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ09'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ09'
				            	UNION ALL 
				            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'HQ MBPJ' AND dept.DeptID = 'HQ09') carian 
				            	order by carian.Brand_id") ; 
				            

				                if (mysqli_num_rows($sql) == 0)
				                { ?>
				                	
				                 	 <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
				                 	<tr>
				               		<td></td>
				               		<td></td>
				                	<td></td>
					                <td>Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
					                <td></td> 
					                <td></td>
					                <td></td>
					                <td></td>
							        </tr>
							    </thead>
							</table>
						</div>
				              		
				          <?php }

				              else { ?>	 

				                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
				  		<?php           
				               // to display data by rows
				              foreach ($sql as $row) {
				              	
				              	$siri = $row["No_siri"] ; 
				              	$pekerja = $row["No_pekerja"] ;
				              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>
		                 
		                        <?php } ?>
				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative;top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
				     <?php } ?>
    
              		<?php }
				        
              	}

              	else if ($_POST["lokasi"] == 'Menara')
             {
             	if($_POST["bahagian"] == '0')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                		<div class="row"> 
						            <table class = "table table-striped table-hover">
						               <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {    			
		              	
		                $siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>                   
				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
    
		     <?php } ?>
       <?php
             	}

             	else if($_POST["bahagian"] == 'MN01')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN01') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>

             	<?php }

             	else if($_POST["bahagian"] == 'MN02')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN02') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		           					<div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		          <?php }

		              else { ?>	
		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?> 

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>  
		     <?php } ?>
                      <?php
             	}

             	else if($_POST["bahagian"] == 'MN03')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN03') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	 

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?> 

                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>   
		     <?php } ?>
                              
			 <?php
             	}

             	else if($_POST["bahagian"] == 'MN04')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN04') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>		              		
		          <?php }

		              else { ?>	  

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                    
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		                
		     <?php } ?>
                <?php
             	}

             	else if($_POST["bahagian"] == 'MN05')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN05') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>	              		
		          <?php }

		              else { ?>	  

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                    
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                    <?php
             	}

             	else if($_POST["bahagian"] == 'MN06')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN06') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>	  

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                    
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                       <?php
             	}

             	else if($_POST["bahagian"] == 'MN07')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN07') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                             	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		                
		     <?php } ?>
                               <?php
             	}

             	else if($_POST["bahagian"] == 'MN08')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN08') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		     						<div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>

		     <?php } ?>
                               <?php
             	}

             	else if($_POST["bahagian"] == 'MN09')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN09') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                        
			<?php
             	}

             	else if($_POST["bahagian"] == 'MN10')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN10') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>


				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		                
		     <?php } ?>
                          <?php
             	}

             	else if($_POST["bahagian"] == 'MN11')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN11') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN12')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN12') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	  <?php
             	}

             	else if($_POST["bahagian"] == 'MN13')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN13') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN14')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN14') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	  <?php
             	}

             	else if($_POST["bahagian"] == 'MN15')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN15') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		                
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN16')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN16') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN17')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN17') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN18')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN18') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN19')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN19') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                              
				     	 <?php
             	}

             	else if($_POST["bahagian"] == 'MN20')
             	{
             		$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20MN20' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Menara MBPJ' AND dept.DeptID = 'MN20') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
		     <?php } ?>
                    <?php
             	}
             }

             else if ($_POST["lokasi"] == 'Bangunan')
              	{
              		if($_POST["bahagian"] == '0')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                	
			                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


			              		
			          <?php }

			              else { ?>	  

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                    
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                 
	                        <?php } ?>
	                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
			                
			     <?php } ?>
                                  
				     	  <?php
              		}

              		else if($_POST["bahagian"] == 'BA01')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA01') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                	
			                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>			              		
			          <?php }

			              else { ?>	

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                 
	                        <?php } ?>
	                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
			     <?php } ?>
                                  
				     	 <?php
              		}

              		else if($_POST["bahagian"] == 'BA02')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02'  
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA02') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                	
			                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


			              		
			          <?php }

			              else { ?>

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                        <?php } ?>


				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>

			     <?php } ?>
                         <?php
              		}

              		else if($_POST["bahagian"] == 'BA03')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03'  
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA03') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                	
			                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>			              		
			          <?php }

			              else { ?>

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                 
	                        <?php } ?> 

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
			     <?php } ?>
                     <?php
              		}

              		else if($_POST["bahagian"] == 'BA04')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04'  
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA04') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


			          <?php }

			              else { ?>	

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                 
	                        <?php } ?>
	                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
			     <?php } ?>
                                  
				     	 <?php
              		}

              		else if($_POST["bahagian"] == 'BA05')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05' 
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05'
			            	UNION ALL 
			            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Bangunan Annex' AND dept.DeptID = 'BA05') carian 
			            	order by carian.Brand_id") ; 
			            

			                if (mysqli_num_rows($sql) == 0)
			                { ?>
			                	
			              <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>			              		
			          <?php }

			              else { ?>	 

			                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
			  		<?php           
			               // to display data by rows
			              foreach ($sql as $row) {
			              	
			              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

	                 
	                        <?php } ?>
	                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
			                
			     <?php }?>
                                  
				     	<?php
              		}
              	}

              	 else if ($_POST["lokasi"] == 'Cawangan')
              	{
              		if ($_POST["bahagian"] == '0')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
								 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>	
		          <?php }

		              else { ?>	 

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
		                
		     <?php } ?>
                     <?php
              	}

              	else if ($_POST["bahagian"] == 'CW01')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW01') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		               <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 

		     <?php } ?>
                        <?php
              		}

              		else if ($_POST["bahagian"] == 'CW02')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW02') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?> 
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>       
		     <?php }  ?>
                              
				     	<?php
              		}

              		else if ($_POST["bahagian"] == 'CW03')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW03') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
		     <?php } ?>
                              
				     	<?php
              		}

              		else if ($_POST["bahagian"] == 'CW04')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW04') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
		     <?php } ?>
                       <?php
              		}

              		else if ($_POST["bahagian"] == 'CW05')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW05') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	  <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                               <?php
              		}

              		else if ($_POST["bahagian"] == 'CW06')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW06') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		          					 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?> 
                        </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>   
		     <?php } ?>
                              
				     	 <?php
              		}

              		else if ($_POST["bahagian"] == 'CW07')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW07') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		              		
		          <?php }

		              else { ?>	  

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                    
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
  
		     <?php } ?>
                              
				     	<?php
            }

              		else if ($_POST["bahagian"] == 'CW08')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW08') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>
		          <?php }

		              else { ?>	 

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                     
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>

				     	 </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>
		     <?php } ?>
                    <?php
              		}

              		else if ($_POST["bahagian"] == 'CW09')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW09') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		 							<div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>


		              		
		          <?php }

		              else { ?>

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					             	                         
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?>
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div> 
		     <?php } ?>
                              
				     	<?php
              		}

              		else if ($_POST["bahagian"] == 'CW10')
              		{
              			$sql = mysqli_query ($connect, "select DISTINCT * from (SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Brand_id like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_pekerja like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.No_siri like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.No_pekerja = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Sistem like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10' 
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Nama_kom like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10'
		            	UNION ALL 
		            	SELECT pc.Brand_id,pc.No_siri,pc.Nama_kom,pc.Jenis,pc.Sistem,pc.No_pekerja FROM pc,staff,dept WHERE pc.Jenis = staff.No_pekerja AND staff.DeptID = dept.DeptID AND pc.Jenis like '%$_POST[search]%' AND dept.location = 'Cawangan' AND dept.DeptID = 'CW10') carian 
		            	order by carian.Brand_id") ; 
		            

		                if (mysqli_num_rows($sql) == 0)
		                { ?>
		                	
		                 	 	 <div class="row"> 
						                <table class = "table table-striped table-hover">
						                  <thead>
							                  <tr>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  <td> Harap Maaf! Carian anda tidak dijumpai. Sila cuba lagi. </td>
							                  <td></td>
							                  <td></td>
							                  <td></td>
							                  </tr>  
							              </thead>	
							              </table>
							              </div>		              		
		          <?php }

		              else { ?>	

		                  <div class="row"> 
				                <table class = "table table-striped table-hover">
				                  <thead>
					                  <tr>
					                  <th> No. Jenama</th>
					                  <th> No. Siri</th>
					                  <th> Nama Komputer </th>
					                  <th> Jenis Perkakasan</th>
					                  <th> Sistem Operasi</th>
					                  <th> No. Pekerja </th>
					                  <th> Tindakan </th>
					                  </tr>  
					              </thead>
				   				<tbody>
		   					                                      
		  		<?php           
		               // to display data by rows
		              foreach ($sql as $row) {
		              	
		              	$siri = $row["No_siri"] ; 
		              	$pekerja = $row["No_pekerja"] ;
		              	$brand = $row["Brand_id"] ; 
		              ?>
		     			
		                <tr>
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $brand; ?>"><?php echo $row["Brand_id"] ?></button></td>
		                <td><?php echo $siri ?></td>
		                <td><?php echo $row["Nama_kom"] ?></td>
		                <td><?php echo $row["Jenis"] ?></td>
		                <td><?php echo $row["Sistem"] ?></td> 
		                <td><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#<?php echo $pekerja; ?>"><?php echo $row["No_pekerja"] ?></button></td>
		                <td><a href = "updatestaff.php?siri=<?php echo $siri ?>"type="button" class="btn btn-warning"><font size="3"><i class = "fa fa-edit"> Kemas Kini</i></font></a></td>
		           		</tr>

		           		<div class="modal fade" id="<?php echo $pekerja;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Pekerja</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Pekerja</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_pekerja']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Nama Penuh</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT NAMA_PENUH FROM staff WHERE No_pekerja = '$pekerja'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="pekerja" id = "pekerja" value = '<?php echo $data['NAMA_PENUH']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Jabatan / Bahagian / Unit</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT DeptID FROM staff WHERE No_pekerja = '$pekerja'"); 
										  		  $name=mysqli_query($connect,"SELECT dept.DeptName FROM dept,staff WHERE staff.DeptID = dept.DeptID AND staff.No_pekerja = '$pekerja'"); 


								                    while($data=mysqli_fetch_array($id) AND $info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="dept" id = "dept" value = '<?php echo $data['DeptID']; ?> - <?php echo $info['DeptName']; ?> ' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="<?php echo $brand;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><font size="6px"><b>Maklumat Jenama Komputer</b></font></h4>
									</div>								  
									<div class="modal-body">

										  <div class="form-group">
										  <label for="siri" class="col-form-label">No. Jenama</label>
											<input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['Brand_id']; ?>' disabled>
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Model</label>
										  	
										  	<?php $id=mysqli_query($connect,"SELECT model FROM brand WHERE Brand_id = '$brand'");  

								                    while($data=mysqli_fetch_array($id))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="model" id = "model" value = '<?php echo $data['model']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

										<div class="form-group">
										  <label for="jenis" class="col-form-label">Versi</label>
										  	
										  	<?php $name=mysqli_query($connect,"SELECT version FROM brand WHERE Brand_id = '$brand'"); 


								                    while($info=mysqli_fetch_array($name))
								                    {
								                        ?>
								                       <input class="form-control" type="text" name="version" id = "version" value = '<?php echo $info['version']; ?>' disabled>
							                  <?php  } 
								                ?>
										  
										</div>

									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
									</div>

								  </div>
								</div>
							</div>
						</div>

                 
                        <?php } ?> 
                         </tbody>
							</table>
							<div class = "alert alert-info" style="position:relative; left:950px; top:2px">
							    <p align="right"><b> Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> results</b></p>
							</div>
							<a href="#main" type="button" class="btn btn-primary btn-block">Ke Atas</a>
							<a href="export.php" type="button" class="btn btn-default btn-block btn-lg"><i class="fa fa-print"> Cetak</i></a>
						</div>  
		     <?php } ?>     	
		<?php
              	}
              }
        } ?>

            <script>
    
 $(document).ready(function () {
    $("#lokasi").change(function () {
        var val = $(this).val();
        if (val == "Bangunan") {
            $("#bahagian").html("<option value='0'>Jabatan/Bahagian/Unit:</option><option value='BA01'>BA01 - Bahagian Kewangan dan Parking</option><option value='BA02'>BA02 - Jabatan Kawalan Bangunan 1</option><option value='BA03'>BA03 - Jabatan Kawalan Bangunan 2</option><option value='BA04'>BA04 - Pusat Urusetia Setempat</option><option value='BA05'>BA05 - Unit Aduan</option>");
        } else if (val == "Cawangan") {
            $("#bahagian").html("<option value='0'>Jabatan/Bahagian/Unit:</option><option value='CW01'>CW01 - Arena MBPJ</option><option value='CW02'>CW02 - Jabatan Landskap dan Kehijauan Bandar</option><option value='CW03'>CW03 - Jabatan Penguatkuasa dan Trafik</option><option value='CW04'>CW04 - Klinik Kesihatan MBPJ</option><option value='CW05'>CW05 - Mahkamah Sivil MBPJ</option><option value='CW06'>CW06 - Muzium Petaling Jaya</option><option value='CW07'>CW07 - Pejabat Cawangan, Jalan Pekaka 8 </option><option value='CW08'>CW08 - Perpustakaan Komuniti MBPJ</option><option value='CW09'>CW09 - Pusat Perkembangan Kanak-Kanak MBPJ</option><option value='CW10'>CW10 - Unit Pesuruhjaya Bangunan</option>");
        } else if (val == "HQ") {
            $("#bahagian").html("<option value='0'>Jabatan/Bahagian/Unit:</option><option value='HQ01'>HQ01 - Bahagian Bekalan dan Perolehan</option><option value='HQ02'>HQ02 - Bahagian Pentadbiran dan Urusetia</option><option value='HQ03'>HQ03 - Bahagian Perbelanjaan</option><option value='HQ04'>HQ04 - Unit Perhubungan Awam</option><option value='HQ05'>HQ05 - Jabatan Perancangan Pembangunan</option><option value='HQ06'>HQ06 - Kaunter Utama dan Bahagian Hasil</option><option value='HQ07'>HQ07 - Pejabat Datuk Bandar</option><option value='HQ08'>HQ08 - Unit Keselamatan</option><option value='HQ09'>HQ09 - Unit Teknologi Maklumat</option>");
        } else if (val == "Menara") {
            $("#bahagian").html("<option value='0'>Jabatan/Bahagian/Unit:</option><option value='MN01'>MN01 - Bahagian Mekanikal dan Elektrikal</option><option value='MN02'>MN02 - Bahagian Sumber Manusia</option><option value='MN03'>MN03 - Bahagian Tender dan Kontrak</option><option value='MN04'>MN04 - Jabatan Kejuruteraan 12</option><option value='MN05'>MN05 - Jabatan Kejuruteraan 13</option><option value='MN06'>MN06 - Jabatan Kejuruteraan 14</option><option value='MN07'>MN07 - Jabatan Kejuruteraan 15</option><option value='MN08'>MN08 - Jabatan Kesihatan 9</option><option value='MN09'>MN09 - Jabaatan Kesihatan 10</option><option value='MN10'>MN10 - Jabatan Penguatkuasa dan Keselamatan 1</option><option value='MN11'>MN11 - Jabatan Penguatkuasa dan Keselamatan 2</option><option value='MN12'>MN12 - Jabatan Penguatkuasa dan Keselamatan 4</option><option value='MN13'>MN13 - Jabatan Pengurusan Sisa Pepejal</option><option value='MN14'>MN14 - Jabatan Penilaian dan Pengurusan Harta</option><option value='MN15'>MN15 - Jabatan Perlesenan</option><option value='MN16'>MN16 - Kaunter Menara</option><option value='MN17'>MN17 - Unit Audit</option><option value='MN18'>MN18 - Unit Korporat dan Inovasi</option><option value='MN19'>MN19 - Unit Pusat Kawalan CCTV </option><option value='MN20'>MN20 - Unit Undang-Undang MBPJ</option>");
        }else if (val == "0") {
            $("#bahagian").html("<option value=''>Pilih Jabatan / Bahagian / Unit</option>");
        }
    });
});
 </script>


 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>

</body>
</html>