
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

      <div id="logo" class="pull-left">
        <h1><a href="#hero"> <?php echo "Hi ".$username; ?> </a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class=""><a href="MainMenu.php">Home</a></li>
          <li class=""><a href="reportFirstPage.php">Report</a></li>
          <li class="menu-active"><a href="#hero">Most Towing Vehicle Type</a></li>
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
<?php
      $con=mysqli_connect("localhost", "root", "root", "a");
      if (mysqli_connect_errno())     //check connection is establish
       {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
       exit;   //terminate the script
       }
       $sql="SELECT TowTruckAssign_Location, COUNT(TowTruckAssign_Location) AS address_count
       from tow_truck_assignment
        GROUP BY TowTruckAssign_Location
        ORDER BY address_count DESC
        LIMIT 5;";
        $qry = mysqli_query($con, $sql);

 ?>
 <h1>Rank of the most location</h1><br>
 <table class="table table-bordered table-dark">

     <tr>
       <th>Rank</th>
         <th>Location</th>
         <th>Count</th>
     </tr>
     <?php
     $rank = 1;
     if ($qry) {
         if (mysqli_num_rows($qry) > 0) {
             while ($row = mysqli_fetch_assoc($qry)) {
                 echo "<tr>";
                 echo "<td>" . $rank . "</td>";
                 echo "<td>" . $row["TowTruckAssign_Location"] . "</td>";
                 echo "<td>" . $row["address_count"] . "</td>";
                 echo "</tr>";
                 $rank++;
             }
         } else {
             echo "<tr><td colspan='2'>No results found</td></tr>";
         }
     }
     ?>
 </table>


    </div>

  </section><!-- #hero -->



</body>
</html>
