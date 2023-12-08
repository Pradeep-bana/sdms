<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');



$currDate = date("Y\-m\-d");
if(isset($_POST['parent'])){
  

    $studentName = $_POST['studentName'];
    $stream = $_POST['stream'];
    $class = $_POST['class'];
    $presents = mysqli_query($con,"SELECT attendance.attend FROM attendance INNER JOIN students ON students.studentno=attendance.studentno WHERE studentName='$studentName' AND class='$class' AND stream='$stream' AND attendance.att_time='$currDate';");
    $t_present=0;
    $t_absent=0;

    while($row=mysqli_fetch_array($presents)){
        if($row['attend'] == 'present'){
            $t_present++;
        }
        if($row['attend'] == 'absent'){
            $t_absent++;
        }
    }
    $t_total = $t_absent+$t_present;


    $query3=mysqli_query($con,"select * from  students where studentName='$studentName' and stream='$stream' and class='$class';");
    // $query1 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total, students.studentno FROM attendance INNER JOIN students ON attendance.studentno=students.studentno WHERE attend='present' and students.studentName='$studentName' and students.stream='$stream' and students.class='$class' and attendance.att_time GROUP BY MONTH(attendance.att_time);");   
    // $query2 = mysqli_query($con,"SELECT MONTHNAME(att_time) as month, count(attendance.studentno) as total, students.studentno FROM attendance INNER JOIN students ON attendance.studentno=students.studentno WHERE attend='absent' and students.studentName='$studentName' and students.stream='$stream' and students.class='$class' and attendance.att_time GROUP BY MONTH(attendance.att_time);");
    $isPresent = mysqli_query($con,"SELECT attendance.attend FROM attendance INNER JOIN students ON attendance.studentno=students.studentno where students.studentName='$studentName' and stream='$stream' and class='$class' and attendance.att_time='$currDate';");
    while($is_Present=mysqli_fetch_array($isPresent)){
        $pre_ab = $is_Present['attend'];
    }
}
if (mysqli_num_rows($query3) == 0) {
  // sleep(100000);
  echo "<script>alert('Wrong Details, please try again.');</script>";
  echo "<script>window.location.href='index2.php';</script>";

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
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
 
  <p><h4><?php echo $newPresent = $pre_ab == null ? 'holiday' : $pre_ab ?></h4><p>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i> </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- <div class="dropdown-divider"></div>
        <a href="profile.php" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="changepassword.php" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> settings 
        </a> -->
        <!-- <div class="dropdown-divider"></div> -->
        <a href="logout.php" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> logout 
        </a>
      </div>
    </li>
  </ul>
</nav>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Profile Page</title>

    <meta name="author" content="Codeconvey" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

    <!--Only for demo purpose - no need to add.-->
    <!-- <link rel="stylesheet" href="css/demo.css" /> -->
    
	    <link rel="stylesheet" href="css/style2.css">
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
<body>

<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<?php while($info=mysqli_fetch_array($query3)){ ?>
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="studentimages/<?php echo $info['studentImage'] ?>" alt="student dp">
            <h3><?php echo $info['studentName'] ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Father Name:</strong><?php echo " ".$info['parentName'] ?></p>
            <p class="mb-0"><strong class="pr-1">Mother Name:</strong><?php echo " ".$info['relation'] ?></p>
            <p class="mb-0"><strong class="pr-1">Contact No:</strong><?php echo " ".$info['contactno'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Roll</th>
                <td width="2%">:</td>
                <td><?php echo " ".$info['studentno'] ?></td>
              </tr>
              <tr>
                <th width="30%">DOB</th>
                <td width="2%">:</td>
                <td><?php echo " ".$info['stream'] ?></td>
              </tr>
              <tr>
                <th width="30%">Gender</th>
                <td width="2%">:</td>
                <td><?php echo " ".$info['gender'] ?></td>
              </tr>
              <tr>
                <th width="30%">Samagra</th>
                <td width="2%">:</td>
                <td><?php echo " ".$info['samagra'] ?></td>
              </tr>
              <tr>
                <th width="30%">Aadhar</th>
                <td width="2%">:</td>
                <td><?php echo " ".$info['aadhar'] ?></td>
              </tr>
              <tr>
                <th width="40%">Payable Fee</th>
                <td width="2%">:</td>
                <td style="color: #b31625;"><?php echo $info['s2018']+$info['s2019']+$info['s2020']+$info['s2021']+$info['s2022']+$info['s2023'] ?> ₹</td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Total Presents</h3>
          </div>
          <div class="card-body pt-0">
            <p>you are <?php echo $newPresent ?> today
          
          <div id="chartContainer" style="height: 370px; width: 100%;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- partial -->
           
    		    </div>
		    </div>
    </div>
</section>
     

    <?php include('includes/foot.php');?>
    <!-- Analytics -->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
	</body>
</html>
