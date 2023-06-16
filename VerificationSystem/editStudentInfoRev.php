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
                $lname = ucfirst($row['student_lname']);
                $fname = ucfirst($row['student_fname']);
                $mname = ucfirst($row['student_mname']);
                $suffix = $row['student_suffix'];
                $birthday = $row['student_birthday'];
                $contact = $row['student_contact'];
                $address = ucwords($row['student_address']);
                $gender =ucfirst($row['student_gender']);
                $dgrad = $row['date_graduated'];
                $department = $row['department'];
                $program = ucfirst($row['program']);
                $degree = ucfirst($row['degree']);
                $major = ucfirst($row['major']);
                $semester = $row['semester'];
                $acadyear = $row['academic_year'];
                $gname = ucwords($row['guardian_name']);
                $gcontact = $row['guardian_contact'];
                $relationship = ucfirst($row['guardian_relationship']);
                $award = ucfirst($row['student_award'])??'';
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
   $department1 = mysqli_real_escape_string($conn, $_POST['update_department']);
   $program1 = mysqli_real_escape_string($conn, $_POST['update_program']);
   $degree = mysqli_real_escape_string($conn, $_POST['update_degree']);
   $sem = mysqli_real_escape_string($conn, $_POST['update_semester']);
   $acadyr = mysqli_real_escape_string($conn, $_POST['update_academicyear']);
   $major = mysqli_real_escape_string($conn, $_POST['update_major']);
   $gname = mysqli_real_escape_string($conn, $_POST['update_guardian']);
   $gcontact= mysqli_real_escape_string($conn, $_POST['update_guardiancontact']);
   $relationship = mysqli_real_escape_string($conn, $_POST['update_relationship']);
   $award = mysqli_real_escape_string($conn, $_POST['update_award']);

   $Getdeparment = mysqli_query($conn, "SELECT * FROM `deparment` WHERE id = '$department1'") or die('query failed');
   $Getprogram = mysqli_query($conn, "SELECT * FROM `ccis_program` WHERE id = '$program1'") or die('query failed');

   $dept = mysqli_fetch_assoc($Getdeparment);
   $department = $dept['department'];

   $prog = mysqli_fetch_assoc($Getprogram);
   $program = $prog['program'];

    $update = mysqli_query($conn, 
    "UPDATE student_data SET student_id = '$sID', student_lname = '$lname', 
    student_fname = '$fname', student_mname = '$mname', student_suffix = '$suffix', 
    student_birthday = '$bdate', student_contact = '$contactno', student_address = '$address', 
    student_gender = '$gender', date_graduated = '$dgrad', student_award = '$award', department = '$department', 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <div class="infoHonor">
          <div class="persoInfo1">
            <input class="lname" type="text" name="update_lastname" value="<?php echo $lname;?>">,
            <div class="fname_mi">
            <input id="fname" type="text" name="update_firstname" value="<?php echo $fname;?>">
            <input id="mname" type="text" name="update_middlename" value="<?php echo $mname;?>"></div>
          </div>
          </div>
            <div class="persoInfo2">

            <input class="studNumber" type="text" name="update_studentid" value="<?php echo $studentid;?>">
              <section class="label bdate">
                 <b>BIRTHDATE <br>
                <input class="label" type="date" name="update_birthdate" value="<?php echo $birthday;?>"></b> 
              </section>

              <section class="label">
              <b>CONTACT <br>
                <input class="label contact" type="text" name="update_contact" value="<?php echo $contact;?>"></b>
              </section>
              <section class="label">
              <b>ADDRESS <br>
                <input class="label add" type="text" name="update_address" value="<?php echo $address;?>"
                    style="width:100%"
                ></b>
              </section>
              
            </div>
            
        </div>
        <div class="school_parentInfo">

            <div class="schoolInfo">
            <div class="yearSemAcadyr">
                <section class="label">
                <b>DATE GRADUATED <br>
                    <input class="label dateGrad" type="date" name="update_yeargraduated" value="<?php echo $dgrad;?>"></b>
                </section>
                <section class="label">
                <b>SEMESTER <br>
                  <input class="label sem" type="text" name="update_semester" value="<?php echo $semester;?>"></b>
                </section>
                <section class="label">
                <b>ACADEMIC YEAR <br>
                  <input class="label acadyr" type="text" name="update_academicyear" value="<?php echo $acadyear;?>"></b>
                </section>
                <section class="label">
                <b>AWARD OF DISTINCTION <br>
                    <select name="update_award" id="">
                      <option value="<?php echo $award;?>"><?php echo $award;?></option>
                      <option value="Summa Cum Laude">SUMMA CUM LAUDE</option>
                      <option value="Magna Cum Laude">MAGNA CUM LAUDE</option>
                      <option value="Cum Laude">CUM LAUDE</option>
                      <option value="With Highest Honors">WITH HIGHEST HONORS</option>
                      <option value="With High Honors">WITH HIGH HONORS</option>
                      <option value="With Honors">WITH HONORS</option>
                    </select>
                </section>
              </div>
              <section class="label schoolField" >
              <b>DEPARTMENT <br>

                  <select id="department" name="update_department" >



                    <option value="<?php echo $department;?>" selected><?php echo $department;?></option>
                    <?php

                    $query = "SELECT * FROM deparment";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)){
                      $department = $row['department'];
                      $program = $row['id'];
                      echo  "<option value='".$program."'>".$department."</option>";

                    }


                    ?>
                    <!-- <option value="College of Business and Finance Studies">CBFS</option>
                    <option value="College of Tourism Hospitality Management">CTHM</option>
                    <option value="igs">IGS/CGS/CCAPS</option>
                    <option value="College of Science">COS</option>
                    <option value="College of Education">COE</option>
                    <option value="College of Computer Science and Engineering">CCSE</option>
                    <option value="iit">IIT/COT/ITRED/CTM</option>
                    <option value="College of Computing and Information Sciences">CCIS</option>
                    <option value="College of Governance and Public Policy">CGPP</option>
                    <option value="College of Arts and Letters">CAL</option>
                    <option value="College of Allied Health Studies">COAHS</option>
                    <option value="College of Human Kinetics">CHK</option>
                    <option value="College of Maritime Leadership Innovation">CMLI</option>
                    <option value="School of Law">SOL</option> -->
                  </select>
                </b>
              </section>
              <section class="label schoolField">
              <b>PROGRAM <br>

                  <select id="program" name="update_program" >
                    <option value="<?php echo $program;?>"><?php echo $program;?></option>
                  </select>  
                  </b>
              </section>
              <section class="label schoolField">
              <b>MAJOR <br>

                    <select id="major" name="update_major">
                      <option value="<?php echo $major;?>"><?php echo $major;?></option>
                    </select>  
                  </b>
              </section>
            </div>

            <div class="parentInfo">
              <section>
              <b>GUARDIAN <br>
                <input class="label guardian" type="text" name="update_guardian" value="<?php echo $gname;?>"></b>
              </section>

            <div class="cont_rel">
              <section>
              <b>CONTACT <br>
                <input class="label pcontact" type="text" name="update_guardiancontact" value="<?php echo $gcontact;?>"></b>
              </section>
              <section>
              <b>RELATIONSHIP <br>
                <input class="label relationship" type="text" name="update_relationship" value="<?php echo $relationship;?>"></b>
              </section></div>
            </div>

        </div>
      <!-- BUTTON SECTION -->
      <input type="submit" name="update_profile" value="SAVE"></form>
      </div>
      </div>
      <script>
   $(document).ready(function() {
  // When the first select changes
  $('#department').change(function() {
    var selectedValue = $(this).val();
   
    // Make an AJAX request to fetch data from the server
    $.ajax({
      url: 'update_options.php',  // PHP file to handle the AJAX request
      type: 'POST',
      data: { value: selectedValue },
      success: function(response) {
        // Clear existing options in the second select
        $('#program').html('');
        $('#major').html('');
        
        // Parse the JSON response
        var data = JSON.parse(response);
       
        
        // Add new options to the second select based on the response
        $.each(data, function(key, value) {
          $('#program').append('<option value="' + key + '">' + value + '</option>');
        });
      }
    });
  });
});

          $(document).ready(function() {
            // When the first select changes
            $('#program').change(function() {
              var selectedValue = $(this).val();
            
              // Make an AJAX request to fetch data from the server
              $.ajax({
                url: 'major-option.php',  // PHP file to handle the AJAX request
                type: 'POST',
                data: { value: selectedValue },
                success: function(response) {
                  // Clear existing options in the second select
                  $('#major').html('');
                  
                  // Parse the JSON response
                  var data = JSON.parse(response);
                  
                  
                  // Add new options to the second select based on the response
                  $.each(data, function(key, value) {
                    $('#major').append('<option value="' + key + '">' + value + '</option>');
                  });
                }
              });
            });
          });





  </script>
    <footer></footer>
  </body>
</html>