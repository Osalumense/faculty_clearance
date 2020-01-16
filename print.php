<?php 
ob_start();
require ( 'mysqli_connect.php' ) ;
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{ header("Location: login");
exit();
}
?>
<html>


<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Faculty clearance</title>

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
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <style>
        *
{
    border: -10;
    box-sizing: content-box;
    color: inherit;
    font-family: inherit;
    font-size: inherit;
    font-style: inherit;
    font-weight: inherit;
    line-height: inherit;
    list-style: none;
    margin: 5;
    padding: 0;
    text-decoration: none;
    vertical-align: top;
}
    </style>
</head>
<body>
<?php
   function rows(){
        $id = $_GET['id'];  
    $q = "SELECT * FROM users, clearance_requests WHERE users.user_id = clearance_requests.user_id AND clearance_requests.user_id = '$id'";
    $result = mysqli_query ($dbcon, $q);
    if($result){
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    }
    



 /*$q = "SELECT * FROM users, clearance_requests WHERE users.user_id = clearance_requests.user_id";
                                   $result = @mysqli_query ($dbcon, $q);
                                     if ($result) {
                                         if (@mysqli_num_rows($result) > 0) {
                                               while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                 $id = $row['id'];
                                                 $status = $row['status'];


                                }

                            }*/
                                                 


?>

    <div class="pull-left"><img src="assets/img/download.png" width="80" height="80"></div><br>
        <div class="pull-center">
        <header align="center">
             <h2><strong>UNIVERSITY OF BENIN, BENIN CITY</strong></h2>
             <h3>FACULTY OF PHYSICAL SCIENCES</h3>
             <h4>Faculty Clearance slip</h4>


        <div>
        <div align="left" class="pull-left">
        <img src="assets/img/images/<?php echo $_SESSION['image']; ?>" width="120" height="120" align="left" class="pull-left"><br><br><br><br><br><br><br><br>
        <div align="left" class="pull-left">
        
                           
                           
                                <?php
                                    $id = $_SESSION['user_id'];
                                    $q = "SELECT DISTINCT * FROM users, clearance_requests WHERE users.user_id = clearance_requests.user_id AND clearance_requests.user_id = '$id'";
                                    $result = mysqli_query ($dbcon, $q);
                                    if($result){
                                        $row = mysqli_fetch_array($result);        
                                    echo '                             
                                    <div class="pull-center">
                                    <strong>BASE DATA</strong><br><br>
                            <strong>MATRIC NUMBER:</strong> '. $row['matric_number']. '<br><br>
                             <strong>FULL NAME: </strong> ' . $row['surname'].' '. $row['first_name'].' '.$row['other_names']. '<br>
                             <strong>DEPARTMENT: </strong> '. $row['department'].' <br>
                             <strong>FACULTY:</strong> Faculty of Physical Sciences  <br>
                             <strong>GENDER:</strong> '. $row['gender']. '<br>
                             <strong>EMAIL:</strong> '. $row['email']. '<br>
                             <strong>PHONE NUMBER:</strong> '. $row['phone_number']. '<br><br>

                             <strong>CLEARANCE DATA</strong><br><br>

                             <strong>  CLEARANCE STATUS:</strong> '. $row['status']. '<br>
                             <strong>  CLEARANCE STARTED:</strong> '. $row['date_requested']. '<br>
                             <strong>  CLEARANCE APPROVED:</strong> '. $row['date_approved']. '<br>
                             <strong>  STUDY MODE:</strong> UNDERGRADUATE FULL-TIME <br>


                                    

                              </div>';
                          }
                              ?>
                              
        
        </div>
        <div class="pull-right">

        </div>    

</body>
</html>

