<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['submit']))
  {
    $names=$_POST['names'];
    $age=$_POST['age'];
    $studentno=$_POST['studentno'];
    $sex=$_POST['sex'];
    $class=$_POST['class'];
    $stream=$_POST['stream'];
    $parentname=$_POST['parentname'];
    $relation=$_POST['relation'];
    $ocupation=$_POST['ocupation'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $nextphone=$_POST['nextphone'];
    $tehsil=$_POST['tehsil'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $village=$_POST['village'];
    $photo=$_FILES["photo"]["name"];
    $samagra=$_POST['samagra'];
    $aadhar =$_POST['aadhar'];
    move_uploaded_file($_FILES["photo"]["tmp_name"],"studentimages/".$_FILES["photo"]["name"]);
    $query=mysqli_query($con, "insert into  students(studentno,StudentName,class,stream,age,gender,email,parentName,relation,occupation,tehsil,district,state,village,contactno,nextphone,studentImage,samagra,aadhar) value('$studentno','$names','$class','$stream','$age','$sex','$email','$parentname','$relation','$ocupation','$tehsil','$district','$state','$village','$phone','$nextphone','$photo','$samagra','$aadhar')");
    if ($query) {
      echo "<script>alert('Student has been registered.');</script>"; 
      echo "<script>window.location.href = 'add_student.php'</script>";   
      $msg="";
    }
    else
    {
      echo "<script>alert('Something Went Wrong. Please try again.');</script>";    
    }
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
          <div class="container-fluid">
            <div class="row ">
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Student</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <span style="color: brown"><h5>Student details</h5></span>
                      <hr>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label for="studentno">Roll No.</label>
                          <input type="text" class="form-control" id="studentno" name="studentno" placeholder="Enter student No" required>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="names">Names</label>
                          <input type="text" class="form-control" id="names" name="names" placeholder="Names" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="age">Age</label>
                          <input type="text" class="form-control" id="age" name="age" placeholder="age"required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="sex">Sex</label>
                          <select type="select" class="form-control" id="sex" name="sex"required>
                            <option>Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="age">Class</label>
                          <select type="select" class="form-control" id="class" name="class" required>
                            <option>Select Class</option>
                            <option value="S1">S1</option>
                            <option value=S2>S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="age">DOB<span style="color: blue;">*date of birth</span></label>
                          <input name="stream" placeholder="DOB" type="date" id="example" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputFile">Student Photo</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="" name="photo" id="photo" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <span style="color: brown"><h5>Parent details</h5></span>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label for="parentname">Father's Name</label>
                          <input type="text" class="form-control" id="parentname" name="parentname" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="relation">Mother's Name</label>
                          <input type="text" class="form-control" id="relation" name="relation"required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="age">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="sex">Cast</label>
                          <select type="select" class="form-control" id="ocupation" name="ocupation"required>
                            <option value="GENRAL">GENRAL</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="OBC">OBC</option>
                            <option value="EWS">EWS</option>
                            <option value="OTHER">OTHER</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3 offset-md-6">
                          <label for="phone1">Phone 1</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="nextphone">Phone 2</label>
                          <input type="text" class="form-control" id="nextphone" name="nextphone" placeholder="phone2" required>
                        </div>
                      </div>
                      <hr>
                      <span style="color: brown"><h5>Address</h5></span>
                      <div class="row">
                        <div class="form-group col-md-3 ">
                          <label for="tehsil">Tehsil</label>
                          <input type="text" class="form-control" id="tehsil" name="tehsil"required>
                        </div>
                        <div class="form-group col-md-3 ">
                          <label for="district">District</label>
                          <input type="text" class="form-control" id="district" name="district" placeholder="district"required>
                        </div>
                        <div class="form-group col-md-3 ">
                          <label for="county">State</label>
                          <input type="text" class="form-control" value="Madhya Pradesh" id="state" name="state" placeholder="State"required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="village">Village</label>
                          <input type="text" class="form-control" id="village" name="village" placeholder="Village"required>
                        </div>
                      </div>
                      <hr>
                      <span style="color: brown"><h5>Documents</h5></span>
                      <div class="row">
                      <div class="form-group col-md-3 ">
                          <label for="samagra">Samagra Id</label>
                          <input type="text" class="form-control" id="samagra" name="samagra" placeholder="Samagra Id"required>
                        </div>
                        <div class="form-group col-md-3 ">
                          <label for="Aadhar">Aadhar No.</label>
                          <input type="text" class="form-control" id="aadhar" name="aadhar" placeholder="Aadhar"required>
                        </div>
                      </div>    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
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

    </div>

    <!-- ./wrapper -->
    <?php @include("includes/foot.php"); ?>
  </body>
  </html>
  <?php
}?>
