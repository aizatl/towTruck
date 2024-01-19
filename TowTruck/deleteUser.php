<?php

if(isset($_GET['id'])) {
    // Retrieve the Customer_ID from the URL
    $customerId = $_GET['id'];
    $con=mysqli_connect("localhost", "root", "root", "a");
    if (mysqli_connect_errno())     //check connection is establish
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
    $sql = "DELETE FROM customer WHERE Customer_ID=$customerId";
    $result = mysqli_query($con,$sql);  //run query

    if ($result) {
      echo "<script>
      alert('Successfully delete a customer');
      window.location.href='viewCustomer.php';
      </script>";
    } else {
        echo "<script>
        alert('Error, cannot delete');
        window.location.href='viewCustomer.php';
        </script>";
    }
}

 ?>
