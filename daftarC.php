<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar Komputer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="imagescom/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fontscom/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fontscom/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorcom/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csscom/util.css">
	<link rel="stylesheet" type="text/css" href="csscom/main.css">
<!--===============================================================================================-->
</head>
<style type="text/css">
        
        a.button3{
			 display:inline-block;
			 padding:0.3em 1.2em;
			 margin:0 0.3em 0.3em 0;
			 border-radius:2em;
			 box-sizing: border-box;
			 text-decoration:none;
			 font-family:'Roboto',sans-serif;
			 font-weight:300;
			 font-size: 16px;
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
    
    .contact100-form-btn:hover {
  background-color: #1F6CBD;
}
    
    .select2-container .select2-results__option[aria-selected="true"] {
  background: #1F6CBD;
  color: white;
}
    .select2-container .select2-results__option--highlighted[aria-selected] {
  background: #1F6CBD;
  color: white;
}
    
    </style>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="daftar.php">
				<span class="contact100-form-title">
					<img src="logo.png" alt="Logo" width="110" height="115" float="left"><font size="14">Daftar Komputer MBPJ</font><br>
					<font size="14">Cawangan MBPJ</font>
				</span>

					<div class="wrap-input100 input100-select bg1">
					<span class="label-input100">NOMBOR JENAMA *</span>
					<div>
						<select class="js-select2" name="Brand_id">
							 <?php
                                
                                
                                include "db_mbpj.php";
                                $records = mysqli_query($connect, "SELECT Brand_id FROM brand ORDER BY Brand_id ASC");  // Use select query here 
                             
                                $result = mysqli_query($connect, "SELECT model FROM brand ORDER BY Brand_id ASC");  // Use select query here 
                               
                                $keputusan = mysqli_query($connect, "SELECT version FROM brand ORDER BY Brand_id ASC");  // Use select query here 


                                while($data=mysqli_fetch_array($records) AND  $sql=mysqli_fetch_array($result) AND $maklumat=mysqli_fetch_array($keputusan) )
                                {
                                    $brand = $data['Brand_id'];
                                    
                                    echo "<option value='".$brand."'>" .$data['Brand_id'] ." ". $sql['model']." ".$maklumat['version']."</option>";  // displaying data in option menu
                                }	
                            ?>
                            
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div>

				<div class="wrap-input100 validate-input bg1" data-validate="Please Type Model Desktop">
					<span class="label-input100">NOMBOR SIRI *</span>
					<input class="input100" type="text" name="No_siri">
				</div>
                
                <div class="wrap-input100 validate-input bg1" data-validate="Please Type Serial Number">
					<span class="label-input100">NAMA KOMPUTER *</span>
					<input class="input100" type="text" name="Nama_kom">
				</div>
                
                <div class="wrap-input100 input100-select bg1">
					<span class="label-input100">JENIS *</span>
					<div>
						<select class="js-select2" name="Jenis">
							    <option value="DESKTOP">DESKTOP</option>
							    <option value="LAPTOP">LAPTOP</option>
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div>
        
                 <div class="wrap-input100 input100-select bg1">
					<span class="label-input100">Sistem *</span>
					<div>
						<select class="js-select2" name="Sistem">
							    <option value="WINDOWS XP">WINDOWS XP</option>
							    <option value="WINDOWS 7 32 BITS">WINDOWS 7 32 BITS</option>
							 	<option value="WINDOWS 7 64 BITS">WINDOWS 7 64 BITS</option>
                                <option value="WINDOWS 8">WINDOWS 8</option>
                                <option value="WINDOWS 10">WINDOWS 10</option>
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div>
                
                <div class="wrap-input100 validate-input bg1" data-validate="Please Type Computer Name">
					<span class="label-input100">NOMBOR PEKERJA *</span>
					<input class="input100" type="text" name="No_pekerja">
				</div>
                
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							Daftar
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
				<br><br><br><br>
				<a href="daftarMain.php" class="button3" style="position:relative; left:700px; top:2px">Kembali</a>
			</form>
		</div>
	</div>



<!--===============================================================================================-->
	<script src="vendorcom/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorcom/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorcom/bootstrap/js/popper.js"></script>
	<script src="vendorcom/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorcom/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});


			$(".js-select2").each(function(){
				$(this).on('select2:close', function (e){
					if($(this).val() == "Please chooses") {
						$('.js-show-service').slideUp();
					}
					else {
						$('.js-show-service').slideUp();
						$('.js-show-service').slideDown();
					}
				});
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendorcom/daterangepicker/moment.min.js"></script>
	<script src="vendorcom/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendorcom/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="vendorcom/noui/nouislider.min.js"></script>
	<script>
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 1500, 3900 ],
	        connect: true,
	        range: {
	            'min': 1500,
	            'max': 7500
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]);
	        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
	        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
