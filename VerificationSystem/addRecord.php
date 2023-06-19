<?php
include 'condb.php';
session_start();

//getting the staff account tag
$username = $_SESSION['username'];
$select1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row1 = $select1->fetch_assoc();
$account_tag = $row1['account_tag'];
$staff_username = $row1['account_username'];
$staff_email = $row1['Email'];

$Admin = "Admin";

if(isset($_POST['submit'])){

   $id = "";
   $sID = mysqli_real_escape_string($conn, $_POST['sID']);
   $lName = mysqli_real_escape_string($conn, $_POST['lName']);
   $fName = mysqli_real_escape_string($conn, $_POST['fName']);
   $mName = mysqli_real_escape_string($conn, $_POST['mName']);
   $bDate = mysqli_real_escape_string($conn, $_POST['bDate']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $contactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);
   $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $dGrad = mysqli_real_escape_string($conn, $_POST['dGrad']);
   $department1 = mysqli_real_escape_string($conn, $_POST['department']);
   $program1 = mysqli_real_escape_string($conn, $_POST['program']);
   $degree = mysqli_real_escape_string($conn, $_POST['degrees']??'');
   $sem = mysqli_real_escape_string($conn, $_POST['sem']);
   $acadYr = mysqli_real_escape_string($conn, $_POST['acadYr']);
   $Major = mysqli_real_escape_string($conn, $_POST['major']);
   $gName = mysqli_real_escape_string($conn, $_POST['gName']);
   $gContact= mysqli_real_escape_string($conn, $_POST['gContact']);
   $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
   $award = mysqli_real_escape_string($conn, $_POST['award']??'');
   
   $select = mysqli_query($conn, "SELECT * FROM `student_data` WHERE student_id = '$sID' AND academic_year = '$acadYr'") or die('query failed');
   $Getdeparment = mysqli_query($conn, "SELECT * FROM `deparment` WHERE id = '$department1'") or die('query failed');
   $Getprogram = mysqli_query($conn, "SELECT * FROM `ccis_program` WHERE id = '$program1'") or die('query failed');

   $dept = mysqli_fetch_assoc($Getdeparment);
   $department = $dept['department'];

   $prog = mysqli_fetch_assoc($Getprogram);
   $program = $prog['program'];

   $verify = mysqli_query($conn, "SELECT * FROM `student_data` WHERE student_id = '$sID' AND department = '$department' AND program = '$program' AND major = '$Major'") or die('query failed');
  

   if(mysqli_num_rows($select) > 0){
      echo '<script>alert("Error: Student is Already in the Database!!");</script>'; 
   }
   else if(mysqli_num_rows($verify) > 0){
      echo '<script>alert("Error: Student is Already in the Database!!");</script>'; 
   }
   else{
      $insert = mysqli_query($conn, "INSERT INTO `student_data`(id, student_id, student_lname, student_fname, student_mname, student_suffix, student_birthday, student_address, student_contact, student_gender, date_graduated, student_award,department, program, degree, semester, academic_year, major, guardian_name, guardian_contact, guardian_relationship) 
      VALUES('$id', '$sID', '$lName', '$fName', '$mName', '$suffix','$bDate','$address','$contactNo','$gender','$dGrad','$award','$department','$program','$degree','$sem','$acadYr','$Major','$gName','$gContact','$relationship')") or die('query failed');
      header('location: records.php');

      $add = 'Add';
      $insert1 = mysqli_query($conn, "INSERT INTO `activity_history`(activity_date, staff_username, staff_email, student_id, student_lname, student_fname, recent_activity) 
      VALUES (NOW(),'$staff_username','$staff_email','$sID','$lName','$fName','$add') ") or die('query failed');

   }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="css/addRecord.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>Add Student Record</title>
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

    <div class="content">
        <table class="cTable">
          <tr>
            <td><a href="records.php"><button class="back">BACK</button></a></td>
            <form action="" method="post" enctype="multipart/form-data">
            <td colspan="6" height="150vh" class="tdLogo"></td>
          </tr>
          <tr>
            <td colspan="2">STUDENT ID</td>
            <td colspan="2">LAST NAME</td>
            <td colspan="2">FIRST NAME</td>
            <td colspan="2">MIDDLE NAME</td>
          </tr>
          <!-- INPUT -->
          <tr>
            <td colspan="2"><input type="text" name="sID" class="sID" required></td>
            <td colspan="2"><input type="text" name="lName" class="lName"  required></td>
            <td colspan="2"><input type="text" name="fName" class="fName"  required></td>
            <td colspan="2"><input type="text" name="mName" class="mName"></td>
          </tr>
          <tr>
            <td colspan="2">BIRTHDATE</td>
            <td colspan="4">ADDRESS</td>
            <td colspan="2">CONTACT</td>
          </tr>
          <!-- INPUT -->
          <tr>
            <td colspan="2"><input type="date" name="bDate" class="bDate"  required></td>
            <td colspan="4"><input type="text" name="address" class="address"  required></td>
            <td colspan="2"><input type="text" name="contactNo" class="contactNo"  required></td>
          </tr>
          <!-- NAMES -->
          <tr>
            <td>SUFFIX</td>
            <td>GENDER</td>
            <td colspan="2">DATE GRADUATED</td>
            <td colspan="2">DEPARTMENT</td>
            <td colspan="2">PROGRAM</td>
          </tr>
          <!-- INPUT -->
          <tr>
            <td><input type="text" name="suffix" class="" id="shortInput"></td>
            <td><input type="radio" name="gender" class="gender" value="Male" id="male"  required><label for="male">Male</label>
              <input type="radio" name="gender" class="gender" value="Female" id="female"  required><label for="female">Female</label></td>
            <td colspan="2"> <input type="date" name="dGrad" id="year" class="dGrad"  required></td>
            <td colspan="2">
              <!-- DEPARTMENT -->
              <select id="department" name="department"   required>
                <option value="">--Select--</option>

                <?php

                  $query = "SELECT * FROM deparment";
                  $result = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($result)){
                    $department = $row['department'];
                    $program = $row['id'];
                    echo  "<option value='".$program."'>".$department."</option>";

                  }


?>
                <!-- <option value="CBFS">CBFS</option>
                <option value="CTHM">CTHM</option>
                <option value="IGS">IGS/CGS/CCAPS</option>
                <option value="COS">COS</option>
                <option value="COE">COE</option>
                <option value="CCSCE">CCSE</option>
                <option value="IIT">IIT/COT/ITRED/CTM</option>
                <option value="CCIS">CCIS</option>
                <option value="CGPP">CGPP</option>
                <option value="CAL">CAL</option>
                <option value="COASH">COAHS</option>
                <option value="CHK">CHK</option>
                <option value="CMLI">CMLI</option>
                <option value="SOL">SOL</option> -->
              </select></td>
            <td colspan="2">
              <!-- PROGRAM -->
              <select id="program" name="program"  required >
                <option value="" selected>--Select--</option>
              </select>
            </td>
          </tr>
        </tr>
        <!-- NAMES -->
        <tr>
          <td colspan="2">AWARD OF DISTINCTION</td>
          <td>SEMESTER</td>
          <td>ACAD. YEAR</td>
          <td colspan="2">DEGREE</td>
          <td colspan="2">MAJOR</td>
        </tr>
        <!-- INPUT -->
        <tr>
          <td colspan="2">
            <select name="award" id="">
            <option value="none" selected disabled hidden>Select an Option</option>
              <option value="Summa Cum Laude">SUMMA CUM LAUDE</option>
              <option value="Magna Cum Laude">MAGNA CUM LAUDE</option>
              <option value="Cum Laude">CUM LAUDE</option>
              <option value="With Highest Honors">WITH HIGHEST HONORS</option>
              <option value="With High Honors">WITH HIGH HONORS</option>
              <option value="With Honors">WITH HONORS</option>
            </select>
          </td>
          <td>
            <select name="sem" class="mediumInput" required>
              <option value="1st">First Sem</option>
              <option value="2nd">Second Sem</option>
            </select>
          <td>
            <select name="acadYr" required id="yearDropdown"></select>
            <script>

var currentYear = new Date().getFullYear();
    
    // Create the dropdown options
    var dropdown = document.getElementById("yearDropdown");

    // Add the preselected option
    var preselectedOption = document.createElement("option");
    preselectedOption.text = (currentYear - 1) + "-" + currentYear;
    preselectedOption.value = (currentYear - 1) + "-" + currentYear;
    preselectedOption.selected = true;
    dropdown.add(preselectedOption);

    // Add the remaining options
    for (var year = 1965; year <= currentYear; year++) {
      var option = document.createElement("option");
      option.text = year + "-" + (year + 1);
      option.value = year + "-" + (year + 1);
      dropdown.add(option);
    }

            </script>
            </select>
          </td>
          <!-- DEGREE SECTION -->
          <td colspan="2"><select name="degrees" id="degree" required>
            <option value="none" selected disabled hidden>Select an Option</option>
            <option value="Non-Baccalaureate Degree">Non-Baccalaureate Degree</option>
            <option value="Baccalaureate Degree">Baccalaureate Degree</option>
            <option value="Post Baccalaureate Degree">Post Baccalaureate Degree</option>
            <option value="Graduate Degree">Graduate's Degree</option>
          </select></td>
          <td colspan="2">
            <!-- MAJOR SECTION -->
            <select id="major" name="major" >
              <option value="">--Select--</option>
            </select>
        </td>
        </tr>
        <!-- NAMES -->
        <tr>
          <td colspan="2"></td>
          <td colspan="2">GUARDIAN'S NAME</td>
          <td colspan="2">CONTACT NO:</td>
          <td colspan="2">RELATIONSHIP</td>
        </tr>
        <!-- INPUT -->
        <tr>
          <td colspan="2"></td>
          <td colspan="2"><input type="text" name="gName" class="gName" required></td>
          <td colspan="2"><input type="text" name="gContact" class="gContact" required></td>
          <td colspan="2"><input type="text" name="relationship" class="relationship" required></td>
        </tr>
        <tr>
          <td colspan="7"></td>
          <td align="right"><input type="submit" name="submit" value="SAVE"></td>
        </tr>
        </table>
      </form>
    </div>

    <footer></footer>
    <!-- <script src="major.js"> -->
    </script>
    <script src="js/ddlYear.js"></script>

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
        $('#major').append(' <option value="" selected>--Select--</option>');
        $('#program').append(' <option value="" selected>--Select--</option>');
        
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
                  $('#major').append(' <option value="" selected>--Select--</option>');
                  
                  // Add new options to the second select based on the response
                  $.each(data, function(key, value) {
                    $('#major').append('<option value="' + key + '">' + value + '</option>');
                  });
                }
              });
            });
          });
  </script>

  </body>
</html>