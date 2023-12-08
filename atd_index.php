<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/swal.js"></script>

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
$class = $_SESSION['class'];
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
  $query = mysqli_query($con,"SELECT DISTINCT `att_time` FROM attendance");
  if($query){
    while ($result = $query->fetch_assoc()) {
			$db_date = $result['att_time'];
			$cur_date = date('Y-m-d');
			if ($cur_date == $db_date) {
				$msg = "<script>error1()</script>";
				echo $msg;
			}
		}
  }

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

  if($query && $cur_date !== $db_date){
    $msg = "<script>succ()</script>";
    echo $msg;
  }else{
    $msg = "<script></script>";
    echo $msg;
  }
}








if(isset($_POST['submit2'])&&$class=='Admin')
{
  // sleep(5);
  // $cur_date = date('Y-m-d');
  // $my_date = date('d/m/Y',strtotime($date));
  // echo $today;
  $query = mysqli_query($con,"SELECT DISTINCT `att_time` FROM attendance");
  if($query){
    while ($result = $query->fetch_assoc()) {
			$db_date = $result['att_time'];
			$cur_date = date('Y-m-d');
			if ($cur_date == $db_date) {
				$msg = "<script>error1()</script>";
				echo $msg;
			}
		}
  }

  $attend=$_POST['attend'];
  if($con){
    
    foreach($attend as $atn_key => $atn_value){
      if($atn_value == "absent"){
        $query = mysqli_query($con, "INSERT INTO `staff_attend` (`staff_no`, `attend`, `att_time`) VALUES ('".$atn_key."', 'absent', now());");
      }
      if($atn_value == "present"){
        $query = mysqli_query($con, "INSERT INTO `staff_attend` (`staff_no`, `attend`, `att_time`) VALUES ('".$atn_key."', 'present', now());");
      }
    }
  
    // if($attend=='absent'){
    //   $query = mysqli_query($con, "INSERT INTO `attendance` (`studentno`, `attend`, `att_time`) VALUES ('1', 'present', 'nothing');");
    // }
  }else{
    echo 'connection off';
  }

  if($query && $cur_date !== $db_date){
    $msg = "<script>succ()</script>";
    echo $msg;
  }else{
    $msg = "<script></script>";
    echo $msg;
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
            <h2 class="m-0 font-weight-bold text-primary">Take Attendance</h2>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Take Attendance</li>
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
                  <h3 class="card-title">Take Attendance</h3>
                  <div class="card-tools">
                    <a href="atd_date.php"><button type="button" class="btn btn-sm btn-primary"  ><span style="color: #fff;"><i class="fas fa-plus" ></i>  View Record</span>
                    </button> </a>                  
                  </div>
                </div>
                <!-- /.card-header -->
                <!--   end modal -->

                <div class="card-body mt-2 " >
                <form role="form" id=""  method="post" >
                  <?php if($class=='Admin'){?>
                    <table id="example1" class="table table-bordered table-hover">
                    <thead> 
                      <tr> 
                        <th>#</th>
                        <th>Image<th>
                        Name
                        <th>Mobile</th>
                        <th>Class </th>
                        <th>Attendance</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php $query=mysqli_query($con,"select * from tblusers order by staff_no");
                      $cnt=1;
                      while($row=mysqli_fetch_array($query))
                      {
                        ?>                  
                        <tr>
                          <td><?php echo htmlentities($cnt);?></td>
                          <td style="padding:1px" class="align-middle"><a href="#"><img src="staff_images/<?php echo htmlentities($row['userimage']);?>" width="50" height="50"> </a></td>
                          <td><?php echo htmlentities($row['name']);?><?php echo " ".htmlentities($row['lastname']);?></td>
                          <td><?php echo htmlentities($row['mobile']);?></td>
                          <td><?php echo htmlentities($row['t_class']);?></td>
                          <td>
                          <input type="radio" name="attend[<?php echo $row['staff_no']; ?>]" value="present">P
						             <input type="radio" name="attend[<?php echo $row['staff_no']; ?>]" value="absent">A
                          </td>
                        </tr> 
                        <?php $cnt=$cnt+1;
                      } ?>
                      
                    </tbody>
                  </table>
                  <?php }else{?>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead> 
                      <tr> 
                        <th>#</th>
                        <th>Student Image</th>
                        <th>Student Number</th>
                        <th>Student Name</th>
                        <th>Class </th>
                        <th>Attendance</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php $query=mysqli_query($con,"select * from students where class='".$class."'");
                      $cnt=1;
                      while($row=mysqli_fetch_array($query))
                      {
                        ?>                  
                        <tr>
                          <td><?php echo htmlentities($cnt);?></td>
                          <td style="padding:1px" class="align-middle"><a href="#"><img src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="50" height="50"> </a></td>
                          <td><?php echo htmlentities($row['studentno']);?></td>
                          <td><?php echo htmlentities($row['studentName']);?></td>
                          <td><?php echo htmlentities($row['class']);?></td>
                          <td>
                          <input type="radio" name="attend[<?php echo $row['studentno']; ?>]" value="present">P
						             <input type="radio" name="attend[<?php echo $row['studentno']; ?>]" value="absent">A
                          </td>
                        </tr> 
                        <?php $cnt=$cnt+1;
                      } ?>
                      
                    </tbody>
                  </table>
                  <?php }?>
                    <div class="text-center mt-2">
                      <button name="<?php echo $sub = $class=='Admin'?'submit2':'submit' ?>" type="submit" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Submit</button>
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
</body>
</html>
