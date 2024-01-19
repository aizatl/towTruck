<?php
$id = $_GET['id'];
$con=mysqli_connect("localhost", "root", "root", "a");
if (mysqli_connect_errno())     //check connection is establish
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 exit;   //terminate the script
 }
 $sql="SELECT * from billing where billing_id = '".$id."'";
 $qry = mysqli_query($con,$sql);  //run query

 $row = mysqli_fetch_assoc($qry);

    $billing_id = $row['billing_id'];
    $customer_id = $row['customer_id'];
    $issue_date = $row['issue_date'];
    $due_date = $row['due_date'];
    $total_amount = $row['total_amount'];
    $status = $row['status'];
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
        }
        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<br><br><br><br>
<div class="receipt">
    <h2>Billing Receipt</h2>

    <div class="receipt-item">
        <strong>Billing ID:</strong>
        <span><?php echo $billing_id; ?></span>
    </div>

    <div class="receipt-item">
        <strong>Customer ID:</strong>
        <span><?php echo $customer_id; ?></span>
    </div>

    <div class="receipt-item">
        <strong>Issue Date:</strong>
        <span><?php echo $issue_date; ?></span>
    </div>

    <div class="receipt-item">
        <strong>Due Date:</strong>
        <span><?php echo $due_date; ?></span>
    </div>

    <div class="receipt-item">
        <strong>Total Amount:</strong>
        <span><?php echo $total_amount; ?></span>
    </div>

    <div class="receipt-item">
        <strong>Status:</strong>
        <span><?php echo $status; ?></span>
    </div>

    <div class="buttons">
        <a href="viewTA.php" style="text-decoration: none; padding: 10px; background-color: #ccc;">Back</a>
        <button onclick="window.print()" style="padding: 10px; background-color: #ccc; color: #65007C; cursor: pointer;">Print</button>
    </div>

</div>

</body>
</html>
