<?php
ob_start();
require ( 'mysqli_connect.php' ) ;
session_start();
/*if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{ header("Location: login");
exit();
}*/


 if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
        $errors = array();

        if (empty($_POST['department'])) {
                $errors[] = 'error';
                $deptErr = 'You forgot to enter department.';
        } else{
            $dept = mysqli_real_escape_string($dbcon, ($_POST['department']));}

        $fac_due = $_FILES['fac_due']['name'];
        $tmp_dir1 = $_FILES['fac_due']['tmp_name'];
        $fac_due_Size = $_FILES['fac_due']['size'];

        if(empty($fac_due)){
            $errors[] = 'error';
            $fac_due_Err = "Please Select Image File.";
        }
        else
        {
            $upload_dir = 'assets/img/clearancefiles/';

            $fac_due_Ext = strtolower(pathinfo($fac_due,PATHINFO_EXTENSION));

            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

            $fac_due = rand(1000,1000000).".".$fac_due_Ext;


            if(in_array($fac_due_Ext, $valid_extensions)){

            if($fac_due_Size > 0)    {
             }
            else{
                $errors[] = 'error';
                $fac_due_Err2 = "Sorry, your file is too large.";
            }
            }
            else{
                    $errors[] = 'error';
                    $fac_due_Err3 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }


        if (empty($_POST['datepayment'])) {
                $errors[] = 'error';
                $datepaymentErr = 'You forgot to enter date of faculty dues payment.';
        } else{
         $newdate = date ("Y-m-d", strtotime($_POST['datepayment']));
       }

        $dept_rec= $_FILES['dept_rec']['name'];
        $tmp_dir2= $_FILES['dept_rec']['tmp_name'];
        $dept_rec_Size= $_FILES['dept_rec']['size'];
        if(empty($dept_rec)){
            $errors[] = 'error';
            $dept_rec_Err = "Please Select Image File.";
        }
        else
        {
            $upload_dir = 'assets/img/clearancefiles/';

            $dept_rec_Ext = strtolower(pathinfo($dept_rec,PATHINFO_EXTENSION));

            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

            $dept_rec = rand(1000,1000000).".".$dept_rec_Ext;


            if(in_array($dept_rec_Ext, $valid_extensions)){

            if($dept_rec_Size > 0)    {
             }
            else{
                $errors[] = 'error';
                $dept_rec_Err2 = "Sorry, your file is too large.";
            }
            }
            else{
                    $errors[] = 'error';
                    $dept_rec_Err3 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }  

        $id = $_SESSION['user_id'];

        if (empty($errors)){
           $q = "SELECT * FROM clearance_requests WHERE user_id='$id'";
            $result = mysqli_query ($dbcon, $q);
            if (@mysqli_num_rows($result) == 0)  {
                $q = "INSERT INTO clearance_requests (user_id, department, faculty_receipt, date_of_payment, dept_clearance, status, date_requested)
                  VALUES ('$id', '$dept', '$fac_due', '$newdate', '$dept_rec', 'pending' ,NOW() )";
                
                $result = @mysqli_query ($dbcon, $q);
                move_uploaded_file($tmp_dir1,$upload_dir.$fac_due);
                move_uploaded_file($tmp_dir2,$upload_dir.$dept_rec);
                    if ($result)
                    {
                        $successMSG = "<script> alert('Clearance requested successfully'); </script>";
                    }
                    else
                    {
                        $errMSG = "<script> alert('An error occured please try again later'); </script>";
                    }
            } else{

               $exist = '<div class="alert alert-danger"><i class="fa fa-warning"></i> You already requested clearance</div>';
            }
          }
        else{
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

                  	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-plus"></i> Request Clearance</h4>
                      <form class="form-horizontal style-form" method="post" action="request_clearance2" enctype="multipart/form-data">
                            <?php if(isset($Err)){ echo $Err;} ?>
                            <?php if(isset($exist)){ echo $exist;} ?>
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



                           

                          <div class="form-group">
                             <label class="col-sm-2 col-sm-2 control-label">Department</label>
                                <div class="col-sm-4">
                                    <select type="text" class="form-control" name="department">
                                         <option><?php if(isset($_POST['department'])){ echo $_POST['department'];} ?></option>
                                                  <?php departments(); ?>
                                     </select>
                                </div>
                                        
                                <div class="col-sm-4">
                                      <?php if(isset($departmentErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Student Faculty Not Entered</div>';} ?>
                                </div>
                          </div>            
  

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Faculty dues receipt</label>
                              <div class="col-sm-4">
                                  <input class="form-control" type="file" name="fac_due"/>
                              </div>
                               <div class="col-sm-4">
                                  <?php if(isset($fac_due_Err)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Please select an image</div>';} ?>
                                   <?php if(isset($fac_due_Err2)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Image size too large</div>';} ?>
                                   <?php if(isset($fac_due_Err3)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Sorry, only JPG, JPEG, PNG & GIF files are allowed</div>';} ?>
                              </div>
                          </div>
                          <div class="form-group">
                             <label class="col-sm-2 col-sm-2 control-label">Date of payment: </label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="datepayment" placeholder="Date you paid faculty dues" value="<?php if(isset($_POST['datepayment'])){ echo $_POST['datepayment'];} ?>">                                              
                                     
                                </div>
                                        
                                <div class="col-sm-4">
                                      <?php if(isset($datepaymentErr)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Date of payment for faculty dues was Not Entered</div>';} ?>
                                </div>
                          </div> 

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Department clearance slip</label>
                              <div class="col-sm-4">
                                  <input class="form-control" type="file" name="dept_rec"/>
                              </div>
                               <div class="col-sm-4">
                                  <?php if(isset($dept_rec_Err)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Plese select an image</div>';} ?>
                                   <?php if(isset($dept_rec_Err2)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Image size too large</div>';} ?>
                                   <?php if(isset($dept_rec_Err3)){ echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Sorry, only JPG, JPEG, PNG & GIF files are allowed</div>';} ?>
                              </div>
                          </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success col-md-3 pull-right" type="submit" id="submit">Submit</button>

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

  <script type="text/javascript">
      $(document).ready(function(){
        $('#insert').click(function(){
          var image_name = $('#image1').val();
          if(image_name == '')
          {
            alert("Please select image");
            return false;
          }
          else
          {
            var extension = $('#image1').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == 1)
            {
              alert('Invalid Image File');
              $('#image1').val('');
              return false;
            }
          }
        });
      });

      $(document).ready(function(){
        $('#insert').click(function(){
          var image_name = $('#image2').val();
          if(image_name == '')
          {
            alert("Please select image");
            return false;
          }
          else
          {
            var extension = $('#image2').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == 1)
            {
              alert('Invalid Image File');
              $('#image2').val('');
              return false;
            }
          }
        });
      }); 
  </script>

  </body>
</html>
