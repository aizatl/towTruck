<?php
//validate password

function validatePassword($username, $password)
{

  include "connectDB.php";
  $sql = "SELECT * FROM admin where username = '".$username ."' and password = '".$password."'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);

  if($count == 1){
    return true;
  }
  else {
    return false;
  }
}
?>
