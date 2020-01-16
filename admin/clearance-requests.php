<?php
ob_start();
require ( '../mysqli_connect.php' ) ;
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
{ header("Location: ../login");
exit();
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
    
       <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Clearance requests</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-user"></i> Student Name</th>
                                  <th class="hidden-phone"><i class="fa fa-home"></i> Department</th>
                                  <th><i class="fa fa-envelope-square"></i> Faculty receipt</th>
                                  <th><i class=" fa fa-envelope"></i> departmental clearance slip</th>
                                  <th><i class=" fa fa-envelope"></i> Status</th>
                                  <th><i class="fa fa-edit"></i>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                
                                   $q = "SELECT * FROM users, clearance_requests WHERE users.user_id = clearance_requests.user_id";
                                   $result = @mysqli_query ($dbcon, $q);
                                     if ($result) {
                                         if (@mysqli_num_rows($result) > 0) {
                                               while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                 $id = $row['id'];
                                                 $status = $row['status'];

                                             echo 
                                             '<tr>
                                                 <td>'.$row['surname'].' '.$row['first_name'].' '.$row['other_names'].'</td>
                                                 <td class="hidden-phone">'.$row['department'].'</td>
                                                 <td><img class="modal-content" id="imgs" width="300" height="400" src="../assets/img/clearancefiles/'.$row['faculty_receipt'].'"></td>
                                                 <td><img class="modal-content" id="imgs" width="300" height="400" src="../assets/img/clearancefiles/'.$row['dept_clearance'].'" class="userimg myImg"></td>   
                                                     <td>';
                                 if($status == 'pending'){echo '<div class="btn btn-info btn-sm">Pending...</div>';}
                                 elseif($status == 'approved'){echo '<div class="btn btn-success btn-sm">Approved</div>';}
                                 elseif($status == 'disapproved'){echo '<div class="btn btn-danger btn-sm">Disapproved</div>';} 
                                 echo '
                                                 </td>
                                                 <td>
                                          <a href=clearance-action?id='.$id.'&action=approve><button class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</button></a> <br><br>
                                         <a href="clearance-action?id='.$id.'&action=disapprove"><button class="btn btn-danger btn-sm"><i class="fa fa-times "> Disapprove</i></button></a>
                                                 </td>
                                             </tr> ';
                                    

                                              }
                                              mysqli_free_result ($result);
                                              }else{
                                                echo'<div class="alert alert-danger">No requests yet found</div>';
                                              }
                                     }
                             
                             ?>
                            
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2019 &copy UNIBEN
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
        
        
        
    </script>


  </body>
</html>
