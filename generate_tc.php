<link rel="stylesheet" type="text/css" href="css/style.css">

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_GET['id']) || isset($_POST['save']))
  {
    $id = $_GET['id'];
    
    $ret2=mysqli_query($con,"select * from  students where id='$id'");
  }else{
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    echo "<script>window.location.href='student_list.php'</script>";
  }
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
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Add Student</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
    <section class="content">
        <div class="container-fluid table-responsive">
        <form method="post" enctype="multipart/form-data" action="cert/index.php">
        <h5 class="text-center" style="color:red;">Student Details<h5>
        <table style="font-size:1rem" class="table table-bordered">
        <tbody>  
            <?php while ($row=mysqli_fetch_array($ret2)){ ?>
            <tr>
            <th scope="row">नाम</th>
            <td><input name="name" value="<?php echo $row['studentName']?>"  type="text"></td>
            </tr>
            <tr>
            <th scope="row">कक्षा</th>
            <td scope="row"><input name="class" value="<?php echo $row['class']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">पिता</th>
            <td><input name="father" value="<?php echo $row['parentName']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">माता</th>
            <td scope="row"><input name="mother" value="<?php echo $row['relation']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">जन्मतिथि(अंकों में)</th>
            <td scope="row"><input type='text' name="dob" value="<?php echo $row['stream']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">जन्मतिथि(शब्दों में)</th>
            <td scope="row"><input type='text' name="dob2" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">समग्र आईडी</th>
            <td scope="row"><input type='text' name="samagra" value="<?php echo $row['samagra']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">AADHAR</th>
            <td scope="row"><input name="aadhar" value="<?php echo $row['aadhar']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">जाति</th>
            <td scope="row"><input name="cast" value="<?php echo $row['occupation']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">पता</th>
            <td scope="row"><input name="addr" value="<?php echo $row['village']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">दूरभाष</th>
            <td scope="row"><input name="number" value="<?php echo $row['contactno']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">SSSM ID</th>
            <td scope="row"><input type='text' name="ssm_id" value="<?php echo $row['samagra']?>" type="text"></td>
            </tr>
            <tr>
            <th scope="row">सरल क्रमांक</th>
            <td scope="row"><input name="saral" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">वर्ग</th>
            <td scope="row"><input name="varg" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">from Date</th>
            <td scope="row"><input name="from_date" value="" type="date"></td>
            </tr>
            <tr>
            <tr>
            <th scope="row">to Date</th>
            <td scope="row"><input name="to_date" value="<?php echo date('d-m-Y') ?>" type="text"></td>
            </tr>
            <th scope="row">registration number</th>
            <td scope="row"><input name="reg_number" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">current year</th>
            <td scope="row"><input name="curr_year" value="<?php echo date('Y') ?>" type="text"></td>
            </tr>
            <th scope="row">Grade</th>
            <td scope="row"><input name="grade" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">registration Class</th>
            <td scope="row"><input name="reg_class" value="" type="text"></td>
            </tr>
            <th scope="row">leave reason</th>
            <td scope="row"><input name="leave_reason" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">Character</th>
            <td scope="row"><input name="character" value="" type="text"></td>
            <?php }?>
        </tbody>
        </table>
            <button type='submit' name='generate_tc' class="btn btn-primary">generate TC</button>
        <form>
    </div>
    </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php @include("includes/footer.php"); ?>

    </div>

    <!-- ./wrapper -->
    <?php @include("includes/foot.php"); ?>
  </body>
  </html>
  <?php
}?>
