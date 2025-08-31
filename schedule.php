<?php
include "connection.php";
include "connection_details.php";
if(isset($_POST['add_schedule'])){ 
  $scheduleid = $_POST['schedule_id'];
  $routeid = $_POST['route_id'];
  $start_time= $_POST['start_time'];
  $stop_time= $_POST['stop_time'];
  $busid=$_POST['bus_id'];
  $cid = $_POST['c_id'];
  $did = $_POST['d_id'];

  $fk_check = "SELECT route_id FROM route WHERE route_id = '$routeid'";
  $fk_check_user = mysqli_query($data, $fk_check);
  $rc = mysqli_num_rows($fk_check_user);
  if(empty($_POST['route_id']) ){//not null template   
    echo "<script type = 'text/javascript'>
      alert('Please enter route id')
      </script>";
  }
  elseif( $rc < 1){   
    echo "<script type = 'text/javascript'>
      alert('Route does not exists')
      </script>";
  }
  else{   
    $check = "SELECT schedule_id FROM schedule WHERE schedule_id = '$scheduleid'";
    $check_user = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_user);
    if($row_count == 1){
      echo "<script type = 'text/javascript'>
        alert('Schedule exists')
        </script>";
    }
    else{
      $sql = "INSERT INTO schedule(schedule_id, route_id, start_time, stop_time, bus_id,c_id,d_id) values('$scheduleid','$routeid', '$start_time','$stop_time' ,'$busid','$cid','$did')";
      $result = mysqli_query($data, $sql);
      if($result){
        echo "<script type = 'text/javascript'>
        alert('Schedule added successfully')
        </script>";
      }
      else{
        echo "<script type = 'text/javascript'>
        alert('Insertion Failed')
        </script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Schedules</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bmscss.css">
    <link rel="stylesheet" href="css/bms-bus.css">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Local<span>Bus</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

				<div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="bus.php" class="nav-link">Bus</a></li>
	          <li class="nav-item"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item active"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          <aside>
            <ul class="bus-aside">
              <li><a href="route.php">Add Route</a></li>
              <li><a href="view_route.php">View Routes</a></li>
              <li><a href="schedule.php">Add Schedule</a></li>
              <li><a href="view_schedule.php">View Schedules</a></li>
              <li><a href="delete_schedule.php">Delete Schedule</a></li><!--pending-->
            </ul>
          </aside>
          <div class="col-lg-6 col side-text" style="margin-top: -36px !important;">
            <h3>Add Schedule</h3>
            <div>
              <form action="schedule.php" method="POST" id="insert_schedule_form">
                <div>
                  <label class="label-deg">Schedule ID</label>
                  <input type="number" name="schedule_id" required>
                </div>
                <div>
                  <label class="label-deg">Route ID</label>
                  <input type="number" name="route_id" required>
                </div>
                <div>
                  <label class="label-deg">Start Time</label>
                  <input type="time" name="start_time" required>
                </div>
                <div>
                  <label class="label-deg">Stop Time</label>
                  <input type="time" name="stop_time" required>
                </div>
                <div>
                  <label class="label-deg">Bus ID</label>
                  <input type="number" name="bus_id" required>
                </div>
                <div>
                  <label class="label-deg">Conductor ID</label>
                  <input type="number" name="c_id" required>
                </div>
                <div>
                  <label class="label-deg">Driver ID</label>
                  <input type="number" name="d_id" required>
                </div>
                <div>
                  <input type="Submit" name="add_schedule" value="ADD SCHEDULE" class="submit-btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="js/jquery.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>  
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>   
  </body>
</html>
