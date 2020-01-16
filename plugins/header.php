 <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Faculty clearance</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout">Logged in as <?php echo $_SESSION['surname']. ' '.$_SESSION['first_name']?></a></li>
                    <?php if($_SESSION['user_level']==0){
    echo'<li><a class="logout" href="logout">Logout</a></li>';
}else{
    echo '<li><a class="logout" href="../logout">Logout</a></li>';
}
                  ?>
            	</ul>
            </div>
        </header>

 <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered">
                     <?php

                      if($_SESSION['user_level'] == 3){
                    echo  '<img src="../assets/img/img4.jpeg" class="img-circle" width="60">';

}elseif($_SESSION['user_level'] == 0){
    if(!empty($_SESSION['image'])){
    echo '<img src="../assets/img/images/'.$_SESSION['image'].'" class="img-circle" width="60">';
  }else{
     echo '<img src="assets/img/profile-02.jpg" class="img-circle" width="60">';
  }

}elseif($_SESSION['user_level'] == 2){
  if(!empty($_SESSION['image'])){
    echo '<img src="../assets/img/images/'.$_SESSION['image'].'" class="img-circle" width="60">';
  }else{
     echo '<img src="assets/img/profile-02.jpg" class="img-circle" width="60">';
   }
}elseif($_SESSION['user_level'] == 1){
    if(!empty($_SESSION['image'])){

    echo '<img src="assets/img/images/'.$_SESSION['image'].'" class="img-circle" width="60">';
    }else{
      echo '<img src="assets/img/ny.jpg" class="img-circle" width="60">';
    }
}
                      ?>
                      </a></p>
              	  <h5 class="centered"><?php echo $_SESSION['surname']?></h5>

                 <?php
            /*if($_SESSION['user_level']==1){

                echo'
                 <li class="mt">
                      <a href="course_registration">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                ';
            }*/


                  ?>
    <?php
            if($_SESSION['user_level']==1){

                echo'
                 <li class="mt">
                      <a href="clearance-requests">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                ';
            }


                  ?>
                  <?php
            if($_SESSION['user_level']==0){

                echo'
                 <li class="mt">
                      <a href="request_clearance2">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                ';
            }


                  ?>
       <?php
            if($_SESSION['user_level']==3){
            echo'<li class="mt">
                      <a href="users">
                          <i class="fa fa-users"></i>
                          <span>Users</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="add-student">
                          <i class="fa fa-plus"></i>
                          <span>Add Student</span>
                      </a>
                  </li>


                  <li class="mt">
                      <a href="add-clearanceofficer">
                          <i class="fa fa-plus"></i>
                          <span>Add Clearance officer</span>
                      </a>
                  </li>
                  
                  <li class="mt">
                      <a href="add-department">
                          <i class="fa fa-plus"></i>
                          <span>Add Department</span>
                      </a>
                  </li>
                  
                  
                  
                  ';
                } 
                  ?>


              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
