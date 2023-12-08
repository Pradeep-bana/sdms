<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $studentname=$_POST['studentname'];
  $regno=$_POST['regno'];
  $sex=$_POST['sex'];
  $age=$_POST['age'];
  $stream=$_POST['stream'];
  $class=$_POST['class'];
  $sql="update students set studentName=:studentname,studentno=:regno,gender=:sex,age=:age,class=:class,stream=:stream where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
  $query->bindParam(':regno',$regno,PDO::PARAM_STR);
  $query->bindParam(':sex',$sex,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':stream',$stream,PDO::PARAM_STR);
  $query->bindParam(':class',$class,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['save']))
{
  $sid=$_SESSION['edid']; 
  $parentname=$_POST['parentname'];
  $relation=$_POST['relation'];
  $occupation=$_POST['occupation'];
  $phone=$_POST['phone'];
  $contact=$_POST['contact'];
  $email=$_POST['email'];
  $sql="update students set parentName=:parentname,relation=:relation,occupation=:occupation,contactno=:phone,nextphone=:contact,email=:email where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':parentname',$parentname,PDO::PARAM_STR);
  $query->bindParam(':relation',$relation,PDO::PARAM_STR);
  $query->bindParam(':occupation',$occupation,PDO::PARAM_STR);
  $query->bindParam(':phone',$phone,PDO::PARAM_STR);
  $query->bindParam(':contact',$contact,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['pass']))
{
  $sid=$_SESSION['edid'];
  $tehsil=$_POST['tehsil'];
  $district=$_POST['district'];
  $state=$_POST['state'];
  $village=$_POST['village'];
  $sql="update students set tehsil=:tehsil,district=:district,state=:state,village=:village where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':tehsil',$tehsil,PDO::PARAM_STR);
  $query->bindParam(':district',$district,PDO::PARAM_STR);
  $query->bindParam(':state',$state,PDO::PARAM_STR);
  $query->bindParam(':village',$village,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['save2']))
{
  $sid=$_SESSION['edid'];
  $studentimage=$_FILES["studentimage"]["name"];
  move_uploaded_file($_FILES["studentimage"]["tmp_name"],"studentimages/".$_FILES["studentimage"]["name"]);
  $sql="update students set studentImage=:studentimage where id='$sid' ";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentimage',$studentimage,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['document']))
{
  $sid=$_SESSION['edid'];
  $samagra=$_POST['samagra'];
  $aadhar=$_POST['aadhar'];
  $sql="update students set samagra=:samagra,aadhar=:aadhar where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':samagra',$samagra,PDO::PARAM_STR);
  $query->bindParam(':aadhar',$aadhar,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['fees']))
{
  $inWords = $_POST['inWords'];
  if($inWords){
    $_SESSION['inWords'] = $_POST['inWords'];
  }
  $tempPay=$_POST['tempPay'];
  $sid=$_SESSION['edid'];
  $s2018=$_POST['s2018'];
  $s2019=$_POST['s2019'];
  $s2020=$_POST['s2020'];
  $s2021=$_POST['s2021'];
  $s2022=$_POST['s2022'];
  $s2023=$_POST['s2023'];
  $tFees=$_POST['tempPay'];
  switch ($tempPay) {
    case $s2018 >= $tempPay:
      $s2018 -= $tempPay;
      break;
    
    case $s2019 >= $tempPay:
      $s2019 -= $tempPay;
      break;

    case $s2020 >= $tempPay:
      $s2020 -= $tempPay;
      break;

    case $s2021 >= $tempPay:
      $s2021 -= $tempPay;
      break; 
      
    case $s2022 >= $tempPay:
      $s2022 -= $tempPay;
      break;

    case $s2023 >= $tempPay:
      $s2023 -= $tempPay;
      break;
    default:
    //default minus
      $s2023 -= $tempPay;
      break;
  }
  $sql="update students set s2018=:s2018,s2019=:s2019,s2020=:s2020,s2021=:s2021,s2022=:s2022,s2023=:s2023,tFees=:tFees where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':s2018',$s2018,PDO::PARAM_STR);
  $query->bindParam(':s2019',$s2019,PDO::PARAM_STR);
  $query->bindParam(':s2020',$s2020,PDO::PARAM_STR);
  $query->bindParam(':s2021',$s2021,PDO::PARAM_STR);
  $query->bindParam(':s2022',$s2022,PDO::PARAM_STR);
  $query->bindParam(':s2023',$s2023,PDO::PARAM_STR);
  $query->bindParam(':tFees',$tFees,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('$inWords');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="card-body">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
       <?php
       $eid=$_POST['edit_id'];
       $ret=mysqli_query($con,"select * from  students where id='$eid'");
       $cnt=1;
       while ($row=mysqli_fetch_array($ret))
       {
         $_SESSION['edid']=$row['id']; 
         ?>
         <div class="col-md-3">
           <!-- Profile Image -->
           <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="img-circle"
                src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="150" height="150" class="user-image"
                alt="User profile picture">
              </div>

              <h3 class="profile-username text-center"><?php  echo $row['name'];?></h3>



              <p class="text-muted text-center"><strong></strong></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right"><?php  echo $row['email'];?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact No</b> <a class="float-right"><?php  echo $row['contactno'];?> </a>
                </li>
                
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#companydetail" data-toggle="tab">Registration Detail</a></li>
                <li class="nav-item"><a class="nav-link" href="#companyaddress" data-toggle="tab">Parent Info</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Address</a></li>
                <li class="nav-item"><a class="nav-link" href="#change" data-toggle="tab">Update Image</a></li>
                <li class="nav-item"><a class="nav-link" href="#document" data-toggle="tab">Document</a></li>
                <li class="nav-item"><a class="nav-link" href="#fees" data-toggle="tab">Fees</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="companydetail">
                  <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                         <label for="companyname">Student Names</label>
                         <input name="studentname" class="form-control" name="studentname" id="studentname" value="<?php  echo $row['studentName'];?>" required>
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                      <div class="form-group">
                        <label for="regno">Reg No</label>
                        <input name="regno" class="form-control" name="regno" id="regno" value="<?php  echo $row['studentno'];?>" required>
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Sex</label>
                        <input class="form-control" name="sex" value="<?php  echo $row['gender'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Age</label>
                        <input class="form-control" name="age" value="<?php  echo $row['age'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Class</label>
                        <input class="form-control" name="class" value="<?php  echo $row['class'];?>" required>
                      </div>        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>DOB</label>
                        <input name="stream" placeholder="Select date" type="date" id="example" class="form-control" value="<?php echo $row['stream'];?>">
                      </div>        
                    </div>
                    <!-- /.col --> 
                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer text-right">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class=" tab-pane" id="companyaddress">
                <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >

                  <div class="row">
                    <div class="form-group col-md-6">
                     <label for="companyname">Father's Name</label>
                     <input name="parentname" class="form-control" id="parentName"  value="<?php  echo $row['parentName'];?>" required>
                   </div>
                   <!-- /.form-group -->
                   <div class="form-group col-md-6">
                     <label for="companyname">Mother's Name</label>
                     <input name="relation" class="form-control" id="relation"  value="<?php  echo $row['relation'];?>" required>
                   </div>
                   <!-- /.form-group -->

                   <div class="col-md-12">
                    <div class="form-group">
                      <label for="regno">Cast</label>
                      <select type="select" class="form-control" id="ocupation" name="occupation" required>
                            <option value="<?php echo $row['occupation'];?>"><?php echo $row['occupation'];?></option>
                            <option value="GENERAL">GENRAL</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="OBC">OBC</option>
                            <option value="EWS">EWS</option>
                            <option value="OTHER">OTHER</option>
                      </select>
                    </div>        
                  </div>
                  <!-- /.col -->
                </div><!-- ./row -->

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Phone No.</label>
                      <input class="form-control" name="phone"  value="<?php  echo $row['contactno'];?>"required>
                    </div>        
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mobile No 2.</label>
                      <input class="form-control" name="contact" value="<?php  echo $row['nextphone'];?>"  required>
                    </div>        
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" name="email" value="<?php  echo $row['email'];?>"  required>
                    </div>        
                  </div>
                  <!-- /.col --> 
                </div>

                <!-- /.card-body -->
                <div class="modal-footer text-right">
                  <button type="submit" name="save" class="btn btn-primary">Update</button>
                </div>

              </form>
            </div>

            <!-- /.tab-pane -->

            <div class=" tab-pane" id="change">
             <div class="row">
              <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                <div class="form-group">
                  <label>Upload Image</label>
                  <input type="file" class="" name="studentimage" value="" required>
                </div>  

                <div class="modal-footer text-right">
                  <button type="submit" name="save2" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>



          <div class="tab-pane" id="settings">
            <form role="form" id=""  method="post" enctype="multipart/form-data" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputName" class="col-sm-2 col-md-6 col-form-label">Tehsil</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tehsil" name="tehsil" value="<?php  echo $row['tehsil'];?>">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">District</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="district" id="district" value="<?php  echo $row['district'];?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">State</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="state" id="state" value="<?php  echo $row['state'];?>">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputName2" class="col-sm-2 col-md-6 col-form-label">Village</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="village" id="village" value="<?php  echo $row['village'];?>">
                  </div>
                </div>
              </div>
              <div class="modal-footer text-right">
                  <button type="submit" name="pass" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>

          <div class="tab-pane" id="document">
            <form role="form" id=""  method="post" enctype="multipart/form-data" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputName" class="col-sm-2 col-md-6 col-form-label">Samagra Id</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="samagra" name="samagra" value="<?php  echo $row['samagra'];?>">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">Aadhar No.</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="aadhar" id="aadhar" value="<?php  echo $row['aadhar'];?>">
                  </div>
                </div>
              </div>
              <div class="modal-footer text-right">
                  <button type="submit" name="document" class="btn btn-primary">Update</button>
              </div>
          </form>
          </div>


          <div class="tab-pane" id="fees">
            <form role="form" id=""  method="post" enctype="multipart/form-data" >
              <div class="row">
                <div class=" col-md-2">
                  <div class="form-group">
                    <label class="col-form-label">2018</label>
                    <input type="number" class="form-control" id="s2018" name="s2018" value="<?php  echo $n2018 = $row['s2018'] != null ? $row['s2018'] : 0 ;?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-form-label">2019</label>
                    <input type="number" class="form-control" name="s2019" id="s2019" value="<?php  echo $n2019 = $row['s2019'] != null ? $row['s2019'] : 0 ;?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                  <label class="col-form-label">2020</label>
                    <input type="number" class="form-control" id="s2020" name="s2020" value="<?php  echo $n2020 = $row['s2020'] != null ? $row['s2020'] : 0;?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group ">
                    <label class="col-form-label">2021</label>
                    <input type="number" class="form-control" name="s2021" id="s2021" value="<?php  echo $n2021 = $row['s2021'] != null ? $row['s2021'] : 0;?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-form-label">2022</label>
                    <input type="number" class="form-control" id="s2022" name="s2022" value="<?php  echo $n2022 = $row['s2022'] != null ? $row['s2022'] : 0;?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-form-label">2023</label>
                    <input type="number" class="form-control" name="s2023" id="s2023" value="<?php  echo $n2023 = $row['s2023'] != null ? $row['s2023'] : 0;?>" required>
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">Payable Fees.</label>
                  <div class="col-sm-10">
                    <input type="text" name="tFees" class="form-control" readonly value="<?php  echo $n2018+$n2019+$n2020+$n2021+$n2022+$n2023;?>" required>
                  </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">Paid Fees.</label>
                    <div class="col-sm-10">
                      <input type="text" name="tempPay" class="form-control" value="<?php echo $row['tFees'];?>" required>  
                      <!-- <input type="text" name="recentPay" class="form-control" value="0"> -->
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">in Words.</label>
                    <div class="col-sm-10">
                      <input type="text" name="inWords" class="form-control" value="<?php echo $_SESSION['inWords'];?>">
                    </div>
                </div>
              </div>
              
              <div class="modal-footer text-right">
                  <button type="submit" name="fees" class="btn btn-primary">Update</button>
                  <a href="cert/index.php?id=<?php echo $row['studentno']?>&name=<?php echo $row['studentName']?>&father=<?php echo $row['parentName']?>&class=<?php echo $row['class']?>&thisyearFee='<?php echo $row['s2023']?>&payableFee=<?php echo $n2018+$n2019+$n2020+$n2021+$n2022+$n2023; ?>&tempPay=<?php echo $row['tFees']?>" class="btn btn-primary">Reciept</a>
              </div>
          </form>
          </div>
          <!-- /.tab-pane -->
          <?php  
        }?>
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </section>
  <!-- /.content -->
</div>
  <!-- /.content-wrapper -->