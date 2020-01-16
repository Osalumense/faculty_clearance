<?php
 // Create a connection to the admintable database and set the encoding 
 DEFINE ('DB_USER', 'root');
 DEFINE ('DB_PASSWORD', ''); 
 DEFINE ('DB_HOST', 'localhost'); 
 DEFINE ('DB_NAME', 'faculty_clearance'); 
 // Make the connection: 
 $dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
 OR die ('Could not connect to MySQL: ' . mysqli_connect_error() ); 
 // Set the encoding... 
 mysqli_set_charset($dbcon, 'utf8'); 