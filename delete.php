<!doctype html>
<html>
<head>
    <?php include "navbar.php" ; 
include "db_mbpj.php" ; ?>
    
<meta charset="utf-8">
<title>Rekod Komputer MBPJ</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
  
</head>

<body>

  <style type="text/css">
    a:hover{
      text-decoration: none ; 
    }

    th, td {
      text-align: center;
    }
  </style>

  <?php
    $siri = $_GET['siri'];
    // Connection to the server and datbase
    $dbc = mysqli_connect ("localhost","root","","MBPJ");
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql = "SELECT * FROM pc WHERE No_siri = '$siri' ";
    $result = mysqli_query($dbc,$sql);
    // to display the details error
    if (false === $result)
    {
       echo mysql_error();
    }
    $row = mysqli_fetch_assoc($result)  
  ?>

  <div class="container">
    <br><br>
    <h1><p id="main" align="center"><a href="main.php"><font color = #0b7dda size="20" style="font-family: 'Arial Black'">REKOD KOMPUTER MBPJ</font></a></p></h1>
    <br>
            <form class="form-horizontal" action="deleteprocess.php?siri=<?php echo $siri; ?>" method="POST">
              <div class="modal-header">
                    <h4 class="modal-title"><font size="6px"><b>Adakah anda pasti ingin melupuskan rekod ini?</b></font></h4>
                </div>
                        <label for="siri" class="col-form-label">No. Siri</label>
                        <input class="form-control" type="text" name="siri" id = "siri" value = '<?php echo $row['No_siri']; ?>' disabled>
                    <br>

                    <div class="modal-footer">
                    <a href="mainpage.php" type="button" class="btn btn-info">Kembali</a>
                   <button type="submit" class="btn btn-danger mb-2">Lupus</button>
      </form>

 </div>       
  

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>

</body>
</html>