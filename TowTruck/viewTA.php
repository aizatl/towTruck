<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(300);
session_start();
$username = $_SESSION['username'];//terima
if ($username == null) {
  echo "<script>
  alert('Need to login again');
  window.location.href='index.php';
  </script>";
}
include "function.php";

$res1 = getAllTA();

$status22 = array();
$bilID = array(); // Initialize an empty array
while ($row1 = mysqli_fetch_assoc($res1)) {
    $Towing_Request_ID = $row1['Towing_Request_ID'];
    $con=mysqli_connect("localhost", "root", "root", "a");
    if (mysqli_connect_errno())     //check connection is establish
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
     $sql="SELECT ta.TowTruckAssign_ID, bil.status, bil.billing_id
          FROM tow_truck_assignment ta
          LEFT JOIN billing bil ON ta.billing_id = bil.billing_id
          ORDER BY TowTruckAssign_ID ASC";
     $qry = mysqli_query($con,$sql);  //run query
     if ($qry) {
      while ($row2 = mysqli_fetch_assoc($qry)) {
          $status22[] = $row2['status'];
          $bilID[] = $row2['billing_id'];
      }
}

}
$res = getAllTA();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>  </title>
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
          <li class="menu-active"><a href="#hero">VIEW TOW TRUCK ASSIGMENT</a></li>
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

      <h1>All TOW TRUCK ASSIGMENT</h1>
       <table class="table table-bordered table-dark">
         <thead>
              <td>NO</td>
              <td>DRIVER <br>NAME</td>
              <td>TOW TRUCK <br>REGISTRATION NO</td>
              <td>TOWING REQUEST <br>ID</td>
              <td>VEHICLE TYPE <br>ID</td>
              <td>ASSIGN <br>TIME</td>
              <td>DETAILS</td>
              <td>LOCATION</td>
              <td>DURATION</td>
              <td>SERVICE <br>TYPE</td>
              <td>Status</td>
              <td>Paid Status</td>
              <td>Edit</td>
              <td>Delete</td>

              <td>Action</td>
            </thead>
           <?php
           $count=1;

           while($row=mysqli_fetch_assoc($res))
           {
             //display
             echo"<tr>";
             echo "<td>".($count)."</td>";
             echo "<td>".$row['Driver_FirstName']."</td>";
             echo"<td>".$row['TowTruck_Registration_Number']."</td>";
             echo"<td>".$row['Towing_Request_ID']."</td>";
             echo"<td>".$row['vehicle_type']."</td>";
             echo"<td>".$row['TowTruckAssign_Time']."</td>";
              echo"<td>".$row['TowTruckAssign_Details']."</td>";
               echo"<td>".$row['TowTruckAssign_Location']."</td>";
               echo"<td>".$row['TowTruckAssign_Duration']."</td>";
               echo"<td>".$row['serviceType_Name']."</td>";
               echo"<td>".$row['assigmentStatus']."</td>";
               if($status22[$count-1] != null){
                 echo"<td>".$status22[$count-1]."</td>";
               }else{echo"<td>Not Pay Yet</td>";}
            echo "<td><a href='editTA.php?id=" . $row['TowTruckAssign_ID']."'>Edit</a></td>";
             echo "<td><a href='deleteTA.php?id=" . $row['TowTruckAssign_ID']."'>Delete</a></td>";
             //echo "<input type='hidden' name='customerID' value='".$row['customer_id']."'>"; //sini
             if( $row['assigmentStatus'] == 'ongoing'){
               echo "<td><a href='makePayment.php?id=" . $row['TowTruckAssign_ID']."'>Make Payment</a></td>";
             }else if($row['assigmentStatus'] == 'done' && $status22[$count-1] == "partially"){
               echo "<td><a href='addPayment.php?bilID=" . $bilID[$count-1] . "&customerID=" . $row['customer_id'] . "&TowTruckAssign_ID=" . $row['TowTruckAssign_ID'] . "'>Add Payment</a></td>";
             }else if($row['assigmentStatus'] == 'done'){
               echo "<td><a href='generateBill.php?id=" . $bilID[$count-1] . "'>Generate Bill</a></td>";
             }
             $count++;
           }
            ?>

       </table>


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
