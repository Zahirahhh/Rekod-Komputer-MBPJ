<?php

//define all required information
$hostname = "localhost";
$username = "root";
$password = "";
$dbname ="mbpj";

//create a connection with mySQL
$connect = mysqli_connect($hostname, $username, $password, $dbname) ;
if(!$connect){
	die("Connection failed : " . mysql_error()); 
	echo "not connected";
}

            //if cannot connect to mySQL and database connect be selected, error is displayed


?>