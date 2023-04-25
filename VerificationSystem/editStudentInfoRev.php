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
    <link rel="stylesheet" href="css/editStudentInfoRev.css" />
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

    <div class="body">
      <a href="studentInfoRev.php"><button class="back">BACK</button></a>
      <div class="container">
      <div class="text"> STUDENT INFORMATION</div>
      <form action="" method="post" enctype="multipart/form-data"> 
      <div class="content">
        <div class="studInfo">

          <div class="persoInfo1">
            <input class="lname" type="text" name="update_lastname" value="<?php echo $lname;?>">,
            <div class="fname_mi">
            <input id="fname" type="text" name="update_firstname" value="<?php echo $fname;?>">
            <input id="mname" type="text" name="update_middlename" value="<?php echo $mname;?>"></div>
          </div>
            
            <div class="persoInfo2">

            <input class="studNumber" type="text" name="update_studentid" value="<?php echo $studentid;?>">
              <section class="label bdate">
                 BIRTHDATE <br>
                <b><input class="label" type="date" name="update_birthdate" value="<?php echo $birthday;?>"></b> 
              </section>

              <section class="label">
                CONTACT <br>
                <b><input class="label contact" type="text" name="update_contact" value="<?php echo $contact;?>"></b>
              </section>
              <section class="label">
                ADDRESS <br>
                <b><input class="label add" type="text" name="update_address" value="<?php echo $address;?>"
                    style="width:100%"
                ></b>
              </section>
              
            </div>
            
        </div>
        <div class="school_parentInfo">

            <div class="schoolInfo">
            <div class="yearSemAcadyr">
                <section class="label">
                  DATE GRADUATED <br>
                    <b><input class="label dateGrad" type="date" name="update_yeargraduated" value="<?php echo $dgrad;?>"></b>
                </section>
                <section class="label">
                  SEMESTER <br>
                  <b><input class="label sem" type="text" name="update_semester" value="<?php echo $semester;?>"></b>
                </section>
                <section class="label">
                  ACADEMIC YEAR <br>
                  <b><input class="label acadyr" type="text" name="update_academicyear" value="<?php echo $acadyear;?>"></b>
                </section>
              </div>
              <section class="label">
                DEPARTMENT <br>
                <b>
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
                  </select>
                </b>
              </section>
              <section class="label">
                PROGRAM <br>
                  <b>
                  <select id="program" name="update_program" >
                    <option value="<?php echo $program;?>"><?php echo $program;?></option>
                  </select>  
                  </b>
              </section>
              <section class="label">
                MAJOR <br>
                  <b>
                    <select id="major" name="update_major">
                      <option value="<?php echo $major;?>"><?php echo $major;?></option>
                    </select>  
                  </b>
              </section>
            </div>

            <div class="parentInfo">
              <section>
                GUARDIAN <br>
                <b><input class="label guardian" type="text" name="update_guardian" value="<?php echo $gname;?>"></b>
              </section>

            <div class="cont_rel">
              <section>
                CONTACT <br>
                <b><input class="label pcontact" type="text" name="update_guardiancontact" value="<?php echo $gcontact;?>"></b>
              </section>
              <section>
                RELATIONSHIP <br>
                <b><input class="label relationship" type="text" name="update_relationship" value="<?php echo $relationship;?>"></b>
              </section></div>
            </div>

        </div>
      <!-- BUTTON SECTION -->
      <input type="submit" name="update_profile" value="SAVE"></form>
      </div>
      </div>
          
    <footer></footer>
  </body>
</html>