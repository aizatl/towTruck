
<?php
session_start();
$username = $_SESSION['username'];//terima
if ($username == null) {
  echo "<script>
  alert('Need to login again');
  window.location.href='index.php';
  </script>";
}
include "function.php";

if(isset($_GET['id'])) {
    // Retrieve the Customer_ID from the URL
    $customerId = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> Customer </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
</head>
<style media="screen">
#editBtn {
  background-color:#808080;
  -moz-border-radius:20px;
  -webkit-border-radius:20px;
  border-radius:20px;
  border:1px ;
  display:inline-block;
  cursor:pointer;
  color:#464F4C;
  font-family:Verdana;
  font-size:10px;
  padding:8px;
  text-decoration:none;
  text-shadow:0px 1px 15px #02dca9;
}
#editBtn:hover {
  background-color:#a6bbb6;
}
#editBtn:active {
  position:relative;
  top:1px;
}
#numOfComplaints
{
  font-family: "Open Sans", sans-serif;
  color: #ffffff;
  font-size: 24px;
}
td {
    color: white;
}
</style>
<body>

  <!--==========================
  Header
  ============================-->
  <header id="header">
    <div class="container">
<?php
$username = $_SESSION['username'];//terima
 ?>
      <div id="logo" class="pull-left">
        <h1><a href="#hero"> <?php echo "Hi ".$username; ?> </a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class=""><a href="MainMenu.php">Home</a></li>
          <li class=""><a href="towTruckAssigment.php">TOW TRUCK ASSIGMENT</a></li>
          <li class="menu-active"><a href="#hero">Add TOW TRUCK ASSIGMENT</a></li>
          <li class=""><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div>
        <form class="" action="crud.php" method="post">
          <h2>ADD NEW TOWING REQUEST</h2>
            <table class="" style="width: auto; margin: 0 auto;">
              <?php
                  $con = mysqli_connect("localhost", "root", "root", "a");
                  if (mysqli_connect_errno()) {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      exit; //terminate the script
                  }

                  // Fetch Customer data
                  $sql_driver = "SELECT Driver_ID, Driver_FirstName FROM driver";
                  $result_driver = $con->query($sql_driver);

                  // Fetch Service Type data
                  $sql_towTruck = "SELECT TowTruck_ID, TowTruck_Registration_Number FROM tow_truck";
                  $result_towTruck = $con->query($sql_towTruck);

                  $sql_serviceType = "SELECT ServiceType_ID , ServiceType_Name FROM service_type";
                  $result_serviceType = $con->query($sql_serviceType);

                  $sql_Towing_Request_ID = "SELECT Towing_Request_ID FROM towing_request";
                  $result_Towing_Request_ID = $con->query($sql_Towing_Request_ID);

                  // Close the connection after fetching data
                  $con->close();
              ?>

              <!-- HTML part for Customer -->
              <tr>
                  <td>DRIVER NAME</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="Driver_ID">
                          <?php
                          if ($result_driver->num_rows > 0) {
                              while ($row = $result_driver->fetch_assoc()) {
                                  echo "<option value='" . $row["Driver_ID"] . "'>" . $row["Driver_FirstName"] . "</option>";
                              }
                          } else {
                              echo "<option value=''>No customers found</option>";
                          }
                          ?>
                      </select>
                  </td>
              </tr>

              <!-- HTML part for Service Type -->
              <tr>
                  <td>Tow Truck Registration NO</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="TowTruck_ID">
                          <?php
                          if ($result_towTruck->num_rows > 0) {
                              while ($row = $result_towTruck->fetch_assoc()) {
                                  echo "<option value='" . $row["TowTruck_ID"] . "'>" . $row["TowTruck_Registration_Number"] . "</option>";
                              }
                          } else {
                              echo "<option value=''>No service types found</option>";
                          }
                          ?>
                      </select>
                  </td>
              </tr>

              <tr>
                  <td>Towing Request ID</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="Towing_Request_ID">
                          <?php
                          if ($result_Towing_Request_ID->num_rows > 0) {
                              while ($row = $result_Towing_Request_ID->fetch_assoc()) {
                                  echo "<option value='" . $row["Towing_Request_ID"] . "'>" . $row["Towing_Request_ID"] . "</option>";
                              }
                          } else {
                              echo "<option value=''>No service types found</option>";
                          }
                          ?>
                      </select>
                  </td>
              </tr>

              <tr>
                  <td>Service Type</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="ServiceType_ID">
                          <?php
                          if ($result_serviceType->num_rows > 0) {
                              while ($row = $result_serviceType->fetch_assoc()) {
                                  echo "<option value='" . $row["ServiceType_ID"] . "'>" . $row["ServiceType_Name"] . "</option>";
                              }
                          } else {
                              echo "<option value=''>No service types found</option>";
                          }
                          ?>
                      </select>
                  </td>
              </tr>


            <tr>
              <td>Assign Time</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="time" name="TowTruckAssign_Time" value=""></td>
            </tr>

            <tr>
              <td>Details</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="TowTruckAssign_Details" value=""></td>
            </tr>

            <tr>
              <td>Assign Location</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="TowTruckAssign_Location" value=""></td>
            </tr>
            <tr>
              <td>Duration</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="number" name="TowTruckAssign_Duration" value=""></td>
            </tr>
            <tr>
              <td>Vehicle Type</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="vehicle_type" value=""></td>
            </tr>

              <td></td><td></td><td><input type="submit" name="addTA" value="Submit" style="float: right;"></td>

            </tr>
          </table>
        </form>

    </div>
  </section><!-- #hero -->

  <main id="main">
  </main>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
