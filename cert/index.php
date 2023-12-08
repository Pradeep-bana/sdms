<?php
session_start();
error_reporting(0);
//neccessar file for hindi_language
include 'hindi_helper.php';
//some importent variables 
$school=hindi_helper('सरस्वती विद्या मंदिर');
$jila=hindi_helper('शाजापुर');
$place = hindi_helper('बुरलाय बांध');
$vikaskhand = hindi_helper('मोहन बड़ोदिया');
$diesCode = '23220401505';
$starting_year = '23';$ending_year='24';
$midium = hindi_helper('हिंदी');

if(isset($_POST['save']))
  {
    $id = $_GET['id'];
    
    //for hindi
    $H1 = $_POST['H1'];
    $H2 = $_POST['H2'];
    $H3 = $_POST['H3'];
    $H4 = $_POST['H4'];
    $H5 = $_POST['H5'];

    //for english
    $A1 = $_POST['A1'];
    $A2 = $_POST['A2'];
    $A3 = $_POST['A3'];
    $A4 = $_POST['A4'];
    $A5 = $_POST['A5'];

    //for Ganit
    $G1 = $_POST['G1'];
    $G2 = $_POST['G2'];
    $G3 = $_POST['G3'];
    $G4 = $_POST['G4'];
    $G5 = $_POST['G5'];

    //For Vigyan
    $V1 = $_POST['V1'];
    $V2 = $_POST['V2'];
    $V3 = $_POST['V3'];
    $V4 = $_POST['V4'];
    $V5 = $_POST['V5'];

    //for Samajik Vigyan
    $SC1 = $_POST['SC1'];
    $SC2 = $_POST['SC2'];
    $SC3 = $_POST['SC3'];
    $SC4 = $_POST['SC4'];
    $SC5 = $_POST['SC5'];

    //for Sanskrit
    $S1 = $_POST['S1'];
    $S2 = $_POST['S2'];
    $S3 = $_POST['S3'];
    $S4 = $_POST['S4'];
    $S5 = $_POST['S5'];

    //student info
    $std1 = $_POST['std1'];
    $std2 = $_POST['std2'];
    $std3 = hindi_helper($_POST['std3']);
    $std4 = $_POST['std4'];
    $name = hindi_helper($_POST['name']);
    $class = hindi_helper($_POST['class']);
    $father = hindi_helper($_POST['father']);
    $mother = hindi_helper($_POST['mother']);
    $dob = $_POST['dob'];
    $dob2 = $_POST['dob2'];
    $cast = hindi_helper($_POST['cast']);
    $addr = hindi_helper($_POST['addr']);
    $number = $_POST['number'];

    //kshetriya 
    $KSH1 = $_POST['KSH1'];
    $KSH2 = $_POST['KSH2'];
    $KSH3 = $_POST['KSH3'];
    $KSH4 = $_POST['KSH4'];
    $KSH5 = $_POST['KSH5'];

    //Social Manner
    $SCM1 = $_POST['SCM1'];
    $SCM2 = $_POST['SCM2'];
    $SCM3 = $_POST['SCM3'];
    $SCM4 = $_POST['SCM4'];
    $SCM5 = $_POST['SCM5'];
    $SCM6 = $_POST['SCM6'];
    $SCM7 = $_POST['SCM7'];
    $SCM8 = $_POST['SCM8'];
    $SCM9 = $_POST['SCM9'];
    $SCM10 = $_POST['SCM10'];
    $SCM11 = $_POST['SCM11'];
    $SCM12 = $_POST['SCM12'];
    $SCM13 = $_POST['SCM13'];
    $SCM14 = $_POST['SCM14'];
    $SCM15 = $_POST['SCM15'];

    header('content-type:image/jpeg');
    // header('Content-Disposition: attachment; filename=file-name.jpg');
    $font="new_font.ttf";
    $font_size=51;
    $image=imagecreatefromjpeg("mark_back.jpg");
    $color=imagecolorallocate($image,20,10,10);

    //for hindi
    imagettftext($image,$font_size,0,2600,1107,$color,$font,$H1);
    imagettftext($image,$font_size,0,2900,1107,$color,$font,$H2);
    imagettftext($image,$font_size,0,3200,1110,$color,$font,$H3);
    imagettftext($image,$font_size,0,3500,1110,$color,$font,$H4);
    imagettftext($image,$font_size,0,3800,1115,$color,$font,$H5);
    
    //for English
    imagettftext($image,$font_size,0,2600,1307,$color,$font,$A1);
    imagettftext($image,$font_size,0,2900,1307,$color,$font,$A2);
    imagettftext($image,$font_size,0,3200,1310,$color,$font,$A3);
    imagettftext($image,$font_size,0,3500,1310,$color,$font,$A4);
    imagettftext($image,$font_size,0,3800,1315,$color,$font,$A5);

    //for Maths
    imagettftext($image,$font_size,0,2600,1480,$color,$font,$G1);
    imagettftext($image,$font_size,0,2900,1480,$color,$font,$G2);
    imagettftext($image,$font_size,0,3200,1480,$color,$font,$G3);
    imagettftext($image,$font_size,0,3500,1480,$color,$font,$G4);
    imagettftext($image,$font_size,0,3800,1480,$color,$font,$G5);

    
    //for Social Science
    imagettftext($image,$font_size,0,2600,1820,$color,$font,$V1);
    imagettftext($image,$font_size,0,2900,1820,$color,$font,$V2);
    imagettftext($image,$font_size,0,3200,1820,$color,$font,$V3);
    imagettftext($image,$font_size,0,3500,1820,$color,$font,$V4);
    imagettftext($image,$font_size,0,3800,1820,$color,$font,$V5);

    //for Science
    imagettftext($image,$font_size,0,2600,1660,$color,$font,$SC1);
    imagettftext($image,$font_size,0,2900,1660,$color,$font,$SC2);
    imagettftext($image,$font_size,0,3200,1660,$color,$font,$SC3);
    imagettftext($image,$font_size,0,3500,1660,$color,$font,$SC4);
    imagettftext($image,$font_size,0,3800,1660,$color,$font,$SC5);

    //for Sanskrit
    imagettftext($image,$font_size,0,2600,1930,$color,$font,$S1);
    imagettftext($image,$font_size,0,2900,1930,$color,$font,$S2);
    imagettftext($image,$font_size,0,3200,1930,$color,$font,$S3);
    imagettftext($image,$font_size,0,3500,1930,$color,$font,$S4);
    imagettftext($image,$font_size,0,3800,1930,$color,$font,$S5);

    //Student Details
    imagettftext($image,$font_size,-1,1650,150,$color,$font,$school);  //school name
    imagettftext($image,$font_size,-1,2650,165,$color,$font,$jila);  //JILA
    imagettftext($image,$font_size,0,2480,310,$color,$font,$starting_year);    //startin year
    imagettftext($image,$font_size,0,3650,370,$color,$font,$std4);   //praveshank and dinank
    imagettftext($image,$font_size,0,2770,315,$color,$font,$ending_year);     //ending year
    imagettftext($image,$font_size,0,430,310,$color,$font,$std2);     //Saral Kramank
    imagettftext($image,$font_size,0,330,420,$color,$font,$name);       //student name
    imagettftext($image,$font_size,0,1800,445,$color,$font,$class);      //class
    imagettftext($image,$font_size,0,2500,455,$color,$font,$std3);      //Varg
    imagettftext($image,$font_size,0,3300,470,$color,$font,$std1);      //Anukramank

    //kshetriya
    imagettftext($image,$font_size,0,1700,840,$color,$font,$KSH1);
    imagettftext($image,$font_size,0,1700,930,$color,$font,$KSH2);
    imagettftext($image,$font_size,0,1700,1030,$color,$font,$KSH3);
    imagettftext($image,$font_size,0,1700,1130,$color,$font,$KSH4);
    imagettftext($image,$font_size,0,1700,1230,$color,$font,$KSH5);


    //Social Manner
    imagettftext($image,$font_size,0,1700,1560,$color,$font,$SCM1);
    imagettftext($image,$font_size,0,1700,1670,$color,$font,$SCM2);
    imagettftext($image,$font_size,0,1700,1770,$color,$font,$SCM3);
    imagettftext($image,$font_size,0,1700,1870,$color,$font,$SCM4);
    imagettftext($image,$font_size,0,1700,1970,$color,$font,$SCM5);
    imagettftext($image,$font_size,0,1700,2080,$color,$font,$SCM6);
    imagettftext($image,$font_size,0,1700,2180,$color,$font,$SCM7);
    imagettftext($image,$font_size,0,1700,2280,$color,$font,$SCM8);
    imagettftext($image,$font_size,0,1700,2380,$color,$font,$SCM9);
    imagettftext($image,$font_size,0,1700,2480,$color,$font,$SCM10);
    imagettftext($image,$font_size,0,1700,2580,$color,$font,$SCM11);
    imagettftext($image,$font_size,0,1700,2680,$color,$font,$SCM12);
    imagettftext($image,$font_size,0,2600,2150,$color,$font,$SCM13);   //classTeacher's Sign 
    imagettftext($image,$font_size,0,2600,2330,$color,$font,$SCM14);   //Father's Sign
    imagettftext($image,$font_size,0,2600,2700,$color,$font,$SCM15);

    imagejpeg($image);
    imagedestroy($image);
}

if(isset($_POST['mark_front']))
  {
    $id = $_GET['id'];

    //student info
    

    $std1 = $_POST['std1'];
    $std2 = $_POST['std2'];
    $std3 = hindi_helper($_POST['std3']);
    $std4 = $_POST['std4'];
    $name = hindi_helper($_POST['name']);
    $class = hindi_helper($_POST['class']);
    $father = hindi_helper($_POST['father']);
    $mother = hindi_helper($_POST['mother']);
    $dob = $_POST['dob'];
    $dob2 = hindi_helper($_POST['dob2']);
    $samagra = $_POST['samagra'];
    $cast = hindi_helper($_POST['cast']);
    $addr = hindi_helper($_POST['addr']);
    $number = $_POST['number'];
    

    header('content-type:image/jpeg');
    // header('Content-Disposition: attachment; filename=file-name.jpg');
    $font="new_font.ttf";
    $font_size=51;
    $image=imagecreatefromjpeg("mark_front.jpg");
    $color=imagecolorallocate($image,20,10,10);

    //Student Details
    imagettftext($image,$font_size,-1,2900,530,$color,$font,$place);  
    imagettftext($image,$font_size,-1,2750,633,$color,$font,$vikaskhand);
    imagettftext($image,$font_size,-1,3330,637,$color,$font,$jila);  //JILA
    imagettftext($image,$font_size,0,2700,1150,$color,$font,$diesCode);
    imagettftext($image,$font_size,0,3750,1150,$color,$font,$samagra);
    imagettftext($image,$font_size,0,3150,980,$color,$font,$starting_year);    //startin year
    imagettftext($image,$font_size,0,3700,1340,$color,$font,$std4);   //praveshank and dinank
    imagettftext($image,$font_size,0,3385,980,$color,$font,$ending_year);     //ending year
    imagettftext($image,$font_size,0,3100,1340,$color,$font,$std2);     //Saral Kramank
    imagettftext($image,$font_size,0,2800,1510,$color,$font,$name);       //student name
    imagettftext($image,$font_size,0,3800,1510,$color,$font,$class);      //class
    imagettftext($image,$font_size,0,2460,1340,$color,$font,$std1);      //Anukramank
    imagettftext($image,$font_size,0,2700,1670,$color,$font,$father);      //father
    imagettftext($image,$font_size,0,2760,1840,$color,$font,$mother); 
    imagettftext($image,$font_size,0,2720,2030,$color,$font,$dob);
    imagettftext($image,$font_size,0,3300,2030,$color,$font,$dob2);
    imagettftext($image,$font_size,0,2570,2227,$color,$font,$cast);
    imagettftext($image,$font_size,0,2570,2377,$color,$font,$addr);
    imagettftext($image,$font_size,0,2560,2540,$color,$font,$number);

    imagejpeg($image);
    imagedestroy($image);
}


if(isset($_POST['generate_tc'])){
  $id = $_GET['id'];

    //Student info
    $name = hindi_helper($_POST['name']);
    $class = hindi_helper($_POST['class']);
    $father = hindi_helper($_POST['father']);
    $mother = hindi_helper($_POST['mother']);
    $dob = hindi_helper($_POST['dob']);
    $dob2 = hindi_helper($_POST['dob2']);
    $samagra = $_POST['samagra'];
    $aadhar = $_POST['aadhar'];
    $cast = hindi_helper($_POST['cast']);
    $addr = hindi_helper($_POST['addr']);
    $number =hindi_helper($_POST['number']);
    $ssm_id = $_POST['ssm_id'];
    $saral = hindi_helper($_POST['saral']);
    $varg = hindi_helper($_POST['varg']);
    $from_date = hindi_helper($_POST['from_date']);
    $to_date = hindi_helper($_POST['to_date']);
    $reg_number = hindi_helper($_POST['reg_number']);
    $curr_year = hindi_helper($_POST['curr_year']);
    $grade = hindi_helper($_POST['grade']);
    $reg_class = hindi_helper($_POST['reg_class']);
    $leave_reason = hindi_helper($_POST['leave_reason']);
    $character = hindi_helper($_POST['character']);
    
    //Other info
    $new_ssm = implode('   ',str_split($ssm_id));
    $new_samagra = implode('   ',str_split($samagra));
    $new_aadhar = implode('   ',str_split($aadhar));


    header('content-type:image/jpeg');
    // header('Content-Disposition: attachment; filename=file-name.jpg');
    $font="new_font.ttf";
    $font_size = 51;
    $font_mod = 50;
    $image=imagecreatefromjpeg("tc.jpg");
    $color=imagecolorallocate($image,20,10,10);
    imagettftext($image,$font_size,0,850,550+$font_mod,$color,$font,$place);
    imagettftext($image,$font_size,1,1650,545+$font_mod,$color,$font,$jila);
    imagettftext($image,$font_size,0,420,850,$color,$font,$saral);
    imagettftext($image,$font_size,0,2500,820,$color,$font,$to_date);   
    imagettftext($image,$font_size,0,400,1070,$color,$font,$new_samagra);
    imagettftext($image,$font_size,0,2130,1060,$color,$font,$new_samagra);  
    imagettftext($image,$font_size,0,600,1230,$color,$font,$new_aadhar);
    imagettftext($image,$font_size,0,650,1430+$font_mod,$color,$font,$name);
    imagettftext($image,$font_size,0,660,1550+$font_mod,$color,$font,$father);
    imagettftext($image,$font_size,0,660,1670+$font_mod,$color,$font,$mother);
    imagettftext($image,$font_size,0,630,1790+$font_mod,$color,$font,$midium);
    imagettftext($image,$font_size,0,1800,1790+$font_mod,$color,$font,$cast);
    imagettftext($image,$font_size,0,2400,1790+$font_mod,$color,$font,$varg);
    imagettftext($image,$font_size,0,620,1910+$font_mod,$color,$font,$addr);
    imagettftext($image,$font_size,1,1650,1910+$font_mod,$color,$font,$vikaskhand);
    imagettftext($image,$font_size,0,2300,1910+$font_mod,$color,$font,$jila);
    imagettftext($image,$font_size,0,830,2060,$color,$font,$from_date);
    imagettftext($image,$font_size,0,1500,2060,$color,$font,$to_date);
    imagettftext($image,$font_size,0,900,2280,$color,$font,$reg_number);
    imagettftext($image,$font_size,0,2200,2280,$color,$font,$dob);
    imagettftext($image,$font_size,0,600,2370+$font_mod,$color,$font,$dob2);
    imagettftext($image,$font_size,0,450,2710+$font_mod,$color,$font,$class);
    imagettftext($image,$font_size,0,1000,2710+$font_mod,$color,$font,$midium);
    imagettftext($image,$font_size,0,1370,2730,$color,$font,$curr_year);
    imagettftext($image,$font_size,0,2100,2710,$color,$font,$grade);
    imagettftext($image,$font_size,0,700,2830+$font_mod,$color,$font,$reg_class);
    imagettftext($image,$font_size,0,700,2945+$font_mod,$color,$font,$class);
    imagettftext($image,$font_size,0,1900,2940+$font_mod,$color,$font,$leave_reason);
    imagettftext($image,$font_size,0,1000,3037+$font_mod,$color,$font,$character);
    imagejpeg($image);
    imagedestroy($image);
}


if(isset($_GET['payableFee'])){
  $stuentno = $_GET['studentno'];
  $name = $_GET['name'];
  $father = $_GET['father'];
  $payableFee = $_GET['payableFee'];
  $class = $_GET['class'];
  $thisyearFee = $_GET['thisyearFee'];
  $tempPay = $_GET['tempPay'];

  $inWords = $_SESSION['inWords'];
  $currDate = date('d-m-Y');
  $currYear = date('Y');
  header('content-type:image/jpeg');
    //header('Content-Disposition: attachment; filename=file-name.jpg');
    $font="new_font.ttf";
    $font_size = 25;
    $font_mod = 50;
    $image=imagecreatefromjpeg("rasid.jpg");
    $color=imagecolorallocate($image,20,10,10);
    imagettftext($image,$font_size,0,570,23+$font_mod,$color,$font,$place);
    imagettftext($image,$font_size,1,330,80+$font_mod,$color,$font,$jila);
    imagettftext($image,20,-1,110,193,$color,$font,$currDate);
    imagettftext($image,20,-1,100,253,$color,$font,$name);
    imagettftext($image,20,1,530,257,$color,$font,$father);
    imagettftext($image,20,1,120,290,$color,$font,$class);
    imagettftext($image,20,1,580,290,$color,$font,$currYear.'-24');
    imagettftext($image,20,4,170,910,$color,$font,$inWords);
    imagettftext($image,20,2,350,920,$color,$font,$payableFee);
    imagettftext($image,20,2,530,920,$color,$font,$tempPay);
    imagettftext($image,20,-1,660,923,$color,$font,$payableFee);
    imagejpeg($image);
    imagedestroy($image);
}
?>
