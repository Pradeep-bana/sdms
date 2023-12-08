<?php
$str = $_SESSION['permission'] == 'Super User' ? 'false' : 'admin';
if($str == 'admin'){
  header('location:dashboard.php');
}
if (strlen($_SESSION['sid']==0)) {
    header('location:logout.php');
    }
?>