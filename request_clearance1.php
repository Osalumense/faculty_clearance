<?php
ob_start();
require ( 'mysqli_connect.php' ) ;
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $errors = array();
    if (empty($_POST['department'])) {
        $errors[] = 'error';
        $departmentErr = 'You forgot to enter students department.';
    } else
        {$department = mysqli_real_escape_string($dbcon, ($_POST['department']));
    }

    //$file1 = print_r($_FILES['image']); echo '<br>'; 
    //$file2 = print_r($_FILES['dept_slip']);
    /*$faculty_receipt = $_FILES['faculty_receipt']['name'];
    $tmp_dir = $_FILES['faculty_receipt']['tmp_name'];
    $imgSize = $_FILES['faculty_receipt']['size'];

    if(empty($faculty_receipt)){
        $errors[] = 'error';
        $faculty_receiptErr = "Please Select Image File.";
    }
    else
    {
        $upload_dir = 'assets/img/clearancefiles/';

        $faculty_receiptExt = strtolower(pathinfo($faculty_receipt,PATHINFO_EXTENSION));

        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

        $faculty_receipt = rand(1000,1000000).".".$faculty_receiptExt;


        if(in_array($faculty_receiptExt, $valid_extensions)){

            if($imgSize > 0)    {
            }
            else{
            $errors[] = 'error';
            $faculty_receiptErr2 = "Sorry, your file is too large.";
            }
        } else{
            $errors[] = 'error';
            $faculty_receiptErr3 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }*/

    /*$image = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

  if(empty($image)){
        $errors[] = 'error';
        $imgErr = "Please Select Image File.";
  }
  else
  {
            $upload_dir = 'assets/img/clearancefiles/';

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

    $dept_slip = $_FILES['dept_slip']['name'];
    $temp = $_FILES['dept_slip']['tmp_name'];
    $dept_slipSize = $_FILES['dept_slip']['size'];

    if(empty($dept_slip)){
        $errors[] = 'error';
        $dept_slipErr = "Please Select Image File.";
    }
    else
    {
        $upload_dir = 'assets/img/clearancefiles/';

        $dept_slipExt = strtolower(pathinfo($dept_slip,PATHINFO_EXTENSION));

        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

        $dept_slip = rand(1000,1000000).".".$dept_slipExt;


        if(in_array($dept_slipExt, $valid_extensions)){

            if($dept_slipSize > 0)    {
            }
            else{
            $errors[] = 'error';
            $dept_slipErr2 = "Sorry, your file is too large.";
            }
        } else{
            $errors[] = 'error';
            $dept_slipErr3 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }*/

    $image = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
  
    if(empty($image)){
        $errors[] = 'error';
     $imgErr = "Please Select Image File.";
    }
    else
    {
     $upload_dir = 'assets/img/clearancefiles/';
  
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

    $id = $_SESSION['user_id'];

    if (empty($errors)){
        $q = "SELECT * FROM users WHERE user_id='$id'";
        $result = mysqli_query ($dbcon, $q);
        if (@mysqli_num_rows($result) == 0) {
            $q = "INSERT INTO clearance_requests (user_id, department, faculty_receipt, status, date_requested)
            VALUES ('$id', '$department', '$image', 'pending', 'NOW()')";
            
            $result = @mysqli_query ($dbcon, $q);
                move_uploaded_file($tmp_dir, $upload_dir.$image);
            if ($result)
            {
                $successMSG = "<script> alert('clearance requested'); </script>";
            }
            else
            {
                $errMSG = "<script> alert('An error occured please try again later'); </script>";
            }
        }else{
        
            $exist = '<div class="alert alert-danger"><i class="fa fa-warning"></i> You have already requested clearance</div>';
        }
      }else{
          $Err = '<div class="alert alert-danger"><i class="fa fa-warning"></i> Some fields were left blank, please check</div>';
      }
     if (isset($successMSG)){echo $successMSG;}
     if (isset($errMSG)){echo $errMSG;}

 }

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
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

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
     <?php include 'plugins/header.php'; ?>
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


                        <?php
                        function departments(){
                            GLOBAL $dbcon;
                            $q = "SELECT * FROM departments";
                            $result = @mysqli_query ($dbcon, $q);
                            $result = $result;
                            if (@mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<option>'.$row['dept_name'].'</option>';
                            }
                            mysqli_free_result ($result);
                            }
                            }
                                                   
                        
                        ?>
                        <h5>Request clearance in 3 different steps</h5>
                        <h5>1. Select your department</h5>
                        <h5>2. Upload your faculty dues receipt</h5>
                        <h5>3. Upload your departmental clearance slip and then request clearance</h5>
                        
                        <div class="row">
                            <div class="col-lg-12 main-chart">

                                <div class="row mt">
                                    <div class="col-lg-12">     
                                        <div class="form-panel">
                                            <h4 class="mb"><i class="fa fa-plus"></i> Request clearance</h4>
                                                <form class="form-horizontal style-form" method="post" action="request_clearance1" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-sm-2 control-label">Department</label>
                                                            <div class="col-sm-4">
                                                                <select type="text" class="form-control" name="department">
                                                                    <option><?php if(isset($_POST['department'])){ echo $_POST['department'];} ?></option>
                                                                    <?php departments(); ?>
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="col-sm-4">
                                                                <?php if(isset($departmentErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> STudent Faculty Not Entered</div>';} ?>
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                            <label class="col-sm-2 col-sm-2 control-label">Picture</label>
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

                                                    <!--<div class="form-group">
                                                        <label class="col-sm-2 col-sm-2 control-label">Department clearance slip</label>
                                                            <div class="col-sm-4">
                                                                    <input class="form-control" type="file" name="dept_slip" accept="files/*" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?php /*if(isset($dept_slipErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Please select an image</div>';}
                                                                      if(isset($dept_slipErr2)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> File Size too large</div>';}
                                                                      if(isset($dept_slipErr3)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Sorry, only JPG, JPEG, PNG & GIF files are allowed</div>';}
                                                                */?>
                                                            </div>
                                                    </div>-->
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success col-md-3 pull-right" type="submit">Submit</button>
                                                    </div>
                                                </div>

                                            </form>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            


                    </div>
                </div>
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
      </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
	<script src="assets/js/zabuto_calendar.js"></script>




  </body>
</html>
