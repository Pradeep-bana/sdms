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
    $query0 = mysqli_query($con,"SELECT COUNT(DISTINCT(att_time)) AS school_days FROM attendance");
    while($row0=mysqli_fetch_array($query0)){
      $tdSchool = $row0['school_days']; 
    };


    $presents = mysqli_query($con,"SELECT attendance.attend FROM students INNER JOIN attendance ON students.studentno=attendance.studentno WHERE students.id='$id';");
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
              <div class="col-sm-10">
              <marquee class="marq" bgcolor = "inherrit" direction = "left" loop="" >
                Welcome user here you can generate Marksheet.
              </marquee>
              </div>
              <div class="col-sm-2">
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
        <h5 class="text-center" style="color:red;">सह-शैक्षिक क्षेत्रों का मूल्यांकन (ग्रेड)<h5>
        <table class="unk" class="table table-bordered">
        <!-- <thead>
            <tr>
            <th scope="col">विषय</th>
            <th scope="col">कुल अंक 50 के आधार पर प्राप्त ग्रेड</th>
            <th scope="col">प्रोजेक्ट कार्य मूल्यांकन के 40 अंक के आधार पर प्राप्त ग्रेड</th>
            <th scope="col">लिखित मूल्यांकन के 60 अंक के आधार पर प्राप्त ग्रेड</th>
            <th scope="col">कुल अंक 100 के आधार पर समय ग्रेड</th>
            <th scope="col">कुल अंक 100 के आधार पर समय ग्रेड</th>
            </tr>
        </thead> -->
        <tbody>
            <tr>
            <th scope="row">1.हिन्दी</th>
            <td style="padding:1px" ><input type="" name="H1"></td>
            <td><input type="" name="H2"></td>
            <td><input type="" name="H3"></td>
            <td><input type="" name="H4"></td>
            <td><input type="" name="H5"></td>
            </tr>
            <tr>
            <th scope="row">2,अंग्रेजी</th>
            <td><input type="" name="A1"></td>
            <td><input type="" name="A2"></td>
            <td><input type="" name="A3"></td>
            <td><input type="" name="A4"></td>
            <td><input type="" name="A5"></td>
            </tr>
            <tr>
            <th scope="row">3.गणित</th>
            <td><input type="" name="G1"></td>
            <td><input type="" name="G2"></td>
            <td><input type="" name="G3"></td>
            <td><input type="" name="G4"></td>
            <td><input type="" name="G5"></td>
            </tr>
            <tr>
            <th scope="row">4.विज्ञानं</th>
            <td><input type="" name="V1"></td>
            <td><input type="" name="V2"></td>
            <td><input type="" name="V3"></td>
            <td><input type="" name="V4"></td>
            <td><input type="" name="V5"></td>
            </tr>
            <tr>
            <th scope="row">5.समाजीक विज्ञानं</th>
            <td><input type="" name="SC1"></td>
            <td><input type="" name="SC2"></td>
            <td><input type="" name="SC3"></td>
            <td><input type="" name="SC4"></td>
            <td><input type="" name="SC5"></td>
            </tr>
            <tr>
            <th scope="row">6.संस्कृत</th>
            <td><input type="" name="S1"></td>
            <td><input type="" name="S2"></td>
            <td><input type="" name="S3"></td>
            <td><input type="" name="S4"></td>
            <td><input type="" name="S5"></td>
            </tr>
        </tbody>
        </table>

        <h5 class="text-center" style="color:red;">Student Details<h5>
        <table style="font-size:1rem" class="table table-bordered">
        <tbody>
          <?php while ($row=mysqli_fetch_array($ret2)){ ?>
            <th scope="row">अनुक्रमांक</th>
            <td scope="row"><input name="std1" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">सरल क्रमांक</th>
            <td scope="row"><input name="std2" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">वर्ग</th>
            <td scope="row"><input name="std3" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">प्रवेशांक एंड दिनांक</th>
            <td scope="row"><input name="std4" value="" type="text"></td>
            </tr>
            <tr>
            <th scope="row">नाम</th>
            <td><input name="name" type="text" value="<?php echo $row['studentName']?>"></td>
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
            <?php }?>
        </tbody>
        </table>

        <h5 class="text-center" style="color:red;">सह-शैक्षिक क्षेत्रों का मूल्यांकन (ग्रेड)<h5>
        <table style="font-size:1rem" class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">क्षेत्र</th>
            <th scope="col">समग्र ग्रेडिंग</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1.साहित्यिक</th>
            <td scope="row"><input type="text" name="KSH1"></td>
            </tr>
            <tr>
            <th scope="row">2.सांस्कृतिक</th>
            <td scope="row"><input type="text" name="KSH2"></td>
            </tr>
            <tr>
            <th scope="row">3.वैज्ञानिक</th>
            <td scope="row"><input type="text" name="KSH3"></td>
            </tr>
            <tr>
            <th scope="row">4.सृजनात्मक</th>
            <td scope="row"><input type="text" name="KSH4"></td>
            </tr>
            <tr>
            <th scope="row">5.खेलकूद-योग, स्काउट/रेडक्रॉस</th>
            <td scope="row"><input type="text" name="KSH5"></td>
            </tr>
        </tbody>
        </table>

        <h5 class="text-center" style="color:red;">व्यक्तिगत-सामाजिक गुणों का मूल्यांकन (ग्रेड)<h5>
        <table style="font-size:1rem" class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">गुण</th>
            <th scope="col">समग्र ग्रेडिंग</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1.नियमितता</th>
            <td><input type="text" name="SCM1"></td>
            </tr>
            <tr>
            <th scope="row">2.समयबद्धता</th>
            <td><input type="text" name="SCM2"></td>
            </tr>
            <tr>
            <th scope="row">3.स्वच्छता</th>
            <td scope="row"><input type="text" name="SCM3"></td>
            </tr>
            <tr>
            <th scope="row">4.अनुशासन/कर्तव्यनिष्ठा</th>
            <td scope="row"><input type="text" name="SCM4"></td>
            </tr>
            <tr>
            <th scope="row">5.सहयोग की भावना</th>
            <td scope="row"><input type="text" name="SCM5"></td>
            </tr>
            <tr>
            <th scope="row">6.पर्यावरण के प्रति संवेदनशीलता</th>
            <td><input type="text" name="SCM6"></td>
            </tr>
            <tr>
            <th scope="row">7.नेतृत्व की क्षमता</th>
            <td><input type="text" name="SCM7"></td>
            </tr>
            <tr>
            <th scope="row">8.सत्यवादिता</th>
            <td scope="row"><input type="text" name="SCM8"></td>
            </tr>
            <tr>
            <th scope="row">9.ईमानदारी</th>
            <td scope="row"><input type="text" name="SCM9"></td>
            </tr>
            <tr>
            <th scope="row">10.अभिवृत्ति</th>
            <td scope="row"><input type="text" name="SCM10"></td>
            </tr>
            <th scope="row">कुल शिक्षण दिवस</th>
            <td><input type="text" name="SCM11" value="<?php echo $tdSchool;?>"></td>
            </tr>
            <tr>
            <th scope="row">विद्यार्थी उपस्थिति</th>
            <td scope="row"><input type="text" name="SCM12" value="<?php echo $t_present;?>"></td>
            </tr>
            <th scope="row">शिक्षक का अभिमत</th>
            <td scope="row"><input type="text" name="SCM13"></td>
            </tr>
            <tr>
            <th scope="row">वार्षिक परिणाम ग्रेड</th>
            <td scope="row"><input type="text" name="SCM14"></td>
            </tr>
            <tr>
            <th scope="row">पदोन्नति</th>
            <td scope="row"><input type="text" name="SCM15"></td>
            </tr>
        </tbody>
        </table>
            <button type="submit" name="save" class="btn btn-primary">back Marksheet</button>
            <button type="submit" name="mark_front" class="btn btn-primary">front Marksheet</button>
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
