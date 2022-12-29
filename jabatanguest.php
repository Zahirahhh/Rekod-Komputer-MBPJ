<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jabatan/Bahagian/Unit</title>
    <?php include "navbarguest.php" ; 
    include "db_mbpj.php"; ?> 
    
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="home.css">
    
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <style type="text/css">
        
		html {
			scroll-behavior: smooth ; 
		}

		a:hover {
			text-decoration: none ;
		}
    
		* {
			  box-sizing: border-box;
			}

			form.example input[type=text] {
			  padding: 10px;
			  font-size: 17px;
			  border: 1px solid grey;
			  float: left;
			  width: 80%;
			  background: #f1f1f1;
				
			}

			form.example button {
			  float: left;
			  width: 20%;
			  padding: 10px;
			  background: #2196F3;
			  color: white;
			  font-size: 17px;
			  border: 1px solid grey;
			  border-left: none;
			  cursor: pointer;
			}

			form.example button:hover {
			  background: #0b7dda;
			}
			
		form.example select {
			float: left;
			  width: 20%;
			  padding: 10px;
			  background: #2196F3;
			  color: white;
			  font-size: 17px;
			  border: 1px solid grey;
			  border-left: none;
			  cursor: pointer;
		}
		
		form.example select:hover {
			  background: #0b7dda;
			}

			form.example::after {
			  content: "";
			  clear: both;
			  display: table;
			}
		
		a.button3{
			 display:inline-block;
			 padding:0.3em 1.2em;
			 margin:0 0.3em 0.3em 0;
			 border-radius:2em;
			 box-sizing: border-box;
			 text-decoration:none;
			 font-family:'Roboto',sans-serif;
			 font-weight:300;
			 color:#FFFFFF;
			 background-color:#4eb5f1;
			 text-align:center;
			 transition: all 0.2s;
			}
			a.button3:hover{
			 background-color:#4095c6;
			}
			@media all and (max-width:30em){
			 a.button3{
			  display:block;
			  margin:0.2em auto;
			 }
			}
		
			.modal-content {
			background-color: #D1D1D1; 
			width: 100% ; 
		}
    
    </style>

<body>
    
    <div class="container">
					
					<br>
					<br>
					<h1><p id="main" align="center"><font color = #0b7dda size="20" style="font-family: 'Arial Black'">REKOD KOMPUTER MBPJ</font></p></h1>
					
					<br><br>
                    <form class="example" method = "post" name="button" style="margin:auto;max-width:1500px">
				    <input type="text" placeholder="Cari.... " name="search" >
                    <select name="kategori">
                        <option value="0">Kategori</option>
                        <option value="jabatan">Jabatan/Bahagian/Unit</option>
                        <option value="lokasi">Lokasi</option>
                    </select>
				    <button type="submit"><i class="fa fa-search"></i></button>	
					</form> 
                    <br>
                    <div class="row">
					<h1><font size="6.8" color="#0b7dda">Jabatan / Bahagian / Unit </font></h1>
					<br>
					<?php 
                        
						if (isset($_POST["search"]))
						{
                            if ($_POST["kategori"] == "0")
                            {
                                $sql = mysqli_query ($connect , "SELECT * FROM dept WHERE DeptName like '%$_POST[search]%' UNION ALL SELECT * FROM dept WHERE location like '%$_POST[search]%'" );
								
									if (mysqli_num_rows ($sql) == 0)
									{
										?>
											<h2 class ="title" align="center"><font style color =#000000>Harap Maaf. Jabatan / Bahagian / Unit tidak dijumpai. Sila cuba lagi! </font></h2>
											<div class = "alert alert-info">
											<p align="right"><b> Jumlah Carian :  <?php echo mysqli_num_rows($sql) ; ?></b></p>
											</div>
											<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
												
											<?php 
									}

									else
									{  // if SQL command is successfully sent
							?>		<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
							<br>
							<br>
									<table class = "table table-striped table-hover">
								<thead>
									<tr>
									<th style="text-align: center">No. Jabatan</th>
									<th style="text-align: center">Jabatan/Bahagian/Unit</th>
									<th style="text-align: center">Lokasi</th>
									</tr>
								</thead>
								<tbody>
									<?php  // to display data by rows
									foreach ($sql as $row){	
										
										 $id=$row['DeptID'];
										 $name=$row['DeptName'];
										 $location=$row['location'] ; 
									?>
										<tr>
										<td align="center"><?php echo $row['DeptID'] ?></td>
										<td align="center"><?php echo $row['DeptName'];?></td>
										<td align="center"><?php echo $row['location'] ?></td>
		                                    <?php } ?>
		                        </table>
							
							<br>

		                            <div class = "alert alert-info">
									<p align="right"><b> <font size="3">Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> </font></b></p>
								</div>
							<br>
								<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a> 
		                            <?php }
		                        }

                   else if ($_POST["kategori"] == "jabatan")
                            {
                                $sql = mysqli_query ($connect , "SELECT * FROM dept WHERE DeptName like '%$_POST[search]%'" );
								
							if (mysqli_num_rows ($sql) == 0)
							{
								?>
									<h2 class ="title" align="center"><font style color =#000000>Harap Maaf. Jabatan / Bahagian / Unit tidak dijumpai. Sila cuba lagi!</font></h2>
									<div class = "alert alert-info">
									<p align="right"><b> Jumlah Carian :  <?php echo mysqli_num_rows($sql) ; ?></b></p>
									</div>
									<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
										
									<?php 
							}

							else
							{  // if SQL command is successfully sent
					?>		<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
					<br>
					<br>
							<table class = "table table-striped table-hover">
						<thead>
							<tr>
							<th style="text-align: center">No. Jabatan</th>
							<th style="text-align: center">Jabatan/Bahagian/Unit</th>
							<th style="text-align: center">Lokasi</th>
							</tr>
						</thead>
						<tbody>
							<?php  // to display data by rows
							foreach ($sql as $row){	
								
								 $id=$row['DeptID'];
								 $name=$row['DeptName'];
								 $location=$row['location'] ; 
							?>
								<tr>
								<td align="center"><?php echo $row['DeptID'] ?></td>
								<td align="center"><?php echo $row['DeptName'];?></td>
								<td align="center"><?php echo $row['location'] ?></td>
                                    <?php } ?>
                        </table>
					
					<br>

                            <div class = "alert alert-info">
							<p align="right"><b> <font size="3">Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> </font></b></p>
						</div>
					<br>
						<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a> 
                            <?php }
                        }

                   	else if ($_POST["kategori"] == "lokasi")
                            {
                                $sql = mysqli_query ($connect , "SELECT * FROM dept WHERE location like '%$_POST[search]%'" );
								
							if (mysqli_num_rows ($sql) == 0)
							{
								?>
									<h2 class ="title" align="center"><font style color =#000000>Harap Maaf. Jabatan / Bahagian / Unit tidak dijumpai. Sila cuba lagi!</font></h2>
									<div class = "alert alert-info">
									<p align="right"><b> Jumlah Carian :  <?php echo mysqli_num_rows($sql) ; ?></b></p>
									</div>
									<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
										
									<?php 
							}

							else
							{  // if SQL command is successfully sent
					?>		<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a>
					<br>
					<br>
							<table class = "table table-striped table-hover">
						<thead>
							<tr>
							<th style="text-align: center">No. Jabatan</th>
							<th style="text-align: center">Jabatan/Bahagian/Unit</th>
							<th style="text-align: center">Lokasi</th>
							</tr>
						</thead>
						<tbody>
							<?php  // to display data by rows
							foreach ($sql as $row){	
								
								 $id=$row['DeptID'];
								 $name=$row['DeptName'];
								 $location=$row['location'] ; 
							?>
								<tr>
								<td align="center"><?php echo $row['DeptID'] ?></td>
								<td align="center"><?php echo $row['DeptName'];?></td>
								<td align="center"><?php echo $row['location'] ?></td>
                                    <?php } ?>
                        </table>
					
					<br>

                            <div class = "alert alert-info">
							<p align="right"><b> <font size="3">Jumlah Carian : <?php echo mysqli_num_rows($sql) ; ?> </font></b></p>
						</div>
					<br>
						<a href="jabatan.php" class="button3" style="position:relative; left:1000px; top:2px">Kembali</a> 
                            <?php }
                        }
                        
                        }

				else {
					
					$sql = " SELECT * FROM dept" ; 
					$sendsql = mysqli_query($connect, $sql);
					
					if($sendsql) {   // if SQL command is successfully sent
					
					?>
					<table class = "table table-striped table-hover">
						<thead>
							<tr>
							<th style="text-align: center">No. Jabatan</th>
							<th style="text-align: center">Jabatan/Bahagian/Unit</th>
							<th style="text-align: center">Lokasi</th>
							</tr>
						</thead>
						<tbody>
							<?php  // to display data by rows
							foreach ($sendsql as $row){	
								
								 $id=$row['DeptID'];
								 $name=$row['DeptName'];
								 $location=$row['location'] ; 
							?>
								<tr>
								<td align="center"><?php echo $row['DeptID'] ?></td>
								<td align="center"><?php echo $row['DeptName'];?></td>
								<td align="center"><?php echo $row['location'] ?></td>
                                    <?php } ?>
                        </table>
                        <br>

                        <div class = "alert alert-info">
							<p align="right"><b> <font size="3">Jumlah Jabatan / Bahagian / Unit : <?php echo mysqli_num_rows($sendsql) ; ?> </font></b></p>
						</div>

                        <a href="#main" class="button3" style="position:relative; left:1000px; top:2px">Ke atas</a>
                        <?php } 
                
                }?>
                        
                        
                </div>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
</body>
</html>
