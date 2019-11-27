<?php
// Define database connection constants


$loc = "local";

if ($loc=="local") {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'chemistry');
}
else {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'jerseyshoreuser');
  define('DB_PASSWORD', 'Rockybear13');
  define('DB_NAME', 'jerseyshoreuser');
}

   $db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
   if (mysqli_connect_errno()){
	   echo 'Database connection failed with following errors: ' . mysqli_connect_error();
	   die();
   }
?>
