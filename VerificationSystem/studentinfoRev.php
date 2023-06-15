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
                $lname = ucwords(strtolower($row['student_lname']));
                $fname = ucwords(strtolower($row['student_fname']));
                $mname = ucwords(strtolower($row['student_mname']));
                $suffix = $row['student_suffix'];
                $birthday = $row['student_birthday'];
                $contact = $row['student_contact'];
                $address = ucwords(strtoupper($row['student_address']));
                $gender = ucwords(strtoupper($row['student_gender']));
                $dgrad = $row['date_graduated'];
                $department = strtoupper($row['department']);
                $program = strtoupper($row['program']);
                $degree = strtoupper($row['degree']);
                $major = strtoupper($row['major']);
                $semester = strtoupper($row['semester']);
                $acadyear = $row['academic_year'];
                $gname = strtoupper($row['guardian_name']);
                $gcontact = $row['guardian_contact'];
                $relationship = strtoupper($row['guardian_relationship']);
                $award = strtoupper($row['student_award']??'');
              }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/studentinfoRev.css" />
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

    <div class="body">
      <a href="records.php"><button class="back">BACK</button></a>
      <div class="container">
      <div class="text"> STUDENT INFORMATION</div>
      <div class="content">
        <div class="studInfo">

        <div class="infoHonor">
          <div class="persoInfo1">
            <section class="lname">
                <?php echo $lname?>,
            </section>
            <section class="fname_mi">
                <?php echo $fname. ' ' .$mname. '.';
                ?>
            </section>
          </div>
          </div>

            <div class="persoInfo2">

            <section class="studNumber unLine">
                <?php echo $student_id?>
            </section>
              <section class="label bdate unLine">
                 BIRTHDATE <br>
                <b><?php echo $birthday?></b> 
              </section>

              <section class="label contact unLine">
                CONTACT <br>
                <b><?php echo $contact?></b>
              </section>
              <section class="label add unLine">
                ADDRESS <br>
                <b><?php echo $address?></b>
              </section>
              
            </div>
            
        </div>
        <div class="school_parentInfo">

            <div class="schoolInfo">
              <div class="yearSemAcadyr">
                <section class ="label dateGrad unLine">
                  DATE GRADUATED <br>
                    <b><?php echo $dgrad?></b>
                </section>
                <section class="label sem unLine">
                  SEMESTER <br>
                  <b><?php echo $semester?></b>
                </section>
                <section class="label acadyr unLine">
                  ACADEMIC YEAR <br>
                  <b><?php echo $acadyear?></b>
                </section>
                <section class="label award unLine">
                  AWARD OF DISTINCTION <br>
                    <b><?php echo $award?></b>
                </section>
              </div>
              <section class="label dept unLine">
                DEPARTMENT <br>
                  <b><?php echo $department?></b>
              </section>
              <section class="label prog unLine">
                PROGRAM <br>
                  <b><?php echo $program?></b>
              </section>
              <section class="label major unLine">
                MAJOR <br>
                  <b><?php echo $major?></b>
              </section>
            </div>

            <div class="parentInfo">
              <section class="guardian unLine">
                GUARDIAN <br>
                <b><?php echo $gname?></b>
              </section>

            <div class="cont_rel">
              <section class="pcontact unLine">
                CONTACT <br>
                <b><?php echo $gcontact?></b>
              </section>
              <section class="relationship unLine">
                RELATIONSHIP <br>
                <b><?php echo $relationship?></b>
              </section></div>
            </div>

        </div>
      </div>
      </div>
      <!-- BUTTON SECTION -->
      <?php
        if($account_tag == "Edit" || $account_tag == "Admin"){
      ?>
        <form id="GFG" method="post" action="editStudentInfoRev.php">
          <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <a href="javascript:;" onclick="document.getElementById('GFG').submit();">
          <div class="editIcon">
            <img src="img/editIcon.png" alt="">
            <span class="editText">EDIT</span>
          </div>
          </a>
        </form>
      <?php
      }
      ?>
      
        <div class="dlIcon">
        <img src="img/dlButton.png" alt="">
        <span class="dlText"><form method="post" action="certificate_generate.php">
        <input type="hidden" name="fname" value="<?php echo $fname?>">
        <input type="hidden" name="mname" value="<?php echo $mname?>">
        <input type="hidden" name="lname" value="<?php echo $lname?>">
        <input type="hidden" name="program" value="<?php echo $program?>">
        <input type="hidden" name="major" value="<?php echo $major?>">
        <input type="hidden" name="department" value="<?php echo $department?>">
        <input type="hidden" name="dgrad" value="<?php echo $dgrad?>">
        <input type="hidden" name="gender" value="<?php echo $gender?>">

          <input type="submit" class="download" name="submit" value="DOWNLOAD"></form></span>
      </div>
    <footer></footer>
  </body>
</html>