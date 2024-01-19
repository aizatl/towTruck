<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['id'])) {
    // Retrieve the Customer_ID from the URL
    $id = $_GET['id'];
    $con=mysqli_connect("localhost", "root", "root", "a");
    if (mysqli_connect_errno())     //check connection is establish
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     exit;   //terminate the script
     }
    $sql = "DELETE FROM towing_request WHERE Towing_Request_ID=$id";


    $result = mysqli_query($con,$sql);  //run query
    if ($result) {
      echo "<script>
      alert('Successfully delete a towing request');
      window.location.href='viewNT.php';
      </script>";
    } else {
        echo "<script>
        alert('Error, cannot delete');
        window.location.href='viewNT.php';
        </script>";
    }

}

 ?>
