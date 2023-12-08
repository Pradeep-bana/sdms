<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// $class = $_SESSION['class'];
// if (strlen($_SESSION['sid']==0)) {
//  header('location:logout.php');
// } 
//before submit
$currDate = date("Y\-m\-d");
if(isset($_POST['parent'])){

    $studentName = $_POST['studentName'];
    $stream = $_POST['stream'];
    $class = $_POST['class'];
    $query = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total, students.studentno FROM attendance INNER JOIN students ON attendance.studentno=students.studentno WHERE attend='present' and students.studentName='$studentName' and students.stream='$stream' and students.class='$class' and attendance.att_time GROUP BY MONTH(attendance.att_time);");   
    $query2 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total, students.studentno FROM attendance INNER JOIN students ON attendance.studentno=students.studentno WHERE attend='absent' and students.studentName='$studentName' and students.stream='$stream' and students.class='$class' and attendance.att_time GROUP BY MONTH(attendance.att_time);");
    $query0 = mysqli_query($con,"SELECT attendance.attend FROM attendance INNER JOIN students ON attendance.studentno=students.studentno where students.studentName='unk' and attendance.att_time='$currDate';");
}
if (mysqli_num_rows($query) == 0) {
  // sleep(100000);
  echo "<script>alert('Wrong Details, please try again.');</script>";
  echo "<script>window.location.href='index2.php';</script>";

}


    /*useful query
    SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='present' GROUP BY MONTH(att_time),staff_attend.staff_no; 
    updated query
    SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='present' and staff_attend.att_time BETWEEN '2023-07-18' AND '2023-07-18' GROUP BY staff_attend.staff_no;
    */

      $dataPoints = array();
      $dataPoints2 = array();
    // $dataPoints = array( 
    //     array("label"=>"Industrial", "y"=>51.7),
    //     array("label"=>"Transportation", "y"=>26.6),
    //     array("label"=>"Residential", "y"=>13.9),
    //     array("label"=>"Commercial", "y"=>70.8)
    // );
     //Best practice is to create a separate file for handling connection to database
     try{

        while($row=mysqli_fetch_array($query)){
            array_push($dataPoints, array("label"=> $row['month'],  "y"=> $row['total'])); 
        }

        while($row=mysqli_fetch_array($query2)){
            array_push($dataPoints2, array("label"=> $row['month'],  "y"=> $row['total'])); 
        }
            // array_push($dataPoints, array("label"=> "absent",  "y"=> $t_absent)); 
            // array_push($dataPoints, array("label"=> "total",  "y"=> $t_total)); 
     }
     catch(\PDOException $ex){
         print($ex->getMessage());
     }
         
     ?>
     <!DOCTYPE HTML>
     <html>
     <?php @include("includes/head.php"); ?>
     <head>  
     <script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "presents"
	},
	data: [{
		type: "column",
		indexLabel: "{y}",
		// yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer2", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "absents"
	},
	data: [{
		type: "column",
		indexLabel: "{y}",
		// yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
     </head>
     <body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Student Details</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
       
      <div class="shadow p-3 mb-3 bg-body-tertiary rounded"><h4>You are <?php while($row0=mysqli_fetch_array($query0)){ echo " ".$row0['attend']; }?> today.<h4> </div>
      <div class=" row card-body">
  <?php
  $ret2=mysqli_query($con,"select * from  students where students.studentName='$studentName'");
  while ($row=mysqli_fetch_array($ret2))
  {
    //couting total fees
    include('includes/nullTo0.php');
    $totalFee = $n2018+$n2019+$n2020+$n2021+$n2022+$n2023;
    ?> 
    <div class="col-md-4">
      <img src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="100" height="100">
    </div>
    <div class="col-md-8">
      <table>
         <tr>
          <th>Student Number</th>
          <td>&nbsp;<?php  echo $row['studentno'];?></td>
        </tr>
        <tr>
          <th>Names</th>
          <td><?php  echo $row['studentName'];?></td>
        </tr>
        <tr>
          <th>Class</th>
          <td><?php  echo $row['class'];?></td>
        </tr>
        <tr>
          <th>Contact No.</th>
          <td><?php  echo $row['contactno'];?></td>
        </tr>
        <tr>
          <th>Payable Fee.</th>
          <td><?php  echo $totalFee;?></td>
        </tr>
      </table>
    </div>
    <?php 
  } ?>
</div>

      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <br/>
      <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
      </div>

    <!-- /.content-wrapper -->
    <?php @include("includes/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

  <!-- ./wrapper -->
  <?php @include("includes/foot.php"); ?>

     <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
     </body>
     </html>                              