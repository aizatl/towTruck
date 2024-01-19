<?php
session_start();

include "checkLoginUser.php";

$_SESSION['username']=$_POST['username'];
$_SESSION['password']=$_POST['password'];
$username = $_POST['username'];
$password = $_POST['password'];



$isValidUser = validatePassword($username,$password);

if ($isValidUser)
  {

      $_SESSION['username'] = $username; //bagi
      echo "<script>
      alert('Succesfull Login');
      window.location.href='MainMenu.php';
      </script>";
  }//if
else {
        echo "<script>
        alert('Wrong Username or Password');
        window.location.href='index.php';
        </script>";
  }

?>
