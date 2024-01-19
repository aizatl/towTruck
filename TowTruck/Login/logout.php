<?php
session_start();
session_destroy();
header('Location:../Menus/mainPage.php');
?>
