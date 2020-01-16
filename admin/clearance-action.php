<?php 
ob_start();
require ( '../mysqli_connect.php') ;
session_start(); 
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) 
{ header("Location: ../login");  
exit(); 
}

$id = $_GET['id'];
$action = $_GET['action'];

if($action == 'approve'){
    
    $q="UPDATE clearance_requests SET status='approved', date_approved=NOW() WHERE id='$id'";
    $result = @mysqli_query ($dbcon, $q);
    		echo "<script>alert('Request approved successfully')</script>";
    		 header("Location: clearance-requests");
    
}elseif($action == 'disapprove'){
    
     $q="UPDATE clearance_requests SET status='disapproved', date_approved=NOW() WHERE id='$id'";
    $result = @mysqli_query ($dbcon, $q);
    		echo "<script>alert('Request denied!')</script>";
    		header("Location: clearance-requests");
    
}else{
    
    
}


?>