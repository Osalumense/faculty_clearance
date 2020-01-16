<?php
ob_start();
require ( '../mysqli_connect.php' ) ;
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 3))
{ header("Location: ../login");
exit();
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
  $errors = array();

if (empty($_POST['surname'])) {
    $errors[] = 'error';
 $surnameErr = 'You forgot to enter surname.';
 } else
 {$surname = mysqli_real_escape_string($dbcon, ($_POST['surname']));}

 if (empty($_POST['first_name'])) {
    $errors[] = 'error';
 $first_nameErr = 'You forgot to enter First name.';
 } else
 {$first_name = mysqli_real_escape_string($dbcon, ($_POST['first_name']));}

  if (empty($_POST['other_name'])) {
    $errors[] = 'error';
 $other_nameErr = 'You forgot to enter Other name.';
 } else
 {$other_name = mysqli_real_escape_string($dbcon, ($_POST['other_name']));}

  if (empty($_POST['dob'])) {
    $errors[] = 'error';
 $dobErr = 'You forgot to enter Date of birth.';
 } else
 {$dob = mysqli_real_escape_string($dbcon, ($_POST['dob']));}

 if (empty($_POST['matric_number'])) {
     $errors[] = 'error';
 $matric_numberErr = 'You forgot to enter matric number.';
 } else
 {$matric_number = mysqli_real_escape_string($dbcon, ($_POST['matric_number']));}

 if (empty($_POST['phone_number'])) {
     $errors[] = 'error';
 $phone_numberErr = 'You forgot to enter phone number.';
 } else
 {$phone_number = mysqli_real_escape_string($dbcon, ($_POST['phone_number']));}

 if (empty($_POST['email'])) {
     $errors[] = 'error';
 $emailErr = 'You forgot to enter students email.';
 } else
 {$email = mysqli_real_escape_string($dbcon, ($_POST['email']));}


 if (empty($_POST['gender'])) {
     $gender[] = 'error';
 $genderErr = 'You forgot to enter students gender.';
 } else
 {$gender = mysqli_real_escape_string($dbcon, ($_POST['gender']));}

  if (empty($_POST['department'])) {
    $errors[] = 'error';
 $departmentErr = 'You forgot to enter students department.';
 } else
 {$department = mysqli_real_escape_string($dbcon, ($_POST['department']));}

  if (empty($_POST['username'])) {
    $errors[] = 'error';
 $usernameErr = 'You forgot to enter students username.';
 } else
 {$username = mysqli_real_escape_string($dbcon, ($_POST['username']));}

 if (empty($_POST['password'])) {
     $errors[] = 'error';
 $passErr = 'You forgot to enter Password.';
 } else
 {$pass = mysqli_real_escape_string($dbcon, ($_POST['password']));}

  $image = $_FILES['image']['name'];
  $tmp_dir = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];

  if(empty($image)){
      $errors[] = 'error';
   $imgErr = "Please Select Image File.";
  }
  else
  {
   $upload_dir = '../assets/img/images/';

   $imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION));

   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

   $image = rand(1000,1000000).".".$imgExt;


   if(in_array($imgExt, $valid_extensions)){

    if($imgSize > 0)    {
    }
    else{
        $errors[] = 'error';
     $imgErr2 = "Sorry, your file is too large.";
    }
   }
   else{
       $errors[] = 'error';
    $imgErr3 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   }
  }

  if (empty($errors)){
    $q = "SELECT user_level, surname, matric_number, image, password FROM users WHERE (matric_number='$matric_number' or surname='$surname')";
  $result = mysqli_query ($dbcon, $q);
  if (@mysqli_num_rows($result) == 0) {
   $q = "INSERT INTO users (user_level, phone_number, matric_number, email, surname, first_name, other_names, dob, position, username, password, image, reg_date, gender, department)
 VALUES ('0', '$phone_number', '$matric_number', '$email',  '$surname', '$first_name', '$other_name', '$dob', 'Student', '$username', '$pass', '$image', NOW(), '$gender', '$department')";
 
   $result = @mysqli_query ($dbcon, $q);
     move_uploaded_file($tmp_dir,$upload_dir.$image);
   if ($result)
   {
   $successMSG = "<script> alert('Student Added'); </script>";
   }
   else
   {
    $errMSG = "<script> alert('An error occured please try again later'); </script>";
   }
  }else{

      $exist = '<div class="alert alert-danger"><i class="fa fa-warning"></i> Matric number or Student name already exist</div>';
  }
  }else{
      $Err = '<div class="alert alert-danger"><i class="fa fa-warning"></i> Some fields were left blank, please check</div>';
  }
 }
 if (isset($successMSG)){echo $successMSG;}
 if (isset($errMSG)){echo $errMSG;}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Faculty clearance</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <script src="../assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
     <?php include '../plugins/header.php'; ?>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">

                  	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-plus"></i> Add Student</h4>
                      <form class="form-horizontal style-form" method="post" action="add-student" enctype="multipart/form-data">
                            <?php if(isset($Err)){ echo $Err;} ?>
                            <?php if(isset($exist)){ echo $exist;} ?>
                       <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Surname</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="surname" placeholder="Student Surname" value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($surnameErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Surname Not Entered</div>';} ?>
                              </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First name</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="first_name" placeholder="Student first name" value="<?php if(isset($_POST['first_name'])){ echo $_POST['first_name'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($first_nameErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> First Name Not Entered</div>';} ?>
                              </div>
                          </div>

                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Other names</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="other_name" placeholder="Student other name" value="<?php if(isset($_POST['other_name'])){ echo $_POST['other_name'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($other_nameErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Other Name Not Entered</div>';} ?>
                              </div>
                          </div>


                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date of birth</label>
                              <div class="col-sm-4">
                                  <input type="date" class="form-control" name="dob" placeholder="Student date of birth" value="<?php if(isset($_POST['dob'])){ echo $_POST['dob'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($dobErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Date of birth not selected</div>';} ?>
                              </div>
                          </div>



                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Matric Number</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="matric_number" placeholder="Matric Number" value="<?php if(isset($_POST['matric_number'])){ echo $_POST['matric_number'];} ?>">
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($matric_numberErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Matric Number Not Entered</div>';} ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-4">
                                  <input type="number" class="form-control" name="phone_number" placeholder="Phone Number" value="<?php if(isset($_POST['phone_number'])){ echo $_POST['phone_number'];} ?>">
                              </div>
                           <div class="col-sm-4">
                            <?php if(isset($phone_numberErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Phone Number Not Entered</div>';} ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-4">
                                  <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>">
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($emailErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Email Not Entered</div>';} ?>
                              </div>
                          </div>



                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-2">
                                  <select class="form-control" name="gender">
                                  <option><?php if(isset($_POST['gender'])){ echo $_POST['gender'];} ?></option>
                                  <option>male</option>
                                  <option>female</option>
                                  </select>
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($genderErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Gender not selected</div>';} ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="department" placeholder="Enter department" value="<?php if(isset($_POST['department'])){ echo $_POST['department'];} ?>">
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($departmentErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Student Department Not Entered</div>';} ?>
                              </div>
                          </div>                    
                           

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="username" placeholder="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>">
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($usernameErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Username Not Entered</div>';} ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-4">
                                  <input class="form-control" type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])){ echo $_POST['password'];} ?>">
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($passErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Password Not Entered</div>';} ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Student Picture</label>
                              <div class="col-sm-4">
                                  <input class="form-control" type="file" name="image" accept="files/*" />
                              </div>
                               <div class="col-sm-4">
                            <?php if(isset($imgErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Please select an image</div>';}
                                  if(isset($imgErr2)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> File Size too large</div>';}
                                  if(isset($imgErr3)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Sorry, only JPG, JPEG, PNG & GIF files are allowed</div>';}
                                   ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-sm-12">
                                  <button class="btn btn-success col-md-3 pull-right" type="submit">Submit</button>

                              </div>
                          </div>

                      </form>
                    </div></div></div>



                  </div></div>
      </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              &copy 2019 UNIBEN
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../assets/js/sparkline-chart.js"></script>
	<script src="../assets/js/zabuto_calendar.js"></script>


	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>


  </body>
</html>
