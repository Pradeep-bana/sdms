<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$class = $_SESSION['class'];
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
$currDate = date("Y\-m\-d");
    if($class=='Admin'){
      $query = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='present' AND attendance.att_time BETWEEN '2023-07-01' AND '$currDate' GROUP BY attendance.studentno;");    
      $query2 = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='absent' AND attendance.att_time BETWEEN '2023-07-01' AND '$currDate' GROUP BY attendance.studentno;");   
    }else{
      $query = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='present' AND students.class='$class' AND attendance.att_time BETWEEN '2023-07-01' AND '$currDate' GROUP BY attendance.studentno;");    
      $query2 = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='absent' AND students.class='$class' AND attendance.att_time BETWEEN '2023-07-01' AND '$currDate' GROUP BY attendance.studentno;");
    }
     
    if($class=='Admin'){
      $newPresent = 'Welcome Admin';
    }else{
      $isPresent = mysqli_query($con,"SELECT staff_attend.attend FROM staff_attend INNER JOIN tblusers ON staff_attend.staff_no=tblusers.staff_no where tblusers.username='$username' and tblusers.t_class='$class' and staff_attend.att_time='$currDate'");
      while($is_Present=mysqli_fetch_array($isPresent)){
        $pre_ab = $is_Present['attend'];
      }
      $newPresent = $pre_ab == null ? 'holiday' : $pre_ab;
    }
    $query0 = mysqli_query($con,"SELECT COUNT(DISTINCT(att_time)) AS school_days FROM attendance");

if(isset($_POST['submit'])){
  $start = $_POST['start'];
  $end = $_POST['end'];

  if($class=='Admin'){
    $query = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='present' AND attendance.att_time BETWEEN '$start' AND '$end' GROUP BY attendance.studentno;");    
    $query2 = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='absent' AND attendance.att_time BETWEEN '$start' AND '$end' GROUP BY attendance.studentno;");   
  }else{
    $query = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='present' AND students.class='$class' AND attendance.att_time BETWEEN '$start' AND '$end' GROUP BY attendance.studentno;");    
    $query2 = mysqli_query($con,"SELECT COUNT(attendance.studentno) as total, students.studentName FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE attendance.attend='absent' AND students.class='$class' AND attendance.att_time BETWEEN '$start' AND '$end' GROUP BY attendance.studentno;");
  }
}
    
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
            array_push($dataPoints, array("label"=> $row['studentName'],  "y"=> $row['total'])); 
        }

        while($row=mysqli_fetch_array($query2)){
            array_push($dataPoints2, array("label"=> $row['studentName'],  "y"=> $row['total'])); 
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
		text: "total presents"
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
		text: "total absents"
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
            <div class="col-sm-10">
            <h4><?php echo $newPresent; ?><h4>
            </div>
            <div class="col-sm-2">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <?php if($class=='Admin'){$query1=mysqli_query($con,"Select * from students");}else{$query1=mysqli_query($con,"Select * from students where class='$class'");} ;
                                $totalcust=mysqli_num_rows($query1);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalcust;?></h3>
                                    <p>Total Students</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="student_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <?php if($class=='Admin'){$query2=mysqli_query($con,"Select * from students where gender='Male'");}else{$query2=mysqli_query($con,"Select * from students where gender='Male' and class='$class'");}
                                $totalmale=mysqli_num_rows($query2);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalmale;?></h3>

                                    <p>Total Male students</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="student_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <?php if($class=='Admin'){$query3=mysqli_query($con,"Select * from students where gender='Female'");}else{$query3=mysqli_query($con,"Select * from students where gender='Female' and class='$class'");}
                                $totalfemale=mysqli_num_rows($query3);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalfemale;?></h3>

                                    <p>Total female students</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="student_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            
      </section>
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
      <br>
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