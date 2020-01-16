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

if (empty($_POST['deptname'])) {
    $errors[] = 'error';
 $deptnameErr = 'You forgot to enter Department Name.';
 } else
 {$deptname = mysqli_real_escape_string($dbcon, ($_POST['deptname']));}

 if (empty($_POST['deptcode'])) {
    $errors[] = 'error';
 $deptcodeErr = 'You forgot to enter Department Code.';
 } else
 {$deptcode = mysqli_real_escape_string($dbcon, ($_POST['deptcode']));}


  if (empty($errors)){
    $q = "SELECT * FROM departments WHERE dept_name='$deptname' ";
  $result = mysqli_query ($dbcon, $q);
  if (@mysqli_num_rows($result) == 0) {
   $q = "INSERT INTO departments (dept_name, dept_code) VALUES ('$deptname', '$deptcode')";
   $result = @mysqli_query ($dbcon, $q);
   if ($result)
   {
   $successMSG = "<script> alert('Department Added'); </script>";
   }
   else
   {
    $errMSG = "<script> alert('An error occured please try again later'); </script>";
   }
  }else{

      $exist = '<div class="alert alert-danger"><i class="fa fa-warning"></i>Department already exists</div>';
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

   <title>Faculty CLearance</title>

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
                      <h4 class="mb"><i class="fa fa-plus"></i> Add New Department</h4>
                      <form class="form-horizontal style-form" method="post" action="add-department" enctype="multipart/form-data">
                            <?php if(isset($Err)){ echo $Err;} ?>
                            <?php if(isset($exist)){ echo $exist;} ?>
                       <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Name</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="deptname" placeholder="Department Name" value="<?php if(isset($_POST['deptname'])){ echo $_POST['deptname'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($deptnameErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Department Name Not Entered</div>';} ?>
                              </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department Code</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="deptcode" placeholder="Department Code" value="<?php if(isset($_POST['deptcode'])){ echo $_POST['deptcode'];} ?>">
                              </div>
                            <div class="col-sm-4">
                            <?php if(isset($deptcodeErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Department Code Not Entered</div>';} ?>
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
              &copy 2019  UNIBEN
              <a href="add-hod" class="go-top">
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
