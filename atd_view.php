<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
if(isset($_GET['dt'])){
    $dt = $_GET['dt'];
}

if(isset($_POST['update']))
{
  
  // $attend=$_POST['attend'];
  $att_time = 'now()';
  $sql = "UPDATE students SET attend=:attend, att_time=:att_time where id='16'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':attend',$attend,PDO::PARAM_STR);
  $query->bindParam(':att_time',$att_time,PDO::PARAM_STR);
  $query->execute();
if ($query->execute()) {
  echo "New record created successfully";
} else {
  echo "Error: " ;
}
}
if(isset($_POST['submit']))
{
  // sleep(5);
  // $cur_date = date('Y-m-d');
  // $my_date = date('d/m/Y',strtotime($date));
  // echo $today;
  
  $attend=$_POST['attend'];
  if($con){
    
    foreach($attend as $atn_key => $atn_value){
      if($atn_value == "absent"){
        $query = mysqli_query($con, "INSERT INTO `attendance` (`studentno`, `attend`, `att_time`) VALUES ($atn_key, 'absent', now());");
      }
      if($atn_value == "present"){
        $query = mysqli_query($con, "INSERT INTO `attendance` (`studentno`, `attend`, `att_time`) VALUES ($atn_key, 'present', now());");
      }
    }
  
    // if($attend=='absent'){
    //   $query = mysqli_query($con, "INSERT INTO `attendance` (`studentno`, `attend`, `att_time`) VALUES ('1', 'present', 'nothing');");
    // }
  }else{
    echo 'connection off';
  }

  if($query){
    echo "<script>alert(6)</script>";
  }else{
    echo 'errror';
  }
}
$class = $_SESSION['class'];
?>
<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php @include("includes/header.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php @include("includes/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            <h2 class="m-0 font-weight-bold text-primary">View Attendance</h2>
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

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">View Attendance <?php echo " ".$dt ?></h3>
                  <div class="card-tools">
                    <a href="atd_index.php"><button type="button" class="btn btn-sm btn-primary"  ><span style="color: #fff;">BACK</span>
                    </button> </a>                  
                  </div>
                </div>
                <!-- /.card-header -->
                <!--   end modal -->

                <div class="card-body mt-2 " >
                <form role="form" id=""  method="post" >
                  <table id="example1" class="table table-bordered table-hover">
                    <thead> 
                      <tr> 
                        <th>#</th>
                        <th>Student Image</th>
                        <th>Student Number</th>
                        <th>Student Name</th>
                        <th>Class </th>
                        <th>Action</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php $query=mysqli_query($con,"SELECT students.studentImage, students.studentName, students.studentno, students.class, attendance.attend FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE att_time='$dt';");
                      $cnt=1;
                      while($row=mysqli_fetch_array($query))
                      {
                        ?>                  
                        <tr>
                          <td><?php echo htmlentities($cnt);?></td>
                          <td class="align-middle"><a href="#"><img src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="40" height="40"> </a></td>
                          <td><?php echo htmlentities($row['studentno']);?></td>
                          <td><?php echo htmlentities($row['studentName']);?></td>
                          <td><?php echo htmlentities($row['class']);?></td>
                          <td>
                          <input type="radio" name="attend[<?php echo $row['studentno']; ?>]" value="present" <?php if($row['attend']=='present'){ echo 'checked';} ?> >P
						             <input type="radio" name="attend[<?php echo $row['studentno']; ?>]" value="absent" <?php if($row['attend']=='absent'){ echo 'checked';} ?> >A
                          </td>
                        </tr> 
                        <?php $cnt=$cnt+1;
                      } ?>
                      
                    </tbody>
                  </table>
                    <div class="text-center mt-2">
                      <button name="submit" type="submit" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Submit</button>
                      <button name="update" type="submit" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Update</button>
                    </div>

                   </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
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
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.edit_data',function(){
        var edit_id=$(this).attr('id');
        $.ajax({
          url:"edit_student.php",
          type:"post",
          data:{edit_id:edit_id},
          success:function(data){
            $("#info_update").html(data);
            $("#editData").modal('show');
          }
        });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.edit_data2',function(){
        var edit_id2=$(this).attr('id');
        $.ajax({
          url:"view_student_info.php",
          type:"post",
          data:{edit_id2:edit_id2},
          success:function(data){
            $("#info_update2").html(data);
            $("#editData2").modal('show');
          }
        });
      });
    });
  </script>
  <script src="js/swal.js"></script>
</body>
</html>
