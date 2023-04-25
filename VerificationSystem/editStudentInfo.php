<?php
include 'condb.php';
session_start();
$username = $_SESSION['username'];

$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$staff = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row2 = $staff->fetch_assoc();
$tag = $row2['account_tag'];
$staff_username = $row2['account_username'];
$staff_email = $row2['Email'];

$validator = mysqli_query($conn, "SELECT * FROM validator") or die('query failed');
$row1 = $validator->fetch_assoc();
$student_id = $row1['validator'];

$select = mysqli_query($conn, "SELECT * FROM student_data WHERE id = '$student_id' ") or die('query failed');
if(mysqli_num_rows($select) > 0){
			while($row = mysqli_fetch_assoc($select)){
                $ID = $row['id'];
                $studentid = $row['student_id'];
                $lname = $row['student_lname'];
                $fname = $row['student_fname'];
                $mname = $row['student_mname'];
                $suffix = $row['student_suffix'];
                $birthday = $row['student_birthday'];
                $contact = $row['student_contact'];
                $address = $row['student_address'];
                $gender = $row['student_gender'];
                $dgrad = $row['date_graduated'];
                $department = $row['department'];
                $program = $row['program'];
                $degree = $row['degree'];
                $major = $row['major'];
                $semester = $row['semester'];
                $acadyear = $row['academic_year'];
                $gname = $row['guardian_name'];
                $gcontact = $row['guardian_contact'];
                $relationship = $row['guardian_relationship'];
              }
}

if(isset($_POST['update_profile'])){

   $sID = mysqli_real_escape_string($conn, $_POST['update_studentid']);
   $lname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $fname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $mname = mysqli_real_escape_string($conn, $_POST['update_middlename']);
   $bdate = mysqli_real_escape_string($conn, $_POST['update_birthdate']);
   $address = mysqli_real_escape_string($conn, $_POST['update_address']);
   $contactno = mysqli_real_escape_string($conn, $_POST['update_contact']);
   $suffix = mysqli_real_escape_string($conn, $_POST['update_suffix']);
   $gender = mysqli_real_escape_string($conn, $_POST['update_gender']);
   $dgrad = mysqli_real_escape_string($conn, $_POST['update_yeargraduated']);
   $department = mysqli_real_escape_string($conn, $_POST['update_department']);
   $program = mysqli_real_escape_string($conn, $_POST['update_program']);
   $degree = mysqli_real_escape_string($conn, $_POST['update_degree']);
   $sem = mysqli_real_escape_string($conn, $_POST['update_semester']);
   $acadyr = mysqli_real_escape_string($conn, $_POST['update_academicyear']);
   $major = mysqli_real_escape_string($conn, $_POST['update_major']);
   $gname = mysqli_real_escape_string($conn, $_POST['update_guardian']);
   $gcontact= mysqli_real_escape_string($conn, $_POST['update_guardiancontact']);
   $relationship = mysqli_real_escape_string($conn, $_POST['update_relationship']);

    $update = mysqli_query($conn, 
    "UPDATE student_data SET student_id = '$sID', student_lname = '$lname', 
    student_fname = '$fname', student_mname = '$mname', student_suffix = '$suffix', 
    student_birthday = '$bdate', student_contact = '$contactno', student_address = '$address', 
    student_gender = '$gender', date_graduated = '$dgrad', department = '$department', 
    program = '$program', degree = '$degree', major = '$major', semester = '$sem', 
    academic_year = '$acadyr', guardian_name = '$gname', guardian_contact = '$gcontact', 
    guardian_relationship = '$relationship' WHERE id = '$student_id'") 
    or die('query failed');


    $Edit = 'Edit';

    $insert1 = mysqli_query($conn, "INSERT INTO `activity_history`(activity_date, staff_username, staff_email, student_id, student_lname, student_fname, recent_activity) 
    VALUES (NOW(),'$staff_username','$staff_email','$sID','$lname','$fname','$Edit') ") or die('query failed');

    header('location: records.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="EditStudentInfo.css" />
    <script src="https://kit.fontawesome.com/370708d2ea.js" crossorigin="anonymous"></script>
    <title>UMak Verification System</title>
  </head>
  <body>
    <!-- START OF NAV BAR -->
    <div class="menu-bar">
      <div class="logoText">
        <img src="img/UMakLogo.png" alt="" class="umakLogo">
        <h1 class="logo">UMak Verification System</span></h1>
      </div>
      <ul>
      <?php 
         if($account_tag == $Admin){
          echo '
          <li><a href="dashboard.php">REPORT</a></li>
          <li>
            <a href="admin_staff.php">STAFFS ▼</a>
  
            <div class="dropdown-menu">
              <ul>
                <li><a href="admin_staff.php">View Staffs</a></li>
                <li><a href="addStaff.php">Add Staffs</a></li>
                <li><a href="staffactivity.php">Show Staff Activities</a></li>
              </ul>
            </div>
          </li>';
         }
        ?>
        
        <li>
          <a href="records.php">RECORDS ▼</a>

          <div class="dropdown-menu">
            <ul>
              <li><a href="records.php">View Records</a></li>
              <?php 
                if($account_tag == $Admin){
                echo '
              <li><a href="addRecord.php">Add Records</a></li>
              <li><a href="addBulk.php">Add Bulk</a></li>
              <li><a href="addDCD.php">Add Category</a></li>';
            }
              ?>
            </ul>
          </div>
        </li>
        <li>
          <form action="index.php" method="post">
            <button type="submit" name="logout" class="logout">LOG OUT</button>
          </form>
        </li>
      </ul>
    </div>
    <!-- END OF NAV BAR -->
    <div class="container">
      <a href="studentInfo.php"><button class="back">BACK</button></a>
      <form action="" method="post" enctype="multipart/form-data"> 
      <table>
        <tr>
          <!-- for image -->
          <td rowspan="7" class="icon2">
            <img src="img/userpic.png" class="usericon" />
          </td>
        </tr>
        <!-- 1ST ROW -->
        <tr>
          <td><b> LAST NAME </b></td>
          <td><b> BIRTHDATE </b></td>
        </tr>
        <!-- 1ST ROW INPUT -->
        <tr>
          <td><input type="text" name="update_lastname" value="<?php echo $lname;?>"></td>
          <td><input type="date" name="update_birthdate" value="<?php echo $birthday;?>"></td>
        </tr>
        <!-- 2ND ROW -->
        <tr>
          <td><b> FIRST NAME </b></td>
          <td><b> GENDER </b></td>
        </tr>
        <!-- 2ND ROW INPUT -->
        <tr>
          <td><input type="text" name="update_firstname" value="<?php echo $fname;?>"></td>
          <td><input type="text" name="update_gender" value="<?php echo $gender;?>"></td>
        </tr>
        <!-- 3RD ROW -->
        <tr>
          <td><b> MIDDLE NAME </b></td>
          <td><b> CONTACT NUMBER </b></td>
        </tr>
        <!-- 3RD ROW INPUT -->
        <tr>
          <td><input type="text" name="update_middlename" value="<?php echo $mname;?>"></td>
          <td><input type="text" name="update_contact" value="<?php echo $contact;?>"></td>
        </tr>
        <!-- 4TH ROW -->
        <tr>
          <td><b> STUDENT ID </b></td>
          <td><b> SUFFIX </b></td>
          <td><b> YEAR GRADUATED </b></td>
        </tr>
        <!-- 4TH ROW INPUT -->
        <tr>
          <td><input type="text" name="update_studentid" value="<?php echo $studentid;?>"></td>
          <td><input type="text" name="update_suffix" value="<?php echo $suffix;?>"></td>
          <td><input type="date" name="update_yeargraduated" value="<?php echo $dgrad;?>"></td>
        </tr>
        <!-- 5TH ROW -->
        <tr>
          <td><b> GUARDIAN </b></td>
          <td><b> ADDRESS </b></td>
          <td></td>
        </tr>
        <!-- 5TH ROW INPUT -->
        <tr>
          <td><input type="text" name="update_guardian" value="<?php echo $gname;?>"></td>
          <td colspan="2"><input type="text" name="update_address" value="<?php echo $address;?>"></td>
        </tr>
        <!-- 6TH ROW -->
        <tr>
          <td><b> GUARDIAN CONTACT </b></td>
          <td><b> DEPARTMENT </b></td>
          <td><b> PROGRAM </b></td>
        </tr>
        <!-- 6TH ROW INPUT -->
        <tr>
          <td><input type="text" name="update_guardiancontact" value="<?php echo $gcontact;?>"></td>
          <td>
            <select id="department" name="update_department" >
            <option value="<?php echo $department;?>"><?php echo $department;?></option>
            <option value="cbfs">CBFS</option>
            <option value="cthm">CTHM</option>
            <option value="igs">IGS/CGS/CCAPS</option>
            <option value="cos">COS</option>
            <option value="coe">COE</option>
            <option value="ccsce">CCSE</option>
            <option value="iit">IIT/COT/ITRED/CTM</option>
            <option value="ccis">CCIS</option>
            <option value="cgpp">CGPP</option>
            <option value="cal">CAL</option>
            <option value="coahs">COAHS</option>
            <option value="chk">CHK</option>
            <option value="cmli">CMLI</option>
            <option value="sol">SOL</option>
          </select></td></td>
          <td><!-- PROGRAM -->
            <select id="program" name="update_program" >
              <option value="<?php echo $program;?>"><?php echo $program;?></option>
            </select></td>
        </tr>
        <!-- 7TH ROW -->
        <tr>
          <td><b> RELATIONSHIP </b></td>
          <td><b> DEGREE </b></td>
          <td><b> MAJOR </b></td>
        </tr>
        <!-- 7TH ROW INPUT -->
        <tr>
          <td><input type="text" name="update_relationship" value="<?php echo $relationship;?>"></td>
          <td>
            <select name="update_degree" id="degree" value="<?php echo $degree;?>" >
            <option value="none" value="<?php echo $degree;?>"><?php echo $degree;?></option>
            <option value="associate">Non-Baccalaureate Degree</option>
            <option value="bachelor">Baccalaureate Degree</option>
            <option value="master">Post Baccalaureate Degree</option>
            <option value="doctoral">Graduate's Degree</option>
          </select></td>
          <td>
            <!-- MAJOR SECTION -->
            <select id="major" name="update_major">
              <option value="<?php echo $major;?>"><?php echo $major;?></option>
            </select></td>
        </tr>
        <!-- 8TH ROW -->
        <tr>
          <td rowspan="2"></td>
          <td><b> SEMESTER </b></td>
          <td><b> ACADEMIC YEAR </b></td>
        </tr>
        <!-- 8TH ROW INPUT -->
        <tr>
          <td><input type="text" name="update_semester" value="<?php echo $semester;?>"></td>
          <td><input type="text" name="update_academicyear" value="<?php echo $acadyear;?>"></td>
        </tr>
      </table>
      <!-- BUTTON SECTION -->
      <input type="submit" name="update_profile" value="SAVE">
      </form>
      <script src="js/major.js"></script>
    <footer></footer>
  </body>
</html>