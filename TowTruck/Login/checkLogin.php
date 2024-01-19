<?php
session_start();
include "user.php";
$_SESSION['username']=$_POST['username'];
$_SESSION['password']=$_POST['password'];
//$_SESSION['currentTime']=$_POST['

$username=$_POST['username'];
$password=$_POST['password'];

$isValidUser = validatePassword($username,$password);

if ($isValidUser)
  {
    $userType = getUserType ($username);
    if ($userType == 'admin')
      header ("location:../Menus/adminView.php");
    else if ($userType == 'staff')
      header ("location:../Menus/employeeView.php");

  }//if
  else {
      header("location:../Menus/mainPage.php?msg=failed");
      if (isset($_GET["msg"])&& $_GET["msg"]=='failed')
      {
        $message="Wrong Username or Password";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
  }

?>
