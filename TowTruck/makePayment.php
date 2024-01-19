
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
$TowTruckAssign_ID = $_GET['id'];
//here to calculate Amount
$con = mysqli_connect("localhost", "root", "root", "a");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit; //terminate the script
}
$sqlGetTowingRequestID = "SELECT
            tr.Request_Distance, d.Driver_FirstName, c.customer_FirstName,c.customer_id,
            cost.cost_base_rate, cost.cost_distance_rate, cost.cost_urgency_rate,
            tr.Request_Urgency

        FROM
            tow_truck_assignment ta
            LEFT JOIN towing_request tr ON ta.Towing_Request_ID = tr.Towing_Request_ID
            LEFT JOIN driver d ON ta.Driver_ID = d.Driver_ID
            LEFT JOIN customer c ON tr.customer_id = c.customer_Id
            LEFT JOIN cost cost ON cost.ServiceType_ID = tr.ServiceType_ID
        WHERE
            ta.TowTruckAssign_ID =".$TowTruckAssign_ID;

$result = mysqli_query($con,$sqlGetTowingRequestID);  //run query
if ($result) {
    // Fetch the first row as an associative array
    $row = mysqli_fetch_assoc($result);

    // Check if $row is not empty before accessing values
    if ($row) {
        // Store the results into variables
        $requestDistance = $row['Request_Distance'];

        $cost_base_rate = $row['cost_base_rate'];
        $cost_distance_rate = $row['cost_distance_rate'];
        $cost_urgency_rate = $row['cost_urgency_rate'];
        $Request_Urgency = $row['Request_Urgency'];
        $customer_id = $row['customer_id'];
        $custName = $row['customer_FirstName'];
        $driverName = $row['Driver_FirstName'];
    }
}
if($Request_Urgency >0){
  $totalAmountGeneratednotfixed = $requestDistance *$cost_distance_rate* $cost_urgency_rate;
}else{
  $totalAmountGeneratednotfixed = $requestDistance *$cost_distance_rate;
}
$totalAmountGeneratednotfixed = $totalAmountGeneratednotfixed+$cost_base_rate;
$totalAmountGenerated = number_format($totalAmountGeneratednotfixed, 2, '.', '');
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
          <li class="menu-active"><a href="#">Make Payment</a></li>
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

              <tr>
              <td>Amount(RM)</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" id="amount" name="amount" value="<?php echo $totalAmountGenerated; ?>" readonly></td>
            </tr>
            <tr>
            <td>Additional Amount(RM)</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="number" id="Addamount" name="Addamount" value="0"></td>
          </tr>
          <tr>
          <td>Total Amount(RM)</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td><input type="text" id="totalAmount" name="totalAmount" value="0" readonly></td>
        </tr>

        <tr>
        <td>Customer Pay</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="text" id="customerPay" name="customerPay" value="0" ></td>
      </tr>

        <input type="hidden" name="id" value="<?php echo $TowTruckAssign_ID; ?>">
        <input type="hidden" name="custName" value="<?php echo $custName; ?>">
        <input type="hidden" name="driverName" value="<?php echo $driverName; ?>">

        <input type="hidden" name="cost_base_rate" value="<?php echo $cost_base_rate; ?>">
        <input type="hidden" name="cost_distance_rate" value="<?php echo $cost_distance_rate; ?>">
        <input type="hidden" name="requestDistance" value="<?php echo $requestDistance; ?>">
        <input type="hidden" name="cost_urgency_rate" value="<?php echo $cost_urgency_rate; ?>">
        <input type="hidden" name="Request_Urgency" value="<?php echo $Request_Urgency; ?>">
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">

      <td></td><td></td><td><input type="submit" name="makePayment" value="Pay" style="float: right;"></td>

            </tr>
          </table>
        </form>

    </div>
  </section><!-- #hero -->
  <script>
    // Function to update total amount dynamically
    function updateTotalAmount() {
        var amount = parseFloat(document.getElementById('amount').value) || 0;
        var Addamount = parseFloat(document.getElementById('Addamount').value) || 0;

        // Calculate the totalAmount
        var totalAmount = amount + Addamount;

        // Update the value of totalAmount field
        document.getElementById('totalAmount').value = totalAmount.toFixed(2);
    }
    function confirmPayment() {
        // Display a confirmation dialog
        var confirmation = confirm("Are you sure you want to close this Tow Truck Assigment");
        if (confirmation) {
            // If user clicks "OK," build the URL with query parameters
            var url = 'crud.php';
            url += '?amount=' + encodeURIComponent(document.getElementById('amount').value);
            url += '&Addamount=' + encodeURIComponent(document.getElementById('Addamount').value);
            url += '&payment_method=' + encodeURIComponent(document.getElementById('payment_method').value);
            url += '&custName=' + encodeURIComponent(document.getElementById('custName').value);
            url += '&driverName=' + encodeURIComponent(document.getElementById('driverName').value);

            // Open a new tab with the constructed URL
            window.open(url, '_blank');

            // Redirect the original tab to viewTA.php
            window.location.href = 'viewTA.php';
        }
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
