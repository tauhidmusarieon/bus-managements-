<?php
include "connection.php";
include "connection_details.php";
if(isset($_POST['add_employee'])){
  $empid = $_POST['emp_id'];
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $dob = $_POST['dob'];
  $tp = $_POST['type'];
  $gend = $_POST['genderselect'];
  $ln = $_POST['license_number'];
  $phone = $_POST['phone_no'];
  $sal = $_POST['salary'];

  $age_query = "SELECT TIMESTAMPDIFF(YEAR, '$dob', CURDATE()) AS age";
  $age_result = mysqli_query($data, $age_query);
  $row = mysqli_fetch_assoc($age_result);
  $age = $row['age'];
  if ($age < 18 || $age > 65) {
    echo "<script type='text/javascript'>
          alert('Error: Age must be between 18 and 65.');
          window.location.href = 'add_employee.php';
          </script>";
    exit();
  }

  $check = "SELECT emp_id FROM employee WHERE emp_id = '$empid'";
  $check_user = mysqli_query($data, $check);
  $row_count = mysqli_num_rows($check_user);
  if($row_count == 1){
    echo "<script type = 'text/javascript'>
      alert('Employee ID already exists')
      </script>";
  }
  else{
    $sql = "INSERT INTO employee(emp_id, first_name, last_name, dob, type, gender, license_number, phone_no, salary) values('$empid', '$firstname','$lastname','$dob','$tp','$gend','$ln','$phone','$sal')";
    $result = mysqli_query($data, $sql);
    if($result){
      echo "<script type = 'text/javascript'>
      alert('Employee added successfully')
      </script>";
    }
    else{
      echo "<script type = 'text/javascript'>
      alert('Employee add failed. Check the added data again.')
      </script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Add Employee</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
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
	          <li class="nav-item active"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
        <div>
          <a href="login.php" class="bms-login-btn">Logout</a> 
         </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <div class="hero-wrap" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside">
                <li><a href="add_employee.php">Add Employee</a></li>
                <li><a href="view_employee.php">View Employee</a></li>
              </ul>
            </aside>
            <div class="col side-text-viewemp">
            <h3>Add Employee</h3>
            <div>
              <form action="#" method="POST">
              <div>
                  <label>Employee ID</label>
                  <input type="number" name="emp_id" required>
                </div>
                <div>
                  <label>First Name</label>
                  <input type="text" name="first_name" required>
                </div>
                <div>
                  <label>Last Name</label>
                  <input type="text" name="last_name">
                </div>
                <div>
                  <label>Date of Birth</label>
                  <input type="date" name="dob" required>
                </div>
                <div>
                  <label for="type">Type</label>
                  <select id="type" name="type">
                    <option value="driver">Driver</option>
                    <option value="conductor">Conductor</option>
                    <option value="both">Both</option>
                  </select>
                </div>

                <div class="gender-view">
                  <label style="margin-left:250px;">Gender</label>
                  <div>
                    <input type="radio" id="male" name="genderselect" value="male" checked required>
                    <label for="male">Male</label>
                  </div>

                  <div>
                    <input type="radio" id="female" name="genderselect" value="female" required>
                    <label for="female">Female</label>
                  </div>
                </div>

                <div>
                  <label>License Number</label>
                  <input type="text" name="license_number">
                </div>
                <div>
                  <label>Phone Number</label>
                  <input type="number" name="phone_no" required>
                </div>
                <div>
                <div>
                  <label>Salary</label>
                  <input type="number" name="salary" required>
                </div>
                <div>
                <div>
                  <input type="submit" name="add_employee" value="Add Employee" class="submit-btn">
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