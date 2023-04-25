<?php
include 'condb.php';
session_start();
$validator = mysqli_query($conn, "SELECT * FROM validator") or die('query failed');
$row1 = $validator->fetch_assoc();
$student_id = $row1['validator'];

$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$select = mysqli_query($conn, "SELECT * FROM student_data WHERE id = '$student_id' ") or die('query failed');
if(mysqli_num_rows($select) > 0){
			while($row = mysqli_fetch_assoc($select)){
                $ID = $row['id'];
                $student_id = $row['student_id'];
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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/studentInfo.css" />
    <link rel="icon" href="img/UMakLogo.png" />
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
      <a href="records.php"><button class="back">BACK</button></a>
      <table>
        <tr>
          <!-- for image -->
          <td rowspan="7" class="icon2">
            <img src="img/userpic.png" class="usericon" />
          </td>
        </tr>
        <!-- 1ST ROW -->
        <tr>
          <td>LAST NAME</td>
          <td>BIRTHDATE</td>
        </tr>
        <!-- 1ST ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $lname;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $birthday;?></b></td>
        </tr>
        <!-- 2ND ROW -->
        <tr>
          <td>FIRST NAME</td>
          <td>GENDER</td>
        </tr>
        <!-- 2ND ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $fname;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $gender;?></b></td>
        </tr>
        <!-- 3RD ROW -->
        <tr>
          <td>MIDDLE NAME</td>
          <td>CONTACT NUMBER</td>
        </tr>
        <!-- 3RD ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $mname;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $contact;?></b></td>
        </tr>
        <!-- 4TH ROW -->
        <tr>
          <td>STUDENT ID</td>
          <td>SUFFIX</td>
          <td>YEAR GRADUATED</td>
        </tr>
        <!-- 4TH ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $student_id;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $suffix;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $dgrad;?></b></td>
        </tr>
        <!-- 5TH ROW -->
        <tr>
          <td>GUARDIAN</td>
          <td>ADDRESS</td>
          <td></td>
        </tr>
        <!-- 5TH ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $gname;?></b></td>
          <td colspan="2"><b>&nbsp&nbsp<?php echo $address;?></b></td>
        </tr>
        <!-- 6TH ROW -->
        <tr>
          <td>CONTACT</td>
          <td>DEPARTMENT</td>
          <td>PROGRAM</td>
        </tr>
        <!-- 6TH ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $contact;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $department;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $program;?></b></td>
        </tr>
        <!-- 7TH ROW -->
        <tr>
          <td>RELATIONSHIP</td>
          <td>DEGREE</td>
          <td>MAJOR</td>
        </tr>
        <!-- 7TH ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $relationship;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $degree;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $major;?></b></td>
        </tr>
        <!-- 8TH ROW -->
        <tr>
          <td rowspan="2"></td>
          <td>SEMESTER</td>
          <td>ACADEMIC YEAR</td>
        </tr>
        <!-- 8TH ROW INPUT -->
        <tr>
          <td><b>&nbsp&nbsp<?php echo $semester;?></b></td>
          <td><b>&nbsp&nbsp<?php echo $acadyear;?></b></td>
        </tr>
      </table>
      <!-- BUTTON SECTION -->
        <div class="dlIcon">
        <!-- <i class="fa-solid fa-download"></i> -->
        <img src="img/dlButton.png" alt="">
        <span class="dlText">DOWNLOAD</span>
      </div>
    <footer></footer>
  </body>
</html>