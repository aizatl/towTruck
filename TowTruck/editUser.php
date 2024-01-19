
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
          <li class=""><a href="customer.php">Customer</a></li>
          <li class="menu-active"><a href="#hero">EDIT CUSTOMER</a></li>
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
  $sql="select * from customer where Customer_ID = '".$customerId."'";
  $result = mysqli_query($con,$sql);  //run query
  while($row=mysqli_fetch_assoc($result)){
   ?>
  <section id="hero">
    <div class="hero-container">
      <div>
        <form class="" action="crud.php" method="post">
          <h2>Edit Details About Customer <?php echo $username;   ?></h2>
            <table class="" style="width: auto; margin: 0 auto;">
            <tr>
              <td>FIRST NAME</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='Customer_FirstName' value='".$row['Customer_FirstName']."'></td>"; ?>
            </tr>

            <tr>
              <td>LAST NAME</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='Customer_LastName' value='".$row['Customer_LastName']."'></td>"; ?>
            </tr>

            <tr>
              <td>PHONE NUMBER</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='Customer_PhoneNum' value='".$row['Customer_PhoneNum']."'></td>"; ?>
            </tr>

            <tr>
              <td>ADDRESS</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <?php echo "<td><input type='text' name='Customer_Address' value='".$row['Customer_Address']."'></td>"; ?>
            </tr>
            <tr>
              <br><?php echo "<td><input type='hidden' name='Customer_ID' value='".$row['Customer_ID']."'></td>"; ?>
            </tr>
            <tr>

              <td></td><td></td><td><input type="submit" name="edit" value="Submit" style="float: right;"></td>

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
