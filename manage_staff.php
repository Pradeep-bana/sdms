<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$class = $_SESSION['class'];
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
//before submit
$currDate = date("Y\-m\-d");
if($class=='Admin'){
    $query = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='present' and staff_attend.att_time BETWEEN '2023-07-11' AND '$currDate' GROUP BY staff_attend.staff_no;");    
    $query2 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='absent' and staff_attend.att_time BETWEEN '2023-07-11' AND '$currDate' GROUP BY staff_attend.staff_no;");    
  }else{
    $query = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attend='present' AND class='$class' GROUP BY MONTH(att_time);");   
    $query2 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attend='absent' AND class='$class' GROUP BY MONTH(att_time);");
  }
  $query0 = mysqli_query($con,"SELECT COUNT(DISTINCT(att_time)) AS school_days FROM attendance");


if(isset($_POST['submit'])){
    $start = $_POST['start'];
    $end = $_POST['end'];

    $query = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='present' and staff_attend.att_time BETWEEN '".$start."' AND '".$end."' GROUP BY staff_attend.staff_no;");    
    $query2 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(staff_attend.staff_no) as total, tblusers.name FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no WHERE attend='absent' and staff_attend.att_time BETWEEN '".$start."' AND '".$end."' GROUP BY staff_attend.staff_no;");   
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
            array_push($dataPoints, array("label"=> $row['name'],  "y"=> $row['total'])); 
        }

        while($row=mysqli_fetch_array($query2)){
            array_push($dataPoints2, array("label"=> $row['name'],  "y"=> $row['total'])); 
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
    <?php @include("includes/header.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php @include("includes/sidebar.php"); ?>
    <div class="content-wrapper">
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
       
      <div class="shadow p-3 mb-3 bg-body-tertiary rounded"><h4>school took a total of <?php while($row0=mysqli_fetch_array($query0)){ echo " ".$row0['school_days']; }?> days<h4> </div>
      <div class="container">
        <form method="post" action="">
        <div class="row">
            <div class="col-sm">
                <input name="start" placeholder="Select date" type="date" id="example" class="form-control" value="<?php echo $start?>">
                <label for="example">From...</label>
            </div>
            <div class="col-sm md-form md-outline input-with-post-icon datepicker">
                <input name="end" placeholder="Select date" type="date" id="example" class="form-control" value="<?php echo $end?>">
                <label for="example">To...</label>
            </div>
            <div class="col-sm">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
         <form>
        <div>
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