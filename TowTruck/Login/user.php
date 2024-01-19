<?php
//validate password

function validatePassword($username, $password)
{
  $con=mysqli_connect("localhost", "web2", "web2", "primareka");
  if(!$con)
  {
    echo mysqli_connect_error();
    exit;
  }
  $sql = "SELECT * FROM users where id = '".$username ."' and password = '".$password."'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);

  if($count == 1){
    return true;
  }
  else {
    return false;
  }
}

function getUserType ($username)
{
  $con=mysqli_connect ("localhost","web2","web2","primareka");
  if (!$con)
  {
    echo mysqli_connect_error();
    exit;
  }
  $sql="SELECT * FROM users where id = '".$username ."'";
  $result=mysqli_query($con,$sql);
  $count=mysqli_num_rows($result);
  if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $userType=$row['userType'];
    return $userType;
  }
}

?>
