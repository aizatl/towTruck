<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$con=mysqli_connect("localhost", "root", "root", "a");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['Customer_ID'];
    $firstName = $_POST['Customer_FirstName'];
    $lastName = $_POST['Customer_LastName'];
    $phoneNumber = $_POST['Customer_PhoneNum'];
    $address = $_POST['Customer_Address'];
    $con=mysqli_connect("localhost", "root", "root", "a");
    if (mysqli_connect_errno())     //check connection is establish
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
    $sql = "UPDATE customer SET Customer_FirstName='$firstName', Customer_LastName='$lastName', Customer_PhoneNum='$phoneNumber', Customer_Address='$address' WHERE Customer_ID=$id";
    $result = mysqli_query($con,$sql);  //run query

    if ($result) {
      echo "<script>
      alert('Successfully edit a customer');
      window.location.href='viewCustomer.php';
      </script>";
    } else {
        echo "<script>
        alert('Error, cannot edit');
        window.location.href='viewCustomer.php';
        </script>";
    }
}
else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){
  $firstName = $_POST['Customer_FirstName'];
  $lastName = $_POST['Customer_LastName'];
  $phoneNumber = $_POST['Customer_PhoneNum'];
  $address = $_POST['Customer_Address'];
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql = "INSERT INTO customer (Customer_FirstName, Customer_LastName, Customer_PhoneNum, Customer_Address) VALUES ('$firstName', '$lastName', '$phoneNumber', '$address')";
   $result1 = mysqli_query($con,$sql);  //run query

   if ($result1) {
     echo "<script>
     alert('Successfully add a customer');
     window.location.href='viewCustomer.php';
     </script>";
   } else {
       echo "<script>
       alert('Error, cannot add');
       window.location.href='addCustomer.php';
       </script>";
   }
}

else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editTR'])) {
    $id = $_POST['id'];
    $customerFirstName = $_POST['Customer_FirstName'];
    $serviceTypeName = $_POST['Service_Type'];
    $Request_Date = $_POST['Request_Date'];
    $Request_Time = $_POST['Request_Time'];
    $Pickup_Location = $_POST['Pickup_Location'];
    $Reason_For_Tow = $_POST['Reason_For_Tow'];
    $Request_Distance = $_POST['Request_Distance'];


    if (mysqli_connect_errno())     //check connection is establish
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
    $sql = "UPDATE towing_request SET
        Customer_ID = '$customerFirstName',
        ServiceType_ID = '$serviceTypeName',
        Request_Date = '$Request_Date',
        Request_Time = '$Request_Time',
        Pickup_Location = '$Pickup_Location',
        Reason_For_Tow = '$Reason_For_Tow',
        Request_Distance = '$Request_Distance'
        WHERE Towing_Request_ID = $id";
    $result = mysqli_query($con,$sql);  //run query

    if ($result) {
      echo "<script>
      alert('Successfully edit a towing req');
      window.location.href='viewNT.php';
      </script>";
    } else {
        echo "<script>
        alert('Error, cannot edit');
        window.location.href='viewNT.php';
        </script>";
    }


  }
  else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addTR'])){
    $customerFirstName = $_POST["Customer_FirstName"];
    $serviceTypeID = $_POST["ServiceType_ID"];
    $requestDate = $_POST["Request_Date"];
    $requestTime = $_POST["Request_Time"];
    $pickupLocation = $_POST["Pickup_Location"];
    $reasonForTow = $_POST["Reason_For_Tow"];
    $requestUrgency = $_POST["Request_Urgency"];
    $requestDistance = $_POST["Request_Distance"];

    // Now you have all the form values in respective variables
    // You can perform database operations, validation, etc., with these values
    // For example, inserting into a database:
    $con = mysqli_connect("localhost", "root", "root", "a");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit; //terminate the script
    }

    // Perform SQL query to insert into your database using the retrieved variables
    // For instance:
    $sql = "INSERT INTO towing_request (Customer_ID, ServiceType_ID, Request_Date, Request_Time, Pickup_Location, Reason_For_Tow, Request_Urgency, Request_Distance) VALUES ('$customerFirstName', '$serviceTypeID', '$requestDate', '$requestTime', '$pickupLocation', '$reasonForTow', '$requestUrgency', '$requestDistance')";
    if (mysqli_query($con, $sql)) {
      echo "<script>
      alert('Successfully add a customer');
      window.location.href='viewNT.php';
      </script>";
    } else {
      echo "<script>
      alert('Error, cannot add');
      window.location.href='addNT.php';
      </script>";
    }
  }

  else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editTA'])){
    $id = $_POST["id"];
    $Driver_ID  = $_POST["Driver_ID"];
    $TowTruck_ID  = $_POST['TowTruck_ID'];
    $Towing_Request_ID  = $_POST["Towing_Request_ID"];
    $TowTruckAssign_Time = $_POST["TowTruckAssign_Time"];
    $TowTruckAssign_Details = $_POST["TowTruckAssign_Details"];
    $TowTruckAssign_Location = $_POST["TowTruckAssign_Location"];
    $TowTruckAssign_Duration = $_POST["TowTruckAssign_Duration"];
    $ServiceType_ID  = $_POST['ServiceType_ID'];
    $vehicle_type  = $_POST['vehicle_type'];

    // Now you have all the form values in respective variables
    // You can perform database operations, validation, etc., with these values
    // For example, inserting into a database:
    $con = mysqli_connect("localhost", "root", "root", "a");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit; //terminate the script
    }

    // Perform SQL query to insert into your database using the retrieved variables
    // For instance:
    $sql = "UPDATE tow_truck_assignment
        SET Driver_ID = '$Driver_ID',
            TowTruck_ID = '$TowTruck_ID',
            Towing_Request_ID = '$Towing_Request_ID',
            TowTruckAssign_Time = '$TowTruckAssign_Time',
            TowTruckAssign_Details = '$TowTruckAssign_Details',
            TowTruckAssign_Location = '$TowTruckAssign_Location',
            TowTruckAssign_Duration = '$TowTruckAssign_Duration',
            vehicle_type = '$vehicle_type',
            ServiceType_ID = '$ServiceType_ID'
        WHERE TowTruckAssign_ID = '$id'";
    if (mysqli_query($con, $sql)) {
      echo "<script>
      alert('Successfully edit a tow truck assigment');
      window.location.href='viewTA.php';
      </script>";
    } else {
      echo "<script>
      alert('Error, cannot edit');
      window.location.href='towTruckAssigment.php';
      </script>";
    }
  }

  else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addTA'])){
    $Driver_ID  = $_POST["Driver_ID"];
    $TowTruck_ID  = $_POST['TowTruck_ID'];
    $Towing_Request_ID  = $_POST["Towing_Request_ID"];
    $TowTruckAssign_Time = $_POST["TowTruckAssign_Time"];
    $TowTruckAssign_Details = $_POST["TowTruckAssign_Details"];
    $TowTruckAssign_Location = $_POST["TowTruckAssign_Location"];
    $TowTruckAssign_Duration = $_POST["TowTruckAssign_Duration"];
    $ServiceType_ID  = $_POST['ServiceType_ID'];
    $vehicle_type  = $_POST['vehicle_type'];

    // Now you have all the form values in respective variables
    // You can perform database operations, validation, etc., with these values
    // For example, inserting into a database:
    $con = mysqli_connect("localhost", "root", "root", "a");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit; //terminate the script
    }

    // Perform SQL query to insert into your database using the retrieved variables
    // For instance:
    $sql = "INSERT INTO tow_truck_assignment (assigmentStatus, Driver_ID, TowTruck_ID, Towing_Request_ID, vehicle_type, TowTruckAssign_Time, TowTruckAssign_Details, TowTruckAssign_Location, TowTruckAssign_Duration, ServiceType_ID)
VALUES ('ongoing','$Driver_ID', '$TowTruck_ID', '$Towing_Request_ID', '$vehicle_type', '$TowTruckAssign_Time', '$TowTruckAssign_Details', '$TowTruckAssign_Location', '$TowTruckAssign_Duration', '$ServiceType_ID');
";
if (mysqli_query($con, $sql)) {
  echo "<script>
  alert('Successfully add a customer');
  window.location.href='viewTA.php';
  </script>";
} else {
  echo "<script>
  alert('Error, cannot add');
  window.location.href='addTA.php';
  </script>";
}
  }

  else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['makePayment'])){
    $id  = $_POST["id"];
    $customer_id  = $_POST["customer_id"];
    $amount  = $_POST["amount"];
    $Addamount  = $_POST['Addamount'];
    $CaltotalAmount = $amount + $Addamount;
    $totalAmount = number_format($CaltotalAmount, 2, '.', '');
    $payment_method  = $_POST["payment_method"];
    $custName  = $_POST["custName"];
    $driverName  = $_POST["driverName"];
    $cost_base_rate  = $_POST["cost_base_rate"];
    $cost_distance_rate  = $_POST["cost_distance_rate"];
    $requestDistance  = $_POST["requestDistance"];
    $cost_urgency_rate  = $_POST["cost_urgency_rate"];
    $Request_Urgency  = $_POST["Request_Urgency"];
    $customerPay  = $_POST["customerPay"];
    $remaining = $totalAmount - $customerPay;
    $remaining = number_format($remaining, 2, '.', '');

    $con = mysqli_connect("localhost", "root", "root", "a");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit; //terminate the script
    }



    $todayDate = date("Y-m-d");
    $twoWeeksLater = date("Y-m-d", strtotime($todayDate . " +2 weeks"));
    if($remaining == 0){
        $sqlBilling = "INSERT INTO billing (customer_id , issue_date, due_date, total_amount, status, totalAmountPaid) VALUES ('$customer_id', '$todayDate', '$twoWeeksLater', '$totalAmount', 'paid', 0)";
        $statusPaid = "Full Paid";
    }else{
      $sqlBilling = "INSERT INTO billing (customer_id , issue_date, due_date, total_amount, status, totalAmountPaid) VALUES ('$customer_id', '$todayDate', '$twoWeeksLater', '$totalAmount', 'partially', '$customerPay')";
      $statusPaid = "Partially Paid";
    }
    $resultBilling = mysqli_query($con,$sqlBilling); //insert into biling

    $sqlGetLatestBillingID = "SELECT billing_id FROM billing ORDER BY billing_id desc limit 1;";
    $getBillingID = mysqli_query($con,$sqlGetLatestBillingID); // get the biling id added
    $row = mysqli_fetch_assoc($getBillingID);
    $latestBillingID = $row['billing_id'];


    $sqlPaymentTrans = "INSERT INTO payment_transaction (billing_id ,payment_date , amount, TowTruckAssign_ID,  payment_method)
                                                VALUES ('$latestBillingID','$todayDate', '$totalAmount', '$id', '$payment_method')";
    $resultPaymentTrans = mysqli_query($con,$sqlPaymentTrans);
    $sqlChangeStatus = "UPDATE tow_truck_assignment
                  SET assigmentStatus = 'done', billing_id = $latestBillingID
                  WHERE TowTruckAssign_ID = $id;
                  ";
    $result = mysqli_query($con,$sqlChangeStatus);

    ?>



    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .receipt {
            width: 300px;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        button {
        background-color: #686868 ;
        color: white;
        padding: 10px 15px;
        margin-top: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #1C1C1B ;
    }
    </style>
</head>
<body>

<div class="receipt">
    <h2 style="text-align: center;">Receipt</h2>
    <h3><?php echo $statusPaid; ?></h3>
    <table>
      <tr>
          <td>Customer Name</td>
          <td><?php echo $custName; ?></td>
      </tr>
      <tr>
          <td>Driver Name</td>
          <td><?php echo $driverName; ?></td>
      </tr>
      <tr>
          <td>Base Rate</td>
          <td><?php echo $cost_base_rate; ?></td>
      </tr>

      <tr>
          <td>Distance</td>
          <td><?php echo $requestDistance; ?></td>
      </tr>
      <tr>
          <td>Cost per KM</td>
          <td><?php echo $cost_distance_rate; ?></td>
      </tr>
      <?php
        if($Request_Urgency > 0){
          ?>
          <tr>
              <td>Urgent</td>
              <td>Yes</td>
          </tr>
          <tr>
              <td>Urgent Rate</td>
              <td><?php echo $cost_urgency_rate; ?></td>
          </tr>
          <?php
        }
       ?>


      <tr>
          <td>Payment Method</td>
          <td><?php echo $payment_method; ?></td>
      </tr>
        <tr>
            <td>Amount(RM)</td>
            <td><?php echo $amount; ?></td>
        </tr>
        <tr>
            <td>Additional Amount(RM)</td>
            <td><?php echo $Addamount; ?></td>
        </tr>
        <tr>
            <td>Total Amount(RM)</td>
            <td><?php echo $totalAmount; ?></td>
        </tr>
        <tr>
            <td>Customer Pay</td>
            <td><?php echo $customerPay; ?></td>
        </tr>
        <tr>
            <td>Remaining To Pay</td>
            <td><?php echo $remaining; ?></td>
        </tr>

    </table>
    <!-- Back Button -->
    <button onclick="goBack()">Back</button>
    <button onclick="printReceipt()">Print Receipt</button>
</div>
<script>
    // Function to print the receipt
    function printReceipt() {
        window.print();
    }

    // Function to go back to viewTA.php
    function goBack() {
        window.location.href = 'viewTA.php';
    }
</script>
</body>
</html>
    <?php

  }
  else if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addPayment'])){
    $paymentMethod = $_POST['payment_method']; //tr
    $billID = $_POST['billID'];//both
    $amount = $_POST['amount'];
    $customerId = $_POST['customerId'];
    $TowTruckAssign_ID = $_POST['TowTruckAssign_ID'];
    $customerPay = $_POST['customerPay'];//both
    $totalAmountPaid = $_POST['paidAmount'];//to add with customerpay //sini
    $newTotalPaid = $customerPay+$totalAmountPaid;
    $con = mysqli_connect("localhost", "root", "root", "a");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit; //terminate the script
    }
    if($newTotalPaid == $amount){
      $sqlEditBilling = "UPDATE `billing` SET `totalAmountPaid` = '$newTotalPaid', `status` = 'paid' WHERE `billing`.`billing_id` = $billID;";
    }else{
      $sqlEditBilling = "UPDATE `billing` SET `totalAmountPaid` = '$newTotalPaid' WHERE `billing`.`billing_id` = $billID;";
    }
    $resultEditBilling = mysqli_query($con,$sqlEditBilling);//sini

    $todayDate2 = date("Y-m-d");
    $sqlAddPT = "INSERT INTO payment_transaction (billing_id , TowTruckAssign_ID , payment_date, amount, payment_method)
            VALUES ('$billID','$TowTruckAssign_ID','$todayDate2','$customerPay','$paymentMethod')";
    $resultAddPT = mysqli_query($con,$sqlAddPT);//sini
    if ($resultAddPT || $resultEditBilling) {
      echo "<script>
      alert('Successfully add payment');
      window.location.href='viewTA.php';
      </script>";
    } else {
      echo "<script>
      alert('Error, cannot add');
      window.location.href='viewTA.php';
      </script>";
    }

  }

    ?>
