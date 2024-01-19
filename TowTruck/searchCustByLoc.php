
<?php
session_start();
$username = $_SESSION['username'];//terima
//getCustomerName
$con=mysqli_connect("localhost", "root", "root", "a");
if (mysqli_connect_errno())     //check connection is establish
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 exit;   //terminate the script
 }
$sql="select username from admin where username = '".$username."'";

$AdminUsername = mysqli_query($con,$sql);  //run query
if ($AdminUsername) {
    // Fetch the result row as an associative array
    $row = mysqli_fetch_assoc($AdminUsername);

    // Check if a row was returned
    if ($row) {
        // Access the Customer_FirstName column from the result
        $AdminUserNameString = $row['username'];
    }
}
if ($username == null) {
  echo "<script>
  alert('Need to login again');
  window.location.href='index.php';
  </script>";
}



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
    <div class="container" >
<?php
$username = $_SESSION['username'];//terima
$locationSelect=$_POST['locationSelect']; //terima
$con=mysqli_connect("localhost", "root", "root", "a");
$con=mysqli_connect("localhost", "root", "root", "a");
if (mysqli_connect_errno())     //check connection is establish
 {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
     $sql="select * from customer where Customer_Address = '".$locationSelect."';";
     $qry = mysqli_query($con,$sql);

 ?>
      <div id="logo" class="pull-left">
        <h1><a href="#hero"> <?php echo "Hi ".$username; ?> </a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class=""><a href="MainMenu.php">Home</a></li>
          <li class=""><a href="reportFirstPage.php">Report</a></li>
          <li class="menu-active"><a href="#hero">Customer By Location</a></li>
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
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
      exit;
    }
    $sqlLocation="select Customer_Address from customer;";
    $qry1=mysqli_query($con,$sqlLocation);
   ?>
  <section id="hero">
    <div class="hero-container">
      <div>
        <h1>Search Customer by Location</h1>
        <form class="" action="searchCustByLoc.php" method="post">
            <table class="table table-bordered table-dark">
              <tr>
                <td>
                  <label for="locationSelect">Select a Location:</label>
                  <select id="locationSelect" name="locationSelect">
                      <?php
                      // Check if the query executed successfully
                      if ($qry1) {
                          // Loop through the fetched data to create options
                          while ($row = mysqli_fetch_assoc($qry1)) {
                              echo "<option value='" . $row['Customer_Address'] . "'>" . $row['Customer_Address'] . "</option>";
                          }
                      } else {
                          echo "<option value=''>No locations found</option>";
                      }
                      ?>
                  </select>
                </td>
                <td><input type="submit" value="FIND"></td>

              </tr>
            </table>
        </form>



        <?php
        if(mysqli_num_rows($qry) > 0){
          ?>
          <table class="table table-bordered table-dark">
          <thead>
            <td>NO</td>
            <td>CUSTOMER FIRST NAME</td>
            <td>CUSTOMER LAST NAME</td>
            <td>CUSTOMER PHONE NO</td>
            <td>CUSTOMER ADDRESS</td>
             </thead>
      <?php

      $count=1;

      while($row=mysqli_fetch_assoc($qry))
      {
        echo"<tr>";
        echo "<td>".($count)."</td>";
        echo "<td>".$row['Customer_FirstName']."</td>";
        echo"<td>".$row['Customer_LastName']."</td>";
        echo"<td>".$row['Customer_PhoneNum']."</td>";
        echo"<td>".$row['Customer_Address']."</td>";
        $count++;
      }

    } ?>


    </div>

  </section><!-- #hero -->



</body>
</html>
