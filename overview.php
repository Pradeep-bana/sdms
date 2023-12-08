<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$class = $_SESSION['class'];
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
    if(isset($_GET['dt'])){
        $dt = $_GET['dt'];
        if($class=='Admin'){
          $query = mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend, attendance.id FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt';");
          $query2 = mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend, attendance.id FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt';");
        }else{
          $query = mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend, attendance.id FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt' AND class='$class';");
          $query2 = mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend, attendance.id FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt' AND class='$class';");
        }
        $t_present=0;
        $t_absent=0;
    
        while($row=mysqli_fetch_array($query)){
            if($row['attend'] == 'present'){
                $t_present++;
            }
            if($row['attend'] == 'absent'){
                $t_absent++;
            }
        }
        $t_total = $t_absent+$t_present;
    } 

     $dataPoints = array();
     //Best practice is to create a separate file for handling connection to database
     try{
            array_push($dataPoints, array("label"=> "present",  "y"=> $t_present)); 
            array_push($dataPoints, array("label"=> "absent",  "y"=> $t_absent)); 
            array_push($dataPoints, array("label"=> "total",  "y"=> $t_total)); 
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
     window.onload = function () {
      
     var chart = new CanvasJS.Chart("chartContainer", {
         animationEnabled: true,
         exportEnabled: true,
         theme: "light1", // "light1", "light2", "dark1", "dark2"
         title:{
             text: " <?php echo $dt ?> Attendance"
         },
         data: [{
          type: "pie",
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
      </section>
      <div id="chartContainer" style="height: 370px; width: 100%;">
    
      </div>
      <div class="table-responsive table-bordered">
        <?php //$query = mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend, attendance.id FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt' AND class='$class';");
        ?>
      <font size="">
      <table class="table table-bordered table-hover">
        <thead>
            <tr>
            <th width="10%">#</th>
            <th width="40%">Image</th>
            <th width="30%">Name</th>
            <th width="20%">Roll No.</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            while($row=mysqli_fetch_array($query2)){?>
            <tr>
            <th scope="row"><?php echo $count; $count++?></th>
            <td style="padding:0px" scope="row" class="align-middle"><a href="#"><img src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="60" height="auto"> </a></td>
            <td scope="row" bgcolor="<?php if($row['attend'] == 'present'){echo '#5080BE';} if($row['attend'] == 'absent'){echo '#C0504E';} ?>"><?php if($row['attend'] == 'present'){ echo $row['studentName'];} if($row['attend']=='absent'){echo $row['studentName'];}?></td>
            <td><?php echo $row['studentno'];?></td>
            </tr>
            <tr>
        <?php } ?>
        </tbody>
    </table>
      </font>
    </div>
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