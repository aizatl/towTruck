<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $customerId = $_GET['customerID'];
}
$bilID = $_GET['bilID'];
$customerId = $_GET['customerID'];
$TowTruckAssign_ID  = $_GET['TowTruckAssign_ID'];

//here to calculate Amount
$con = mysqli_connect("localhost", "root", "root", "a");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit; //terminate the script
}
$sqlbill = "select * from billing where billing_id = '".$bilID."'";
$result=mysqli_query($con,$sqlbill);
  $row = mysqli_fetch_assoc($result);
  $total_amount = $row['total_amount'];
  $totalAmountPaid = $row['totalAmountPaid'];
  $remainingNotFixed = $total_amount - $totalAmountPaid;
  $remaining = number_format($remainingNotFixed, 2, '.', '');

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
          <li class=""><a href="viewTA.php">VIEW TOW TRUCK ASSIGMENT</a></li>
          <li class="menu-active"><a href="#">Add Payment</a></li>
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
        <form class="" action="crud.php" method="post" onsubmit="return confirmPayment()">
          <h2>Make Payment</h2>
            <table class="" style="width: auto; margin: 0 auto;">
              <tr>
                <td>Payment Method</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <select name="payment_method" id="payment_method">
                    <option value="cash">Cash</option>
                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>
                    <option value="e-wallet">E-wallet</option>
                  </select>
                </td>
              </tr>
              <input type="hidden" name="billID" value="<?php echo $bilID; ?>">
              <input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
              <input type="hidden" name="TowTruckAssign_ID" value="<?php echo $TowTruckAssign_ID; ?>">
              <tr>
              <td>Total Amount</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" id="amount" name="amount" value="<?php echo $total_amount; ?>" readonly></td>
            </tr>
            <tr>
            <td>Paid Amount</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="text" id="amount" name="paidAmount" value="<?php echo $totalAmountPaid ; ?>" readonly></td>
          </tr>
          <tr>
          <td>Remaining To Pay</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td><input type="text" id="remaining" name="remaining" value="<?php echo $remaining ; ?>" readonly></td>
        </tr>

        <tr>
        <td>Customer Pay</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="text" id="customerPay" name="customerPay" value="0" oninput="liveValidation()" ></td>
      </tr>

      <td></td><td></td><td><input type="submit" name="addPayment" value="Pay" style="float: right;"></td>

            </tr>
          </table>
        </form>

    </div>
  </section><!-- #hero -->
  <script>
    // Function to update total amount dynamically
    function liveValidation() {
    var customerPay = parseFloat(document.getElementById('customerPay').value);
    var remaining = parseFloat(document.getElementById('remaining').value);

    if (customerPay < 0) {
      alert('Customer pay amount cannot be below 0.');
      document.getElementById('customerPay').value = 0;
    } else if (customerPay > remaining) {
      alert('Customer pay amount cannot exceed the remaining amount.');
      document.getElementById('customerPay').value = remaining;
    }
  }
    function confirmPayment() {
        // Display a confirmation dialog
        var confirmation = confirm("Add Payment?");

        // Return true if the user clicks "OK," otherwise return false
        return confirmation;
    }

    // Attach the updateTotalAmount function to the input event of Addamount field
    document.getElementById('Addamount').addEventListener('input', updateTotalAmount);

    // Call the function once when the page is loaded
    updateTotalAmount();
</script>

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
