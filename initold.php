<?php
   $db=mysqli_connect("jerseyshoreuser.db.3773187.hostedresource.com","jerseyshoreuser","Rockybear13","jerseyshoreuser");
   if (mysqli_connect_errno()){
	   echo 'Database connection failed with following errors: ' . mysqli_connect_error();
	   die();
   }
 ?>