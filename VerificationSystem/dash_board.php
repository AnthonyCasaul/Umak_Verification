<?php
include 'condb.php';
session_start();

$username = $_SESSION['username']??'';

//getting the staff account tag
$select1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row1 = $select1->fetch_assoc();
$account_tag = $row1['account_tag']??'';
$Admin = "Admin";

$viewer = "View";
$editor = "Edit";
$added  = "Add";

 $countStudent = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data") or die('query failed');
 $row = $countStudent->fetch_assoc();
 $countStaff = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts") or die('query failed');
 $row1 = $countStaff->fetch_assoc();
 $countStaffEdit = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts WHERE account_tag = '$editor'") or die('query failed');
 $row2 = $countStaffEdit->fetch_assoc();
 $countStaffView = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts WHERE account_tag = '$viewer'") or die('query failed');
 $row3 = $countStaffView->fetch_assoc();
 $countEdited = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM activity_history WHERE recent_activity = '$editor'") or die('query failed');
 $row4 = $countEdited->fetch_assoc();
 $countAdded = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM activity_history WHERE recent_activity = '$added'") or die('query failed');
 $row5 = $countAdded->fetch_assoc();

$dbdepartment = "SELECT * FROM deparment";

$dpresult = mysqli_query($conn,$dbdepartment);

$deptvalue = [];

if(mysqli_num_rows($dpresult)){
  while($rowdept = mysqli_fetch_assoc($dpresult)){
      $deptvalue[] = $rowdept['department'];


  }
}
$departmentV = [];

for ($x = 0;$x < count($deptvalue);$x++){

  $ccis = mysqli_query($conn, "SELECT * FROM student_data WHERE department = '$deptvalue[$x]'");
  $ccisV = mysqli_num_rows($ccis);
  $departmentV[] = $ccisV;

  //array_push($departmentV,$ccisV);
}

$degree = ['Non-Baccalaureate Degree','Baccalaureate Degree','Graduate Degree','Post Baccalaureate Degree'];
for ($x = 0;$x < count($degree);$x++){

  $result = mysqli_query($conn, "SELECT * FROM student_data WHERE degree = '$degree[$x]'");
  $countV = mysqli_num_rows($result);
  $degreecount[] = $countV;

  //array_push($departmentV,$ccisV);
}

$academicValue = [];

$queryacademic = "SELECT DISTINCT(academic_year) FROM student_data";
$academicV = mysqli_query($conn,$queryacademic);
if(mysqli_num_rows($academicV)){
  while($rowacademic = mysqli_fetch_assoc($academicV)){
      $academicValue[] = $rowacademic['academic_year'];

  }
}

$acadValue = [];

for ($x = 0;$x < count($academicValue);$x++){

  $resultacad = mysqli_query($conn, "SELECT * FROM student_data WHERE academic_year = '$academicValue[$x]'");
  $acadV = mysqli_num_rows($resultacad);
  $acadValue[] = $acadV;

  //array_push($departmentV,$ccisV);
}


$countSumma = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'Summa Cum Laude'") or die('query failed');
 $summa = $countSumma->fetch_assoc();
$countMagna = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'Magna Cum Laude'") or die('query failed');
 $magna = $countMagna->fetch_assoc();
$countCumlaude = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'Cum Laude'") or die('query failed');
 $cumlaude = $countCumlaude->fetch_assoc();
$countHighest = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'With Highest Honors'") or die('query failed');
 $highest = $countHighest->fetch_assoc();
$countHigh = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'With High Honors'") or die('query failed');
 $high = $countHigh->fetch_assoc();
$countWithhonors = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data WHERE student_award = 'With Honors'") or die('query failed');
 $withhonors = $countWithhonors->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="dashboardtrial.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>UMAK Verification System</title>
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

  <div class="dashboard">
    <div class="title">DASHBOARD</div>

    <div class="content">

      <div class="leftSideBar">
        <div class="left lTop">
          <div class="tStaff">
            <img src="img/staffIcon.png" alt="" class="sImg">
            <div class="text">
              <h2 class="num"><?php echo $row1['total_row']; ?></h2>
              <p class="staffText">TOTAL STAFFS</p>
            </div>
            </div>
            
          <div class="totalVE">
            <div class="view divVE">
              <h2 class="vStaff"><?php echo $row2['total_row']; ?></h2>
              <p class="staffText">can VIEW</p>
            </div>
            <div class="edit divVE">
              <h2 class="eStaff"><?php echo $row3['total_row']; ?></h2>
              <p class="staffText">can EDIT</p>
            </div>
          </div>
        </div>

        <div class="left lBot tAdded">
          <img src="img/add.png" alt="" class="tImg">
          <div class="text">
            <h2 class="num"><?php echo $row5['total_row']; ?></h2>
            <p class="numText addText">TOTAL ADDED RECORDS</p>
          </div>
        </div>

        <div class="left lBot tEdited">
          <img src="img/edit.png" alt="" class="tImg">
          <div class="text">
            <h2 class="num"><?php echo $row4['total_row']; ?></h2>
            <p class="numText editText">TOTAL EDITED RECORDS</p>
          </div>
        </div>

        <div class="left lBot tAlumni">
          <h2 class="num"><?php echo $row['total_row']; ?></h2>
          <p class="numText alumniText">TOTAL ALUMNI RECORDS</p>
        </div>
      </div>

      <div class="barGraph">
        <select name="" id="" class="CDAdropdown">
          <option value="">COLLEGES</option>
          <option value="">DEGREE</option>
          <option value="">ACADEMIC YEAR</option>
        </select>
      </div>

      <div class="rightSideBar">
        <div class="right rTop">
          <div class="searchProg">
            <img src="img/searchIcon.png" alt="" class="searchImg">
            <input type="text" placeholder="Search Program" id="program" onkeydown="handleKeyPress(event)">
          </div>
          <div class="result"></div>
        </div>
        <div class="rBot awards"></div>
      </div>

    </div>
  </div>
   
    
    <footer></footer>
  </body>
</html>
