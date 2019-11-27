<?php

// Define database connection constants


$loc = "local";

if ($loc=="local") {

   $db=mysqli_connect("localhost","root","","chemistry");
   if (mysqli_connect_errno()){
	   echo 'Database connection failed with following errors: ' . mysqli_connect_error();
	   die();
   }
}
else {

   $db=mysqli_connect("localhost","root","","jerseyshoreuser");
   if (mysqli_connect_errno()){
	   echo 'Database connection failed with following errors: ' . mysqli_connect_error();
	   die();
   }
}


 ?>