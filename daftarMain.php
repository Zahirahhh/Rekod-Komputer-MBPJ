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
    
    </style>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">

				
				<span class="contact100-form-title">
					<img src="logo.png" alt="Logo" width="110" height="115" float="left"><font size="14">Daftar Komputer MBPJ </font>
				</span>
				<div style="position:relative; left:100px; top:-4px">
				<a href="daftarA.php" class="button3" style="position:relative; background-color: cornflowerblue">BANGUNAN ANNEX</a>
				<a href="daftarC.php" class="button3" style="position:relative; background-color: darksalmon">CAWANGAN</a>
				<a href="daftarHQ.php" class="button3" style="position:relative; background-color: indianred ">HQ MBPJ</a>
				<a href="daftarM.php" class="button3" style="position:relative; background-color: palevioletred">MENARA MBPJ</a>
			</div>
				<a href="homepage.php" class="button3" style="position:relative; left:40px; top:50px">Kembali</a>
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
	<script src="jscom/main.js"></script>

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
