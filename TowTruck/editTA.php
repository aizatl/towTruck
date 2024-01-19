
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
    $id = $_GET['id'];
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
}td {
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
          <li class=""><a href="towTruckAssigment.php">Tow Truck Assigment</a></li>
          <li class=""><a href="viewTA.php">View Tow Truck Assigment</a></li>
          <li class="menu-active"><a href="#hero">EDIT Tow Truck Assigment</a></li>
          <li class=""><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <?php
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
  $sql=" SELECT *, d.Driver_FirstName,tt.TowTruck_Registration_Number, tr.Towing_Request_ID, sr.serviceType_Name
      FROM tow_truck_assignment
      LEFT JOIN driver d ON tow_truck_assignment.Driver_ID = d.Driver_ID
      LEFT JOIN tow_truck tt ON tow_truck_assignment.TowTruck_ID  = tt.TowTruck_ID
      LEFT JOIN towing_request tr ON tow_truck_assignment.Towing_Request_ID  = tr.Towing_Request_ID
      LEFT JOIN service_type sr ON tow_truck_assignment.ServiceType_ID  = sr.ServiceType_ID where TowTruckAssign_ID  = '".$id."'";
  $result = mysqli_query($con,$sql);  //run query
  while($row=mysqli_fetch_assoc($result)){
   ?>
  <section id="hero">
    <div class="hero-container">
      <div>
        <form class="" action="crud.php" method="post">
          <h2>Edit Tow Truck Assigment</h2>
            <table class="" style="width: auto; margin: 0 auto;">
              <tr>
                <td>Driver Name</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <select name='Driver_ID'>
                        <?php
                        // Assume $conn is your database connection
                        $sql = "SELECT * FROM driver";
                        $result2 = mysqli_query($con, $sql);

                        while ($customer = mysqli_fetch_assoc($result2)) {
                            // Check if the option matches the current value
                            $isSelected = ($customer['Driver_FirstName'] === $row['Driver_FirstName']) ? 'selected' : '';
                            echo "<option value='" . $customer['Driver_ID'] . "' $isSelected>" . $customer['Driver_FirstName'] . "</option>";
                        }
                        ?>
                    </select>
                    </td>
                </tr>

            <tr>
              <td>Tow Truck Registration No</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>
                  <select name='TowTruck_ID'>
                      <?php
                      // Assume $conn is your database connection
                      $sql = "SELECT * FROM tow_truck";
                      $result2 = mysqli_query($con, $sql);

                      while ($customer = mysqli_fetch_assoc($result2)) {
                          // Check if the option matches the current value
                          $isSelected = ($customer['TowTruck_Registration_Number'] === $row['TowTruck_Registration_Number']) ? 'selected' : '';
                          echo "<option value='" . $customer['TowTruck_ID'] . "' $isSelected>" . $customer['TowTruck_Registration_Number'] . "</option>";
                      }
                      ?>
                  </select>
                  </td>
            </tr>

            <tr>
              <td>Towing Request ID</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>
                  <select name='Towing_Request_ID'>
                      <?php
                      // Assume $conn is your database connection
                      $sql = "SELECT * FROM towing_request";
                      $result2 = mysqli_query($con, $sql);

                      while ($customer = mysqli_fetch_assoc($result2)) {
                          // Check if the option matches the current value
                          $isSelected = ($customer['Towing_Request_ID'] === $row['Towing_Request_ID']) ? 'selected' : '';
                          echo "<option value='" . $customer['Towing_Request_ID'] . "' $isSelected>" . $customer['Towing_Request_ID'] . "</option>";
                      }
                      ?>
                  </select>
                  </td>
            </tr>

            <tr>
              <td>Tow Truck Assign Time</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='time' name='TowTruckAssign_Time' value='".$row['TowTruckAssign_Time']."'></td>"; ?>
            </tr>

            <tr>
              <td>Tow Truck Assign Details</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='TowTruckAssign_Details' value='".$row['TowTruckAssign_Details']."'></td>"; ?>
            </tr>
            <tr>
              <td>TowTruckAssign_Location</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='TowTruckAssign_Location' value='".$row['TowTruckAssign_Location']."'></td>"; ?>
            </tr>

            <tr>
              <td>Vehicle Type</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='vehicle_type' value='".$row['vehicle_type']."'></td>"; ?>
            </tr>

            <tr>
              <td>Duration</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='number' name='TowTruckAssign_Duration' value='".$row['TowTruckAssign_Duration']."'></td>"; ?>
            </tr>
            <tr>
              <td>Service Type</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>
                  <select name='ServiceType_ID'>
                      <?php
                      // Assume $conn is your database connection
                      $sql = "SELECT * FROM service_type";
                      $result2 = mysqli_query($con, $sql);

                      while ($customer = mysqli_fetch_assoc($result2)) {
                          // Check if the option matches the current value
                          $isSelected = ($customer['ServiceType_Name'] === $row['ServiceType_Name']) ? 'selected' : '';
                          echo "<option value='" . $customer['ServiceType_ID'] . "' $isSelected>" . $customer['ServiceType_Name'] . "</option>";
                      }
                      ?>
                  </select>
                  </td>
            </tr>
            <tr>
              <br><?php echo "<td><input type='hidden' name='id' value='".$id."'></td>"; ?>
            </tr>
            <tr>

              <td></td><td></td><td><input type="submit" name="editTA" value="Submit" style="float: right;"></td>

            </tr>
          </table>
        </form>


<?php } ?>

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
