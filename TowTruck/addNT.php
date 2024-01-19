
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
          <li class=""><a href="towingRequest.php">Towing Request</a></li>
          <li class="menu-active"><a href="#hero">Add Towing Request</a></li>
          <li class=""><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
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
                  $sql_customer = "SELECT Customer_ID, Customer_FirstName FROM customer";
                  $result_customer = $con->query($sql_customer);

                  // Fetch Service Type data
                  $sql_service = "SELECT ServiceType_ID, ServiceType_Name FROM service_type";
                  $result_service = $con->query($sql_service);

                  // Close the connection after fetching data
                  $con->close();
              ?>

              <!-- HTML part for Customer -->
              <tr>
                  <td>FIRST NAME</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="Customer_FirstName">
                          <?php
                          if ($result_customer->num_rows > 0) {
                              while ($row = $result_customer->fetch_assoc()) {
                                  echo "<option value='" . $row["Customer_ID"] . "'>" . $row["Customer_FirstName"] . "</option>";
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
                  <td>Service Type</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                      <select name="ServiceType_ID">
                          <?php
                          if ($result_service->num_rows > 0) {
                              while ($row = $result_service->fetch_assoc()) {
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
              <td>Request Date</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="date" name="Request_Date" value=""></td>
            </tr>

            <tr>
              <td>Request Time</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="time" name="Request_Time" value=""></td>
            </tr>

            <tr>
              <td>Pickup Location</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="Pickup_Location" value=""></td>
            </tr>
            <tr>
              <td>Reason For Tow</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="Reason_For_Tow" value=""></td>
            </tr>
            <tr>
                <td>Urgent</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <input type="radio" id="urgent_yes" name="Request_Urgency" value="1">
                    <label for="urgent_yes">Yes</label>
                    <input type="radio" id="urgent_no" name="Request_Urgency" value="0">
                    <label for="urgent_no">No</label>
                </td>
            </tr>


            <tr>
              <td>Request Distance</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="number" name="Request_Distance" value=""></td>
            </tr>
            <tr>

              <td></td><td></td><td><input type="submit" name="addTR" value="Submit" style="float: right;"></td>

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
