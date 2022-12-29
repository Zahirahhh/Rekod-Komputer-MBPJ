<!DOCTYPE html>
<html>
<head>

  <?php include "navbar.php" ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" type="text/css" href="home.css">
    
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
  a:hover {
    text-decoration: none;
  }
</style>
</head>
<body>

      <br>
          <br>
          <h1><p id="main" align="center"><a href="main.php"><font color = #0b7dda size="20" style="font-family: 'Arial Black'">REKOD KOMPUTER MBPJ</font></a></p></h1>                               
       <form action="tambahprocess.php" method="post" >
       <div class="container">
       <h1><p align="center">Tambah Jenama Komputer</p></h1>
       <hr>

       <label for="brand"><b> &nbsp&nbsp&nbsp NO JENAMA &nbsp&nbsp: </b></label>
       <input class="form-control" type="text" name="brandID" id="brand"><br><br>
                                    
       <label for="model"><b>&nbsp&nbsp&nbsp MODEL &nbsp&nbsp: </b></label>
       <input class="form-control" type="text" name="model" id="model"><br><br>
                                    
       <label for="version"><b>&nbsp&nbsp&nbsp VERSI &nbsp&nbsp: </b></label>
       <input class="form-control" type="text" name="version" id="version"><br><br>
      
      <a href="brand.php" class="btn btn-primary" style="position:relative; left:935px; top:2px"><font size="3.5">Kembali</font></a>                            
    	<button class="btn btn-success" style="position:relative; left:940px; top:2px"><font size="3.5">Tambah</font></button>
       
       </div>
       </form>

    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
</body>
</html>

