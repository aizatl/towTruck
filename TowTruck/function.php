<?php
function getNumOfapplication(){
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql="select * from permohonan";
   $qry = mysqli_query($con,$sql);  //run query
   return $qry;
}

function getNumOfPurchase(){
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql="select * from customer";
   $qry = mysqli_query($con,$sql);  //run query
   return $qry;
}

function getAllBill(){
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql="select b.issue_date,b.due_date,b.total_amount,b.totalAmountPaid,b.status,
            c.Customer_FirstName from billing b LEFT JOIN customer c ON b.customer_id = c.customer_id";
   $qry = mysqli_query($con,$sql);  //run query
   return $qry;
}

function getAllTr(){
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql="SELECT *, c.Customer_FirstName,c.Customer_LastName, ser.ServiceType_Name
       FROM towing_request
       LEFT JOIN customer c ON towing_request.customer_id = c.Customer_ID
       LEFT JOIN service_type ser ON towing_request.ServiceType_ID = ser.ServiceType_ID;";
   $qry = mysqli_query($con,$sql);  //run query
   return $qry;
}

function getAllTA(){
  $con=mysqli_connect("localhost", "root", "root", "a");
  if (mysqli_connect_errno())     //check connection is establish
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit;   //terminate the script
   }
   $sql="SELECT *, d.Driver_FirstName,tt.TowTruck_Registration_Number, tr.Towing_Request_ID, sr.serviceType_Name, tr.customer_id
       FROM tow_truck_assignment
       LEFT JOIN driver d ON tow_truck_assignment.Driver_ID = d.Driver_ID
       LEFT JOIN tow_truck tt ON tow_truck_assignment.TowTruck_ID  = tt.TowTruck_ID
       LEFT JOIN towing_request tr ON tow_truck_assignment.Towing_Request_ID  = tr.Towing_Request_ID
       LEFT JOIN service_type sr ON tow_truck_assignment.ServiceType_ID  = sr.ServiceType_ID
       ;";
   $qry = mysqli_query($con,$sql);  //run query
   return $qry;
}

function getTowingbyMonth($month){
  //create connection
  $con=mysqli_connect("localhost", "root", "root", "a");
  	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: ".mysqli_connect_error();
  		exit;
  	}
  	$sql="select * from pembelian where tarikhBeli between '".$start."'";


  	$qry=mysqli_query($con,$sql);
  	return $qry;
}

 ?>
