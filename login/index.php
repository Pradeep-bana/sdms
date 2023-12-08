<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
$class = $_SESSION['class'];
if (strlen($_SESSION['sid']==0)) {
 header('location:../logout.php');
} 
$query = mysqli_query($con,"SELECT * FROM students"); 
$dataPoints = array();
while($row=mysqli_fetch_array($query)){
    array_push($dataPoints, array("label"=> $row['studentName'],  "y"=> $row['total'])); 
}
print_r($dataPoints);
?>