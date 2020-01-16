<?php
require ('mysqli_connect.php');
session_start();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['username'])) {
          $u = mysqli_real_escape_string($dbcon, $_POST['username']);
        } else {
          $u = FALSE;
          echo '<div class="alert alert-danger"><i class="fa fa-warning" aria-hidden="true"></i> Enter your username</div>';
        }

        if (!empty($_POST['password'])) {
          $p = mysqli_real_escape_string($dbcon, $_POST['password']);
        } else {
            $p = FALSE;
            echo '<div class="alert alert-danger"><i class="fa fa-warning" aria-hidden="true"></i> Enter your Password</div>';
        }

        if ($u){
            $q = "SELECT user_id, user_level, username, surname, first_name, other_names, password FROM users WHERE (username='$u' AND password='$p')";
            $result = mysqli_query ($dbcon, $q);
          if (@mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
            $_SESSION['user_level'] = (int) $_SESSION['user_level'];

            $q = "SELECT user_level, username, password FROM users WHERE (username='$u' AND password='$p')";
            $result = mysqli_query ($dbcon, $q);
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $l=$row['user_level'];
                    if ($l == 3){
                      header("Location: admin/users");
                      }elseif($l == 1){
                            header("Location: admin/clearance-requests");
                      }elseif($l == 0){
                            header("Location: index");
                      } 
                }
                mysqli_free_result($result);
                mysqli_close($dbcon);
          } else {
            $Err = '<h2 class="form-login-danger">Wrong Login Details</h2>';
            }
          }
  } // End of SUBMIT conditional.
  ?>
  
  
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Faculty Clearance</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <style>
    #header {
        background-color:#095959;
        color:white;
        text-align:center;
        padding:5px;
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
	  <div id="header">
<h1>Physical Science Faculty Clearance</h1>
     </div>

	 <div id="login-page">
	  	<div class="container">
        
		      <form class="form-login" action="login" method="post">
		        <?php if(isset($Err)){echo $Err;}else{ echo'<h2 class="form-login-heading"><img src="assets/img/download.png" height="40px" width="40px">    SIGN IN</h2>';}?>
		        <div class="login-wrap">
		            <input type="text" name="username" class="form-control" placeholder="Username" autofocus required>
		            <br>
		            <input type="password" name="password" class="form-control" placeholder="Password" required><br>
		            <?php if(isset($Err)){echo '<button class="btn btn-danger btn-block" type="submit" name="submit"><i class="fa fa-lock"></i> SIGN IN</button>';}else{
                    echo'<button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>';}?>
		        </div>
		      </form>

	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <!--<script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 5000});
    </script>-->
 <script>
        $.backstretch("assets/img/image3.jpeg", {speed: 5000});
    </script>

  </body>
</html>
