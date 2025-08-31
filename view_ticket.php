<?php
error_reporting(0);
include "connection.php";
include "connection_details.php";
$sql = "SELECT * FROM ticket";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - View route</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bms-bus.css">
    <link rel="stylesheet" href="css/bmscss.css">
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
	          <li class="nav-item active"><a href="bus.php" class="nav-link">Bus</a></li>
	          <li class="nav-item"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item active"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
        <div>
          <a href="log.php" class="bms-login-btn">Logout</a> 
        </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside">
                <li><a href="add_ticket.php">Add Ticket</a></li>
                <li><a href="view_ticket.php">View Ticket</a></li>
              </ul>
            </aside>
          <div class="side-text-addcontent" style="margin-top:50px">
           <h3>Ticket Data</h3>
           <?php
           if($_SESSION['message']){
            echo $_SESSION['message'];
           }
           unset($_SESSION['message']);
           ?>
           <table border="1.5px">
            <tr>
              <th class="table_th">Ticket ID</th>
              <th class="table_th">Source ID</th>
              <th class="table_th">Destination ID</th>
              <th class="table_th">Fare</th>
              <th class="table_th">Delete</th>
            </tr>

            <?php
            while($info = $result -> fetch_assoc()){   
            ?>
              <tr>
                <td class="table_td"><?php echo "{$info['ticket_id']}"; ?></td>
                <td class="table_td"><?php echo "{$info['source_id']}"; ?></td>
                <td class="table_td"><?php echo "{$info['destination_id']}"; ?></td>
                <td class="table_td"><?php echo "{$info['fare']}"; ?></td>
                <td class="table_td"><?php echo "<a onClick=\"javascript:return confirm('Do you want to delete this ticket?')\" style='color:white; background-color:#5d1302; padding:8px 10px 8px 10px; border-radius:15px;' href = 'delete_ticket.php?ticketid={$info['ticket_id']}'>Delete</a>"; ?></td>
            </tr>
            <?php
            }
            ?>
           </table>
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