<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="imagesnavbar/icons/favicon.ico"/>
	
	
	<style type ="text/css">
			
		ul{
			list-style-type: none;
			margin: 0 ; 
			padding: 0 ;
			left : 0px;
			overflow: hidden ; 
			background-color: gray ;
			position: fixed ; 
			top: 0 ; 
			width: 100% ; 
		}
		
		li {
			display: inline ; 
			float: left ; 
		}
		
		li a {
			display: block ; 
			color: white ; 
			text-align: center ; 
			padding: 14px 16px ; 
			text-decoration: none ;
		}
		
		li a:hover:not(.active) {
			background-color: #E0DBDC ;
		}
		
		.active {
			background-color: #39AFD3 ; 
		}
	</style>
</head>

<body>

    <ul>
      <li><a class = "active" href = "homepage.php">Laman Utama</a></li>
     <li><a href = "jabatan.php">Bahagian/Jabatan/Unit</a></li>
     <li><a href = "brand.php">Jenama Komputer</a></li>
      <li><a href = "daftarMain.php">Daftar Komputer</a></li>
	<li style="float: right"><a href = "buttonLogin.php">Log Keluar</a></li>
     </ul>

	
</body>
</html>
